<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeatReservation extends Model
{
    protected $table = "seat_reservations";

    public function place(){
        return $this->hasOne('App\Seat');
    }

    public function user(){
        return $this->hasOne('App\User');
    }
}
