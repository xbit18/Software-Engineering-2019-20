<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    public function classroom(){
        return $this->belongsTo('App\Classroom');
    }

    public function user(){
        return $this->belongsTo('App\SeatReservation');
    }
}
