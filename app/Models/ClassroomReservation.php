<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassroomReservation extends Model
{
    protected $table = 'classroom_reservations';
    protected $fillable = ["start_date","end_date", "motivation", "state", "classroom_id", "user_id"];
    public function users(){
        return $this->belongsTo('App\User');
    }

    public function classrooms(){
        return $this->belongsTo('App\Classroom');
    }
}
