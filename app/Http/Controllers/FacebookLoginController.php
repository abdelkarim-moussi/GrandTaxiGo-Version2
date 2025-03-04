<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class FacebookLoginController extends Controller
{
   

public function redirectToFacebook()
 {
    return Socialite::driver('facebook')->redirect();
 }

 public function handleFacebookCallback()
 {

  try {
       $user = Socialite::driver('facebook')->user();

       $saveUser = User::updateOrCreate([
           'facebook_id' => $user->getId(),
       ],[
           'name' => $user->getName(),
           'email' => $user->getEmail(),
           'password' => Hash::make($user->getName().'@'.$user->getId())
            ]);

       Auth::loginUsingId($saveUser->id);

       return redirect()->route('index');
       } catch (\Throwable $th) {
          throw $th;
       }
}
}


