<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $fillable=['code','classroom_id','validity'];
    public function classroom(){
        return $this->belongsTo('App\Classroom');
    }
}
