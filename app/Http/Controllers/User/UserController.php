<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    # redirect to the user home page
    public function userHome (){
        return view('user.home.list');
    }

    public function testAuth()
    {
        return view('user.testAuth');
    }
}
