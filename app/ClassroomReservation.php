<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassroomReservation extends Model
{
    protected $table = 'classroom_reservations';

    public function users(){
        return $this->belongsTo('App\User');
    }

    public function classrooms(){
        return $this->belongsTo('App\Classroom');
    }
}
