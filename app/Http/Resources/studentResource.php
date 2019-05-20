<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class studentResource extends JsonResource
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
            'adm_no' => $this->adm_no,
            'student_name' => $this->student_name,
            'stream' => streamResource::collection($this->streams),
            'parents_name' => $this->parents_name,
            'parents_email' => $this->parents_email,
            'parents_phone_no' => $this->parents_phone_no,
            'parents_email' => $this->parents_email,     
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            //'role' => new rolesResource($this->roles('id')), 
        ];
    }
}
