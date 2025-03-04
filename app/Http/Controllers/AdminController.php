<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('account_type','not like','admin');
        $drivers = Driver::all();
        $actuelReservations = Reservation::where('date','=',now());

        return view("dashboards.admin",['users'=>$users,'drivers'=>$drivers,'actuel_reservations'=>$actuelReservations]);
    }

}
