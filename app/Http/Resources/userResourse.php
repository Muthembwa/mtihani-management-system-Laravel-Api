<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class userResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'school' => $this->school,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            //'role' => new rolesResource($this->roles('id')), 
        ];
            
    }
}
