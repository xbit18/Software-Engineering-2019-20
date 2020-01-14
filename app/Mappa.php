<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mappa extends Model
{
    public $piantina;
    public $piano;
    public $id;
    protected $table = 'mappa';
}
