<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ServiceController;


// 後端頁面

// 會員管理
Route::prefix('wushu/admin/user')->group(function(){
    Route::get('/',[UserController::class,'index'])->name('admin.user.list');

});

// 聯絡我們
Route::prefix('wushu/admin/contact')->group(function(){
    Route::get('/',[ContactController::class,'index'])->name('admin.contact.list');

});

// 服務內容管理
Route::prefix('wushu/admin/service')->group(function(){
    Route::get('/',[ServiceController::class,'index'])->name('admin.service.list');

});

// 子課程管理
Route::prefix('wushu/admin/course')->group(function(){
    Route::get('/',[CourseController::class,'index'])->name('admin.course.list');

});




