<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mappa extends Model
{
    public $id;
    public $piantina;
    public $piano;
    public $id_edificio;

    protected $table = 'mappe';

    public function edificio(){
        return $this->belongsTo('App\Edificio');
    }
}
