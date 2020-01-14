<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utente extends Model {
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
    protected $table = 'utente';
}
