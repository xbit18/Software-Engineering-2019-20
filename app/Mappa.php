<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mappa extends Model
{
    protected $table = 'mappe';

    public function edificio(){
        return $this->belongsTo('App\Edificio');
    }
}
