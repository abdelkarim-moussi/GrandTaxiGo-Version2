<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthenticatedSessionController extends Controller
{
    
    public function create(){
        return view("auth.login");
    }

    public function login(Request $request){

        $attributes = $request->validate(
            [
                'email'=>['required','email'],
                'password'=>['required']
            ]
            );
        $user = User::where('email','=',$attributes['email'])->first();

        if($user->account_status == 'active')
        {

            if(Auth::attempt($attributes))
            {

                $request->session()->regenerate();
                Auth::login($user);

                if($user->account_type === 'admin'){
                    return redirect('admin');
                }
        
                else return redirect()->intended('reservations');

            }
            
            return back()->withErrors([
                'email'=>'the provided crédentials do not mustch our records.',
     
            ]);
           
        }
        else
        {
            return redirect()->back()->with('message','your account has been suspended');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
