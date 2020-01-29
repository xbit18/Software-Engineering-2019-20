<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            "email"=>$this->email,
            "course"=>$this->course,
            "matriculation_number"=>$this->matriculation_number,
            "type"=>$this->type,
            "birthdate"=>$this->birthdate,
            "name"=>$this->name,
            "surname"=>$this->surname,
            "identification_number"=>$this->identification_number
        ];
    }
}
