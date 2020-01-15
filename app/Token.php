<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    public $id;
    public $codice;
    public $id_aula;

    protected $table = 'token';

    public function aula(){
        return $this->belongsTo('App\Aula');
    }
}
