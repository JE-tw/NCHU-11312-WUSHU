<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::prefix('wushu')->group(function () {
    // 首頁
    Route::get('/', function () {
        return Inertia::render('frontend/Home'); // vue檔案路徑
    });
    // 服務與課程頁
    Route::get('/ServiceCourse', function () {
        return Inertia::render('frontend/ServiceCourse');
    });
    // 付款與退款政策頁
    Route::get('/Policy', function () {
        return Inertia::render('frontend/Policy');
    });
    // 聯絡我們頁
    Route::get('/ContactUs', function () {
        return Inertia::render('frontend/ContactUs');
    });
    // 登入註冊頁
    Route::get('/LoginSignup', function () {
        return Inertia::render('frontend/LoginSignup');
    });

    //課程介紹頁(未解鎖、解鎖)
    Route::get('/CourseIntro', function () {
        return Inertia::render('frontend/CourseIntro');
    });

    // 購物車
    Route::get('/Cart', function () {
        return Inertia::render('frontend/Cart');
    });

    // 隱私權政策
    Route::get('/Privacy', function () {
        return Inertia::render('frontend/Privacy');
    });

    // 會員中心頁
    Route::get('/MemberCenter', function () {
        return Inertia::render('frontend/MemberCenter');
    });

});
