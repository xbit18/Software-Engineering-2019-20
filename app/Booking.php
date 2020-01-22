<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'prenotazioni';

    public function users(){
        return $this->belongsTo('App\User');
    }

    public function classrooms(){
        return $this->belongsTo('App\Classroom');
    }
}
