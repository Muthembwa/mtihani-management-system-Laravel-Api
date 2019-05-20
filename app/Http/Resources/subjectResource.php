<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class subjectResource extends JsonResource
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
            'subjectname' => $this->subjectname,
            'subject_code' => $this->subject_code,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            //'role' => new rolesResource($this->roles('id')), 
        ];
            
    }
}
