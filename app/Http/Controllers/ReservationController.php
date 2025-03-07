<?php

namespace App\Http\Controllers;

use App\Mail\EmailNotification;
use App\Models\Driver;
use App\Models\Reservation;
use App\Models\User;
use App\Notifications\ReservationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReservationController extends Controller
{
    
    public function reservations(){

        $condition = 'user_id';
        $redirection = '/passenger';

        if(Auth::user()->account_type == "driver"){
            $condition = 'driver_id';
            $redirection = '/driver';
            $driver = Driver::where('user_id','=',Auth::user()->id)->first();
        }

        // ->join('users','reservations.user_id','=','users.id')
        // ->join('drivers','reservations.driver_id','=','reservations.driver_id')
        $reservations = Reservation::where($condition,'=',$driver->id ?? Auth::user()->id)
        ->get();
        
        $drivers = DB::table('drivers')
        ->join('users','drivers.user_id','=','users.id')
        ->get();

        return view('dashboards'.$redirection,['reservations'=>$reservations,'drivers'=>$drivers]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date'=>'required',
            'location'=>'required | string',
            'destination'=>'required | string'
        ]);

        $validated['driver_id'] = $request->driverid;
        $validated['user_id'] = Auth::user()->id;

        Reservation::create($validated);

        return response()->json(['success' => 'votre réservation et créer avec succés']);
    }

    public function cancel($id){

        $reservation = Reservation::find($id);
        $reservation->update(['reservaton_status'=>'canceled']);
        return Redirect::back()->with('success','reservation canceled succefully !');

    }
    public function accept($id){

        $reservation = Reservation::find($id);
        $reservation->update(['reservaton_status'=>'accepted']);

        $user = User::where('id','=',$reservation->user_id)->first();

        $reservationInfo = 
        "Username: {$user->firstname} {$user->lastname}\n" .
        "Date de prise en charge: {$reservation->date}\n" .
        "Lieu de prise en charge: {$reservation->location}\n" .
        "Destination: {$reservation->destination}\n" .
        "Date reservation: " . date('Y-m-d', strtotime($reservation->created_at)) . "\n";
        $qrcodePath = QRcodeController::generate($reservationInfo);

        Mail::to($user->email)->send(new EmailNotification($reservationInfo,$qrcodePath));

        return Redirect::back()->with('accepted','reservation accepted succefully !');

    }
    public function refuse($id){

        $reservation = Reservation::find($id);
        $reservation->update(['reservaton_status'=>'refused']);
        return Redirect::back()->with('refused','reservation refused succefully !');

    }

}
