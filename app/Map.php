<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $table = 'mappe';

    public function building(){
        return $this->belongsTo('App\Building');
    }
}
