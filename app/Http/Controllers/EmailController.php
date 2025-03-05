<?php

namespace App\Http\Controllers;

use App\Mail\EmailNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(User $user) {
        $recipient = $user->email; // Change to the recipient's email address
        $data = ['name' => $user->firstname]; // Data to pass to the email view

        Mail::to($recipient)->send(new EmailNotification($data));

        return response()->json(['message' => 'Email sent successfully to ' . $recipient]);
    }
}
