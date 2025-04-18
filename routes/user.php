<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ProductController;
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

    #product details
    Route::group(['prefix'=>'product'], function()
    {
        Route::get('detial/{id}', [ProductController::class, 'productDetailPage'])->name('productDetailPage');
        Route::post('comment', [ProductController::class, 'productComment'])->name('productComment');
        Route::get('comment/delete/{id}', [ProductController::class, 'commentDelete'])->name('commentDelete');
        Route::post('rating', [ProductController::class, 'rating'])->name('rating');
        Route::get('cart', [ProductController::class, 'cartPage'])->name('cartPage');
        Route::post('cart', [ProductController::class, 'addToCart'])->name('addToCart');
        Route::get('cartDelete', [ProductController::class, 'cardDelete'])->name('cardDelete');
        Route::get('paymentPage', [ProductController::class, 'paymentPage'])->name('paymentPage');
        Route::get('tempStorage', [ProductController::class, 'tempStorage'])->name('tempStorage');
        Route::post('order', [ProductController::class, 'order'])->name('order');
    });
});