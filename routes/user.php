<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

Route:: group (['prefix'=> 'user'], function(){
    Route::get('home', [UserController::class, 'userHome'])->name('userHome');
});