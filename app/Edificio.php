<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
public $id=0;
public $numero_aule=0;
public $nome='rand';
public $indirizzo='rand';
    protected $table = 'edificio';
}
