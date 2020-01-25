<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = ['code','availability','type','capacity','state','building_id','floor'];

    public function building(){
        return $this->belongsTo('App\Building');
    }

    public function tokens(){
        return $this->hasMany('App\Token');
    }

    public function attendances(){
        return $this->hasMany('App\Attendance');
    }

    public function seats(){
        return $this->hasMany('App\Seat');
    }

    public function classroomReservations(){
        return $this->hasMany('App\ClassroomReservation');
    }

}
