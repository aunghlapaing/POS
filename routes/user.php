<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ProfileController;

Route:: group (['prefix'=> 'user', "middleware"=>"user"], function(){
    Route::get('home', [UserController::class, 'userHome'])->name('userHome');
    Route::get('test/auth', [UserController::class, 'testAuth'])->name('testAuth');

    # profile routes
    Route::group(['prefix' => 'profile'], function()
    {
        Route::get('edit/{id}', [ProfileController::class, 'editPage'])->name('editPage');
        Route::post('update/{id}', [ProfileController::class, 'updateProfile'])->name('updateProfile');
        Route::get('change/password', [ProfileController::class, 'changePasswordPage'])->name('changePasswordPage');
        Route::post('change/password', [ProfileController::class, 'changePassword'])->name('changePassword');
    });
});