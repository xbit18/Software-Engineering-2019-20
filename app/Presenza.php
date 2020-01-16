<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presenza extends Model
{
    protected $table = "presenze";

    public function aule(){
        return $this->belongsTo('App\Aula');
    }

    public function utenti(){
        return $this->belongsTo('App\Utente');
    }
}
