<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\WushuController;

// Route::get('/', function () {
//     return Inertia::render('Welcome');
// })->name('home');

// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// 首頁
Route::get('/', [WushuController::class, 'home'])->name('wushu.home');


Route::prefix('wushu')->group(function () {

    // 服務與課程頁 (代表/ServiceCourse會連到wushuController裡面的list)
    Route::get('/ServiceCourse', [WushuController::class, 'list'])->name('wushu.list');

    // 課程介紹頁(未解鎖、解鎖)
    Route::get('/CourseIntro/{id}', [WushuController::class, 'intro'])->name('wushu.intro');

    // 購物車
    Route::get('/Cart', [WushuController::class, 'cart'])->name('wushu.cart');
    // 購物車 新增資料
    Route::post('/Cart', [WushuController::class, 'storeOrder'])->name('wushu.storeOrder');

    // 付款與退款政策頁
    Route::get('/Policy', function () {
        return Inertia::render('frontend/Policy');
    })->name('wushu.policy');

    // 🔺聯絡我們頁 新增頁 ContactUs
    Route::get('/ContactUs', [WushuController::class, 'contact'])->name('wushu.contact');

    // 🔺聯絡我們頁 新增資料 新增要帶值的方法
    Route::post('/ContactUs', [WushuController::class, 'store'])->name('wushu.store');

    // 登入註冊頁
    Route::get('/LoginSignup', function () {
        return Inertia::render('frontend/LoginSignup');
    });

    // 隱私權政策
    Route::get('/Privacy', function () {
        return Inertia::render('frontend/Privacy');
    })->name('wushu.privacy');

    // 會員中心 

    Route::get('/MemberCenter', [WushuController::class, 'userInfo'])->name('wushu.memberCenter');
    
    // 更新個人資料
    Route::post('/MemberCenter/update/{id}', [WushuController::class, 'userInfoUpdate'])->name('Member.update')->middleware('auth');
    Route::post('/MemberCenter/updatePassword/{id}', [WushuController::class, 'passwordUpdate'])->name('Member.updatePassword')->middleware('auth');
});
