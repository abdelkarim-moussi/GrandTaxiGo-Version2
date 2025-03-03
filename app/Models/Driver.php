<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $guarded = [];

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }
}
