<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'note',
        'driver_id',
        'user_id',
        'comment'
    ];



    public function driver(){
        return $this->belongsTo(Driver::class);
    }

    public function user(){
        return $this->belongsTo(Driver::class);
    }
}
