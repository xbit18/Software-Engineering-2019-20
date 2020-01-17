<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utente extends Model
{
    protected $table = 'utenti';

    public function presenza(){
        return $this->hasMany('App\Presenza');
    }

    public function posto(){
        return $this->belongsTo('App\Occupazione');
    }

    public function prenotazioni(){
        return $this->hasMany('App\Prenotazione');
    }
}
