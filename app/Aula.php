<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    private $id;
    private $codice;
    private $capienza;
    private $tipo;
    private $disponibilita;
    protected $table = 'aule';
}
