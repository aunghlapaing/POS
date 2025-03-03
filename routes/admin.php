<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;



// Route::middleware('superAdmin')->group(function(){
//     Route::group (['prefix'=>'admin'],function(){
//         Route::get('home',[AdminController::class, 'adminHome'])->name('adminHome');
//     });
// });

// Route::group(['prefix'=>'admin', 'middleware'=>'AdminMiddleware'], function()
// {
//     Route::get('home', [AdminController::class, 'adminHome'])->name ('adminHome');
// });

Route::group(['prefix'=>'admin','middleware'=>'admin'], function(){
    Route::get('home',[AdminController::class, 'adminHome'])->name ('adminHome');
    Route::get('category', [CategoryController::class, 'category'])->name('adminCategory');
});