<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    public $table = 'aule';

    public function edificio(){
        return $this->belongsTo('App\Edificio');
    }

    public function tokens(){
        return $this->hasMany('App\Token');
    }

    public function presenze(){
        return $this->hasMany('App\Presenza');
    }

    public function posti(){
        return $this->hasMany('App\Posto');
    }

    public function prenotazioni(){
        return $this->hasMany('App\Prenotazione');
    }

}
