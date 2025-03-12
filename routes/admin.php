<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
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
        Route::get('createPage', [ProductController::class, 'productCreatePage'])->name('productCreatePage');
        Route::post('create', [ProductController::class, 'productCreate'])->name('productCreate');
        Route::get('list/{action?}', [ProductController::class, 'productList'])->name('productList'); 
        Route::get('delete/{id}', [ProductController::class, 'productDelete'])->name('productDelete'); 
        Route::get('edit/{id}', [ProductController::class, 'productEditPage'])->name('productEditPage'); 
        Route::post('update/{id}', [ProductController::class, 'productUpdate'])->name('productUpdate');
        Route::get('detail/{id}', [ProductController::class, 'productDetail'])->name('productDetail');
    });

    Route::group(['prefix'=>'profile'], function(){
        Route::get('changePasswordPage', [ProfileController::class, 'changePasswordPage'])->name('changePasswordPage');
        Route::post('changePassword', [ProfileController::class, 'changePassword'])->name('changePassword');
        Route::get('edit/profilePage', [ProfileController::class, 'editProfilePage'])->name('editProfilePage');
        Route::post('edit/profile/{id}', [ProfileController::class, 'editProfile'])->name('editProfile');
    });

    Route::group(['middleware' => 'superAdmin'], function()
    {
        Route::group(['prefix' => 'payment'], function()
        {
            #Route::get();
            Route::get('page', [PaymentController::class, 'paymentPage'])->name('paymentPage');
            Route::post('create', [PaymentController::class, 'paymentCreate'])->name('paymentCreate');
            Route::get('edit/{id}', [PaymentController::class, 'paymentEditPage'])->name('paymentEditPage');
            Route::post('update/{id}', [PaymentController::class, 'paymentUpdate'])->name('paymentUpdate');
            Route::get('delete/{id}', [PaymentController::class, 'paymentDelete'])->name('paymentDelete');
        });

        Route::group(['prefix' => 'account'], function()
        {
            Route::get('create/newAdminPage', [AdminController::class, 'createNewAdminPage'])->name('createNewAdminPage');
            Route::post('create/newAdmin', [AdminController::class, 'createNewAdmin'])->name('createNewAdmin');
            Route::get('admin/list/{action?}', [AdminController::class, 'adminListPage'])->name('adminListPage');
            Route::get('admin/delete/{id}', [AdminController::class, 'deleteAccount'])->name('deleteAccount');
        });
    });
    
});