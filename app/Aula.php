<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $guarded = [];
    public $id;
    public $codice;
    public $capienza;
    public $tipo;
    public $disponibilita;
    public $stato;
    protected $table = 'aula';
}
