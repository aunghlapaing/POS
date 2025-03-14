<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect ($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback ($provider)
    {
        $socialUserData = Socialite::driver($provider)->user();

        // dd($provider);

        // dd($socialUserData);

        $user = User::updateOrCreate([
            'provider_id' => $socialUserData->id
        ], [
            'first_name' => $socialUserData->name,
            'email' => $socialUserData->email,
            'profile' => $socialUserData->picture,
            'provider' => $provider,
            'provider_id' => $socialUserData->id,
            'provider_token' => $socialUserData->token
        ]);

     
        Auth::login($user);
     
        return to_route('userHome');
    }
}
