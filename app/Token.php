<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    public function classroom(){
        return $this->belongsTo('App\Classroom');
    }
}
