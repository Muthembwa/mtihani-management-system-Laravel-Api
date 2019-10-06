<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class streamResource extends JsonResource
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
            'school'=>$this->school,
            'class_name' => $this->class_name,
            'class_teacher'=>$this->class_teachers,
            'students'=>$this->students,
            'mark'=>$this->mark,
            //'class_slogan' => $this->class_slogan,
            //'student' => studentResource::collection($this->students),
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,

        ];
        
    }
}
