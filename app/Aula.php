<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $guarded = [];
    public $id;
    public $codice;
    public $disponibilita;
    public $tipo;
    public $capienza;
    public $stato;
    public $id_edificio;
    protected $table = 'aula';
}
