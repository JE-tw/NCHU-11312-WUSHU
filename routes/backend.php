<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ContactController;


// 後端頁面

// 聯絡我們
Route::prefix('admin/contact')->group(function(){
    Route::get('/',[ContactController::class,'index'])->name('admin.contact.list');

    // // 新增頁
    // Route::get('/create', [ContactController::class,'create'])->name('admin.contact.create');
    
    // // 新增資料
    // Route::post('/',[ContactController::class,'store'])->name('admin.contact.store');
    
    // // 編輯頁
    // Route::get('/edit/{id}', [ContactController::class,'edit'])->name('admin.contact.edit');
    
    // // 編輯資料
    // Route::post('/update/{id}', [ContactController::class,'update'])->name('admin.contact.update');
    
    // 刪除資料
    Route::get('/delete/{id}', [ContactController::class,'delete'])->name('admin.contact.delete');
});


