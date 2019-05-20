<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class markResource extends JsonResource
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
            'mark' => $this->mark,
            'exam' => examResource::collection($this->students),
            'student' => studentResource::collection($this->students),
            'subject' => studentResource::collection($this->subjects('id')),
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
