<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserInfoController;
use App\Models\Service;

// 後端頁面
// 付款紀錄管理
Route::prefix('wushu/admin/order')->group(function(){
    Route::get('/',[OrderController::class,'index'])->name('admin.order.list');

});

// 會員管理
Route::prefix('wushu/admin/user')->group(function(){
    Route::get('/',[UserInfoController::class,'index'])->name('admin.user.list');
    // 新增
    Route::post('/', [UserInfoController::class, 'store'])->name('admin.user.store');

    // 刪除
    Route::get('/delete/{id}',[UserInfoController::class,'delete'])->name('admin.user.delete');


});

// 聯絡我們
Route::prefix('wushu/admin/contact')->group(function(){
    Route::get('/',[ContactController::class,'index'])->name('admin.contact.list');

    // 刪除
    Route::get('/delete/{id}',[ContactController::class,'delete'])->name('admin.contact.delete');

});

// 服務內容管理
Route::prefix('wushu/admin/service')->group(function(){
    Route::get('/',[ServiceController::class,'index'])->name('admin.service.list');

    // 刪除
    Route::get('/delete/{id}',[ServiceController::class,'delete'])->name('admin.service.delete');

});

// 子課程管理
Route::prefix('wushu/admin/course')->group(function(){
    Route::get('/',[CourseController::class,'index'])->name('admin.course.list');

});




