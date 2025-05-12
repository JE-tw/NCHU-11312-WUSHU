<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\HandlesTableFilters;
use App\Http\Controllers\Controller;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HandlesTableFilters;
    public function index(Request $request)
    {

        $query = Course::with('category');
        // 動態處理 sortKey，如果前端傳 category.name，就改成 category_id 排序
        $sortKey = $request->input('sort');
        $sortDirection = $request->input('direction', 'desc');
        if ($sortKey === 'category_name') {
            // 用 category_id 排序
            $request->merge([
                'sort' => 'category_id',
                'direction' => $sortDirection,
            ]);
        }

        $courses = $this->applyFiltersAndPaginate($request, $query, [
            'allowedSorts' => ['is_featured', 'price', 'category_id'],
            'defaultSort' => 'is_featured',
            'defaultDirection' => 'desc',
            'perPage' => 10,
        ]);
        // 在資料集合中添加 category_name 欄位，並避免在 SQL 排序中使用該欄位
        $courses->getCollection()->transform(function ($course) {
            $course->category_name = $course->category->name ?? '未分類';
            return $course;
        });

        return Inertia::render('backend/CourseList', [
            'courses' => $courses,
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        return Inertia::render('backend/CourseCreate', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:30',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer|min:0',
            'list_intro' => 'required|string|max:36',
            'detail_intro' => 'required|string|max:500',
            'is_featured' => 'boolean',
        ]);

        // 如果標記為主打課程，檢查數量限制
        if ($data['is_featured']) {
            $featuredCount = Course::where('is_featured', 1)->count();
            if ($featuredCount >= 2) {
                return redirect()->back()->withErrors(['is_featured' => '主打課程最多只能有兩堂']);
            }
        }

        Course::create([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'price' => $data['price'],
            'introduction' => $data['list_intro'],
            'detail' => $data['detail_intro'],
            'is_featured' => $data['is_featured'] ? 1 : 0,
        ]);

        return redirect()->back()->with('success', '課程已成功新增！');
    }


    public function edit(Course $course)
    {
        $categories = Category::all();
        $chapters = $course->chapters;

        return Inertia::render('backend/CourseEdit', [
            'course' => $course,
            'categories' => $categories,
            'chapters' => $chapters,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'name' => 'required|string|max:30',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer|min:0',
            'list_intro' => 'required|string|max:36',
            'detail_intro' => 'required|string|max:500',
            'is_featured' => 'boolean',
        ]);
        // 如果即將標記為主打課程，且原本不是主打，才進行檢查
        if ($data['is_featured'] && !$course->is_featured) {
            $featuredCount = Course::where('is_featured', 1)->count();
            if ($featuredCount >= 2) {
                return redirect()->back()->withErrors(['is_featured' => '主打課程最多只能有兩堂']);
            }
        }

        $course->update([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'price' => $data['price'],
            'introduction' => $data['list_intro'],
            'detail' => $data['detail_intro'],
            'is_featured' => $data['is_featured'] ? 1 : 0,
        ]);

        return redirect()->back()->with('success', '課程已成功更新！');
    }

    public function delete($id)
    {
        $item = Course::find($id);
        $item->delete();
        return back()->with('success', '刪除成功');
    }
}
