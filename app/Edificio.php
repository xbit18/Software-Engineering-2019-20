<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
    protected $guarded = [];
    public $id;
    public $numero_aule;
    public $nome;
    public $indirizzo;

    protected $table = 'edifici';

    public function aule(){
        return $this->hasMany('App\Aula');
    }

    public function mappe(){
        return $this->hasMany('App\Mappa');
    }
}
