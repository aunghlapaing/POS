<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;



// Route::middleware('superAdmin')->group(function(){
//     Route::group (['prefix'=>'admin'],function(){
//         Route::get('home',[AdminController::class, 'adminHome'])->name('adminHome');
//     });
// });

Route::group(['prefix'=>'admin'], function(){
    Route::get('home',[AdminController::class, 'adminHome'])->name ('adminHome');
});