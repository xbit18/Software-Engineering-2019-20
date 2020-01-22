<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    protected $table = "occupazioni";

    public function place(){
        return $this->hasOne('App\Seat');
    }

    public function user(){
        return $this->hasOne('App\User');
    }
}
