<?php

use Inertia\Inertia;
use App\Models\Service;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserInfoController;

// 後端頁面

Route::prefix('wushu/admin')->middleware(['auth', 'admin_only'])->group(function () {
    // 後台首頁
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // 付款紀錄管理
    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.order.list');
        Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('admin.order.edit');
        Route::put('/{order}', [OrderController::class, 'update'])->name('admin.order.update');
    });

    // 會員管理
    Route::prefix('user')->group(function () {
        Route::get('/', [UserInfoController::class, 'index'])->name('admin.user.list');
        // 新增
        Route::post('/', [UserInfoController::class, 'create'])->name('admin.user.create');
        // 編輯
        Route::get('/{user}/edit', [UserInfoController::class, 'edit'])->name('admin.user.edit');
        // 更新
        Route::put('/{user}', [UserInfoController::class, 'update'])->name('admin.user.update');

        // 刪除
        Route::get('/delete/{id}', [UserInfoController::class, 'delete'])->name('admin.user.delete');
    });

    // 聯絡我們
    Route::prefix('contact')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('admin.contact.list');

        // 刪除
        Route::get('/delete/{id}', [ContactController::class, 'delete'])->name('admin.contact.delete');
    });

    // 服務內容管理
    Route::prefix('service')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('admin.service.list');

        // 新增
        Route::post('/', [ServiceController::class, 'create'])->name('admin.service.create');

        // 更新
        Route::put('/{service}', [ServiceController::class, 'update'])->name('admin.service.update');

        // 刪除
        Route::get('/delete/{id}', [ServiceController::class, 'delete'])->name('admin.service.delete');
    });

    // 子課程管理
    Route::prefix('course')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('admin.course.list');
        Route::get('/{course}/edit', [CourseController::class, 'edit'])->name('admin.course.edit');
        Route::put('/{course}', [CourseController::class, 'update'])->name('admin.course.update');
    });

    // 章節管理
    Route::prefix('chapter')->group(function () {
        Route::post('/', [ChapterController::class, 'store'])->name('admin.chapter.store');
        Route::put('/{chapter}', [ChapterController::class, 'update'])->name('admin.chapter.update');
        Route::get('/delete/{id}', [ChapterController::class, 'delete'])->name('admin.chapter.delete');
    });
});

// //登入頁
// Route::get('wushu/admin/login', [LoginController::class, 'loginPage'])->name('admin.login');


/////////////////////////////
// 購物車訂單
Route::post('/orders', [OrderController::class, 'store'])->name('wushu.storeOrder');
