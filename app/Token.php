<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'token';

    public function aula(){
        return $this->belongsTo('App\Aula');
    }
}
