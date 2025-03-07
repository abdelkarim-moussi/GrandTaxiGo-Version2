<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Termwind\parse;

class ProfileController extends Controller
{
    
    public function index(){
        $user = User::where('id','=',Auth::user()->id)->with('reviews')->first();
        $avgnote = number_format((float) DB::table('reviews')->where('driver_id','=',$user->id)->avg('note'),1);
        $courses_number = count(Reservation::all()->where('reservaton_status','=','done'));
        $driver = null;

        if($user->account_type == "driver"){
            $driver =  $driver = Driver::where('user_id' ,'=', $user->id)->with('reviews')->first();
            $avgnote = number_format((float) DB::table('reviews')->where('driver_id','=',$driver->id)->avg('note'),1);
        }
        
        return view('profile.index',['user'=>$user,'driver'=>$driver,'avgnote'=>$avgnote,'numcourses'=>$courses_number]);
    }

    public function update(Request $request){
        // dd($request);
        
        $validated = $request->validate([
                'firstname'=>['required','string'],
                'lastname'=>['required','string'],
                'email'=>['required','email'],
                'phone'=>'required'
            ]);

        $userUpdate = 
            [
                'firstname'=>$validated['firstname'],
                'lastname'=>$validated['lastname'],
                'email'=>$validated['email'],
                'phone'=>$validated['phone']
            ]
            ;

        $user = User::find(Auth::user()->id);
        $driver = null;

        if(Auth::user()->account_type == 'driver'){
            $driverAttributes['city'] = $request->validate(['city'=>'required']);
            $driver = Driver::where('user_id' ,'=', $user->id)->first();
        }

        $user->update($userUpdate);
        
        if($driver != null){
            $driver->update($driverAttributes['city']);
        }

        return redirect('/profile');
    }

    public function updatePhoto(Request $request){
        $path['photo'] = [];
        if($request->hasfile('updated-photo')){
            $path['photo'] = $request->file('updated-photo')->store('photos','public');
        }

        if($path['photo']){
            $user = User::find(Auth::user()->id);
            $user->update($path);
        }

        return redirect('/profile');
    }

}
