<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('account_type','not like','admin')->get();
        $drivers = Driver::all();

        $actuelReservations = Reservation::where('date','=',now());
        $reservations = DB::table('reservations')
        ->get();

        // dd($reservations);

        return view("dashboards.admin",['users'=>$users,'drivers'=>$drivers,'actuel_reservations'=>$actuelReservations,'reservations'=>$reservations]);
    }

    public function activateAccount(User $user){
        
        DB::table('users')
        ->where('id', $user->id)
        ->update(['account_status' => 'active']);

        return redirect()->back()->with('message','user account activated succefully');
    }

    public function suspendAccount(User $user){

        DB::table('users')
        ->where('id', $user->id)
        ->update(['account_status' => 'suspended']);

        return redirect()->back()->with('message','user account suspended succefully');
    }
}
