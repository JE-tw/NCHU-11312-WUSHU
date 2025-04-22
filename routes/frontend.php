<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::prefix('whshu')->group(function(){
    // 首頁
    Route::get('/', function () {
        return Inertia::render('frontend/Home'); // vue檔案路徑
    });
    // 服務與課程
        // 首頁
        Route::get('/ServiceCourse', function () {
            return Inertia::render('frontend/ServiceCourse'); // vue檔案路徑
        });

});



