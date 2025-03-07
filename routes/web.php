<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegistredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FacebookLoginController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleWare;
use Illuminate\Support\Carbon;
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

Route::get('/details',[UserController::class,'show']);


Route::middleware(['auth','User_Role:driver'])->group(function(){
    Route::get('/driver',[DriverController::class,'show']);
    Route::get('/profile/updateDriverStatus/{status}',[DriverController::class,'updateStatus']);
    Route::get('/reservations/accept/{id}',[ReservationController::class,'accept']);
    Route::get('/reservations/refuse/{id}',[ReservationController::class,'refuse']);
});

Route::post('/review',[UserController::class,'review'])->middleware(['auth']);

Route::middleware(['auth','User_Role:passenger'])->group(function(){
    Route::get('/passenger',[PassengerController::class,'show']);
    Route::post('/reserve',[ReservationController::class,'store']);
    Route::get('/reservations/{id}',[ReservationController::class,'cancel']);

    Route::controller(StripePaymentController::class)->group(function(){
        Route::get('stripe', 'stripe');
        Route::post('stripe', 'stripePost')->name('stripe.post');
    });

});

Route::middleware(['auth','User_Role:admin'])->group(function(){
    Route::get('/admin',[AdminController::class,'index']);
    Route::get('/account/{user}/suspend',[AdminController::class,'suspendAccount']);
    Route::get('/account/{user}/activate',[AdminController::class,'activateAccount']);
    
});

Route::get('/logout',[AuthenticatedSessionController::class,'logout']);

Route::controller(DriverController::class)->group(
    function(){
        Route::get('/drivers','index');
        Route::post('/search','search'); 
    }
); 

Route::middleware(['guest'])->group(function(){
    //register routes
    Route::get('/register',[RegistredUserController::class,'create']);
    Route::post('/register',[RegistredUserController::class,'store']);

    //login routes
    Route::get('/login',[AuthenticatedSessionController::class,'create']);
    Route::post('/login',[AuthenticatedSessionController::class,'login']);

    Route::get('/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
    Route::get('/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');
    
    Route::get('/facebook/redirect', [FacebookLoginController::class, 'redirectToFacebook'])->name('facebook.redirect');
    Route::get('/facebook/callback', [FacebookLoginController::class, 'handleFAcebookCallback'])->name('facebook.callback');
});

