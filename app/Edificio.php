<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
    public $id;
    public $numero_aule;
    public $nome;
    public $indirizzo;
    protected $table = 'edificio';
}
