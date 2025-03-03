<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PassengerController extends Controller
{
    
    public function show(){
        return view('dashboards.passenger');
    }
}
