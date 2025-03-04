<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryEditController;
use App\Http\Controllers\Admin\CategoryListController;

Route::group(['prefix'=>'admin','middleware'=>'admin'], function(){
    Route::get('home',[AdminController::class, 'adminHome'])->name ('adminHome');

    Route::group(['prefix'=>'category'], function()
    {
        Route::get('list', [CategoryListController::class, 'categoryList'])->name('categoryList');
        Route::post('create', [CategoryListController::class, 'categoryCreate'])->name('categoryCreate');
        Route::get('edit/{id}', [CategoryListController::class, 'categoryEdit'])->name('categoryEdit');
        Route::post('update/{id}', [CategoryListController::class, 'categoryUpdate'])->name('categoryUpdate');
        Route::get('delete/{id}', [CategoryListController::class, 'categoryDelete'])->name('categoryDelete');
    });
    
    Route::group(['prefix'=>'product'], function(){
        Route::get('create', [ProductController::class, 'productCreate'])->name('productCreate');
    });
    
});