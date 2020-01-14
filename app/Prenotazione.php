<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prenotazione extends Model
{
        public $id;
        public $data;
        public $durata;
        public $motivazione;
        public $stato;
        public $id_aula;
        public $id_utente;

        protected $table = 'prenotazione';
}
