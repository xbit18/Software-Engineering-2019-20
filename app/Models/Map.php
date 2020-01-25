<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $fillable = ['floor_map','floor','building_id'];
    public function building(){
        return $this->belongsTo('App\Building');
    }
}
