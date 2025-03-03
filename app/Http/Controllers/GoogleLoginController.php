<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;

class GoogleLoginController extends Controller
{
    
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        $googleUser = Socialite::driver('google')->user();
        $user = User::where('email', $googleUser->email)->first();
        $fullname = explode(' ',$googleUser->name);

        if(!$user)
        {
            $user = User::create(['firstname' => $fullname[0],'lastname' => $fullname[1], 'email' => $googleUser->email,'phone'=>'null','account_type'=>'passenger','photo'=>'null', 'password' => Hash::make(rand(100000,999999))]);
        }

        Auth::login($user);

        redirect('index');
    }
}
