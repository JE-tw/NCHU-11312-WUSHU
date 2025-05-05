<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HandlesTableFilters;


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
        $sortDirection = $request->input('direction', 'asc');
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
            'defaultDirection' => 'asc',
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
