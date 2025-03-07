<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function review(Request $request){
        

        $validated = $request->validate(
            [
                'note'=>'required',
                'user-id'=>'required',
                'driver-id'=>'required',
                'review-comment'=>'nullable'
            ]
        );

        Review::create([
            'user_id'=>$validated['user-id'],
            'driver_id'=>$validated['driver-id'],
            'note'=>$validated['note'],
            'comment'=>$validated['review-comment']
        ]);
    }
}
