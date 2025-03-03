<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class FacebookLoginController extends Controller
{
    public function redirectToFacebbok(){
        return Socialite::driver('facebbok')->redirect();
    }

    public function handleFacebookCallback(){
        $googleUser = Socialite::driver('facebook')->user();
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
