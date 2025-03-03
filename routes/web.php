<?php

use App\Http\Controllers\Auth\RegistredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\GoogleLoginController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/profile',[ProfileController::class,'index']);
    Route::post('/profile',[ProfileController::class,'update']);
    Route::post('/profile/photo',[ProfileController::class,'updatePhoto']);
    Route::get('/reservations',[ReservationController::class,'reservations']);
    
});

Route::get('/drivers',[DriverController::class,'index']);
Route::post('/search',[DriverController::class,'search']);

Route::middleware(['auth','is_driver:driver'])->group(function(){
    Route::get('/driver',[DriverController::class,'show']);
    Route::get('/profile/updateDriverStatus/{status}',[DriverController::class,'updateStatus']);
    Route::get('/reservations/accept/{id}',[ReservationController::class,'accept']);
    Route::get('/reservations/refuse/{id}',[ReservationController::class,'refuse']);
});

Route::middleware(['auth','is_passenger:passenger'])->group(function(){
    Route::get('/passenger',[PassengerController::class,'show']);
    Route::post('/reserve',[ReservationController::class,'store']);
    Route::get('/reservations/{id}',[ReservationController::class,'cancel']);
});

Route::get('/logout',[AuthenticatedSessionController::class,'logout']);

Route::middleware(['guest'])->group(function(){
    //register routes
    Route::get('/register',[RegistredUserController::class,'create']);
    Route::post('/register',[RegistredUserController::class,'store']);

    //login routes
    Route::get('/login',[AuthenticatedSessionController::class,'create']);
    Route::post('/login',[AuthenticatedSessionController::class,'login']);

    Route::get('/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
    Route::get('/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');
});
