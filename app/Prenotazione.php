<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prenotazione extends Model
{
    protected $table = 'prenotazioni';

    public function utenti(){
        return $this->belongsTo('App\Utente');
    }

    public function aule(){
        return $this->belongsTo('App\Aula');
    }
}
