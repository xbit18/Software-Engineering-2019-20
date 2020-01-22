<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $table = 'edifici';

    public function classrooms(){
        return $this->hasMany('App\Classroom');
    }

    public function maps(){
        return $this->hasMany('App\Map');
    }
}
