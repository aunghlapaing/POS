<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect ($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback ($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        dd($socialUser);

        // $user = User::updateOrCreate([
        //     'github_id' => $githubUser->id,
        // ], [
        //     'name' => $githubUser->name,
        //     'email' => $githubUser->email,
        //     'github_token' => $githubUser->token,
        //     'github_refresh_token' => $githubUser->refreshToken,
        // ]);

     
        // Auth::login($user);
     
        // return redirect('/dashboard');
    }
}
