<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
{
    public function index(){
        $drivers = DB::table('users')->where('account_type','=','driver')
        ->join('drivers','users.id','=','drivers.user_id')->get();
        return view('drivers.index',['drivers'=>$drivers]);

        // return response(view('drivers.index',array('drivers'=>$drivers)),200, ['Content-Type' => 'application/json']);

    }

    public function show(){
        return view('dashboards.driver');
    }

    public function updateStatus($status){
        // dd($status);
        $driver = Driver::find(Auth::user()->id);
        if($status === "disponible"){
            $driver->update(['status'=>'not disponible']);
        }
        else if($status === "not disponible") {
            $driver->update(['status'=>'disponible']);
        }
       
        return redirect('profile');
    }

    public function search(Request $request)
{
    $key = trim(strtolower($request->get('search')));

    // Use query builder to filter at the database level
    $drivers = Driver::where("city", "like", "%{$key}%")->get();

    return view('drivers.index', ['drivers' => $drivers]);
}

}
