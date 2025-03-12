<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialLoginController;

require_once __DIR__.'/admin.php';
require_once __DIR__.'/user.php';

# social login route

Route::group(['prefix'=>'auth'], function(){
    Route::get('{provider}/redirect', [SocialLoginController::class, 'redirect'])->name ('socialRedirect');
    Route::get('{provider}/callback', [SocialLoginController::class, 'callback'])->name ('socialCallBack');
});


Route::get('/', function () {
    return view('authentication/login');
});

Route::get('/dashboard', function () {
    return view('admin/dashboard/home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
