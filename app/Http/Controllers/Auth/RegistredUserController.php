<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegistredUserController extends Controller
{
    public function create() 
    {
        return view('auth.register');
    }

    public function store(Request $request){

        $attributes = $request->validate(
            [
                'firstname'=>['required','string'],
                'lastname'=>['required','string'],
                'email'=>['required','email'],
                'phone'=>'required',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'password'=>['required','string',Password::min(8),'confirmed'],
                'account_type'=>'required'

            ]);
            $path = null;
        if($request->hasFile('photo')){
            $path = $request->file('photo')->store('photos','public');
        }

        $user = User::create([
            'firstname'=>$attributes['firstname'],
            'lastname'=>$attributes['lastname'],
            'email'=>$attributes['email'],
            'phone'=>$attributes['phone'],
            'photo'=>$path,
            'password'=>$attributes['password'],
            'account_type'=>$attributes['account_type']

        ]);

        if($attributes['account_type'] == "driver"){
            $driverAttributes = $request->validate(
                [
                    'driver-lisence'=>'required',
                    'city'=>'required'
                ]
                );
            Driver::create(
                [
                    'user_id'=>$user->id,
                    'driver_lisence'=>$driverAttributes['driver-lisence'],
                    'city'=>$driverAttributes['city']
                ]
            );
        }

        Auth::login($user);
            
        return redirect('/reservations');
       
        
    }
}
