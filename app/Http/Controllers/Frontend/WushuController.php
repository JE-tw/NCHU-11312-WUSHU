<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use App\Models\Course;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WushuController extends Controller
{
    // 服務與課程頁
    public function list()
    {
        $categories = Category::with('courses')->get();
        $services = Service::all();

        return Inertia::render('frontend/ServiceCourse', [
            'categories' => $categories,
            'services' => $services,
        ]);
    }

    // 課程介紹頁
    public function intro($id)
    {
        $course = Course::with(['chapters'])->find($id);
        if ($course == null) return redirect('/wushu/ServiceCourse');

        return Inertia::render('frontend/CourseIntro', [
            'course' => $course,
        ]);
    }

    // // 🔺聯絡我們頁 ContactUs
    // function contact(){
    //     return Inertia::render('frontend/ContactUs');
    // }

    // // 🔺新增聯絡我們資料
    // function store(Request $request){
    //     $item = $request->all();
    //     // 1. 資料個別填寫
    //     // dd($item);
    //     ContactRecord::create([
    //     "name" => $item['name'],
    //     "phone" => $item['phone'],
    //     "email" => $item['email'],
    //     "title" => $item['title'],
    //     "content" => $item['content'],
    //     ]);
    //     return redirect(route('frontend.list'));
    // }
}
