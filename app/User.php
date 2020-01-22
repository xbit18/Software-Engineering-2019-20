<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'utenti';

    public function presence(){
        return $this->hasMany('App\Presence');
    }

    public function place(){
        return $this->belongsTo('App\Occupation');
    }

    public function bookings(){
        return $this->hasMany('App\Booking');
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
