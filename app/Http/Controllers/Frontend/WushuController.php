<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use App\Models\Course;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ContactRecord;
use App\Http\Controllers\Controller;

class WushuController extends Controller
{
    // 首頁 - 獲取課程資料
    public function home()
    {
        $categories = Category::with('courses')->get();
        $featuredCourses = Course::where('is_featured', true)->take(2)->get(); // 主打課程
        
        // 將課程按類別分組
        $coursesByCategory = [];
        foreach ($categories as $category) {
            $coursesByCategory[$category->name] = $category->courses;
        }

        return Inertia::render('frontend/Home', [
            'categories' => $categories,
            'coursesByCategory' => $coursesByCategory,
            'featuredCourses' => $featuredCourses,
        ]);
    }
    
    // 查 服務與課程頁 課程、服務
    public function list()
    {
        $categories = Category::with('courses')->get();
        $services = Service::all();

        return Inertia::render('frontend/ServiceCourse', [
            'categories' => $categories,
            'services' => $services,
        ]);
    }

    // 查 課程介紹頁 課程關聯章節
    public function intro($id)
    {
        $course = Course::with(['chapters'])->find($id);
        if ($course == null) return redirect('/wushu/ServiceCourse');

        return Inertia::render('frontend/CourseIntro', [
            'course' => $course,
        ]);
    }

    // 聯絡我們頁 ContactUs
    function contact()
    {
        return Inertia::render('frontend/ContactUs');
    }

    // 新增 聯絡我們資料 -> ContactRecord
    function store(Request $request)
    {
        $item = $request->all();
        // 資料
        ContactRecord::create([
            "name" => $item['name'],
            "phone" => $item['phone'],
            "email" => $item['email'],
            "title" => $item['title'],
            "content" => $item['content'],
        ]);
        return redirect(route('wushu.contact'));
    }
}
