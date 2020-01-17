<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utente extends Model 
{
    protected $table = 'utenti';

    public function presenza(){
        return $this->hasMany('App\Presenza');
    }

    public function posto(){
        return $this->belongsTo('App\Occupazione');
    }

    public function prenotazioni(){
        return $this->hasMany('App\Prenotazione');
    }
}
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
//     public function getJWTIdentifier()
//     {
//         return $this->getKey();
//         // TODO: Implement getJWTIdentifier() method.
//     }

//     /**
//      * Return a key value array, containing any custom claims to be added to the JWT.
//      *
//      * @return array
//      */
//     public function getJWTCustomClaims()
//     {
//         return [];
//         // TODO: Implement getJWTCustomClaims() method.
//     }
// }
