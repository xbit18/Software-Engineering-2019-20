<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posto extends Model
{
    protected $table = "posti";

    public function aula(){
        return $this->belongsTo('App\Aula');
    }

    public function utente(){
        return $this->hasOne('App\Utente');
    }
}
