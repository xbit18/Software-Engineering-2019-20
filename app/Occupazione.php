<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Occupazione extends Model
{
    protected $table = "occupazioni";

    public function posto(){
        return $this->hasOne('App\Posto');
    }

    public function utente(){
        return $this->hasOne('App\Utente');
    }
}
