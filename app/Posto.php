<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posto extends Model
{
    public $id;
    public $numero_posto;
    public $disponibilita;
    public $id_utente;
    public $id_aula;

    protected $table = "posto";
}