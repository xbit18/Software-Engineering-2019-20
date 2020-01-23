<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public $table = 'aule';
    protected $fillable = [];

    public function building(){
        return $this->belongsTo('App\Building');
    }

    public function tokens(){
        return $this->hasMany('App\Token');
    }

    public function presences(){
        return $this->hasMany('App\Presence');
    }

    public function places(){
        return $this->hasMany('App\Seat');
    }

    public function bookings(){
        return $this->hasMany('App\Booking');
    }

}
