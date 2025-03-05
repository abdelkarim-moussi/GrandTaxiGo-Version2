<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('account_type','not like','admin')->get();
        $drivers = Driver::all();
        $actuelReservations = Reservation::where('date','=',now());

        return view("dashboards.admin",['users'=>$users,'drivers'=>$drivers,'actuel_reservations'=>$actuelReservations]);
    }

    public function activateAccount(User $user){
    
        $user->update(['account_status'=>'active']);
    
        return redirect()->back()->with('message','user account activated succefully');
    }

    public function suspendAccount(User $user){

        $user->update(['account_status'=>'suspended']);

        return redirect()->back()->with('message','user account suspended succefully');
    }
}
