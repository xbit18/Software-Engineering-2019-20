<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utente extends Model
{
    public $id;
    public $email;
    public $password;
    public $nome;
    public $dat_nascita;
    public $tipo;
    public $cognome;
    public $corso;
    public $matricola;
    public $numero_documento;
    protected $table = 'utenti';

    public function presenza(){
        return $this->hasMany('App\Presenza');
    }

    public function posto(){
        return $this->belongsTo('App\Posto');
    }

    public function prenotazioni(){
        return $this->hasMany('App\Prenotazione');
    }
}
