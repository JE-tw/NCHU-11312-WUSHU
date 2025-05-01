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
}
// 詳細資訊頁
// public function detail($id)
// {

//     $movie = Movie::with(['rating', 'tags', 'theaters'])->find($id);
//     if ($movie == null) return redirect('/movies');

//     return Inertia::render('frontend/movies/MovieDetail', [
//         'response' => $movie,
//     ]);
//     // dd($movies);
// }
