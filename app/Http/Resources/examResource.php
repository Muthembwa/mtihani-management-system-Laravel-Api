<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class examResource extends JsonResource
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
            'id' => $this->id,
            'Year' => $this->Year,
            'term' => $this->term,
            'exam_code' => $this->exam_code,  
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
    ];
    }
}
