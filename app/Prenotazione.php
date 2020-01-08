<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prenotazione extends Model
{
        public $id;
        public $codice;
        public $data;
        public $dutrata;
        public $motivazione;
        public $stato;
    protected $table = 'prenotazione';
}
