<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presenza extends Model
{
    public $id;
    public $data_entrata;
    public $data_uscita;
    public $materia;
    public $id_aula;
    public $id_utente;

    protected $table = "presenza";
}