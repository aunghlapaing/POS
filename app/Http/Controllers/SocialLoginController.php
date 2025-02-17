<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect ()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback ()
    {
        return Socialite::driver('github')->user();
    }
}
