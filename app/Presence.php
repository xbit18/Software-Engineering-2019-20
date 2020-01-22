<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $table = "presenze";

    public function classrooms(){
        return $this->belongsTo('App\Classroom');
    }

    public function users(){
        return $this->belongsTo('App\User');
    }
}
