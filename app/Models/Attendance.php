<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable=['entry_date','exit_date','subject','classroom_id','user_id','confirmation'];

    public function classrooms(){
        return $this->belongsTo('App\Classroom');
    }

    public function users(){
        return $this->belongsTo('App\User');
    }
}
