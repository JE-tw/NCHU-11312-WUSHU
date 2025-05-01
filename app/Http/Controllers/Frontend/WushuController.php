<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use App\Models\Course;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WushuController extends Controller
{
    // 服務與課程頁
    public function list()
    {
        $courses = Course::with(['category'])->get();
        $services = Service::all();
        return Inertia::render('frontend/ServiceCourse', [
            'courses' => $courses,
            'services' => $services,
        ]);
    }
}
