<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::group (['prefix'=>'admin'],function(){
    Route::get('home',[AdminController::class, 'adminHome'])->name('adminHome');
});