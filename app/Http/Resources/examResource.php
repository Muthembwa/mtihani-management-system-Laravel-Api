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
            'examname' => $this->examname,
            'term' => $this->term,
            'exam_code' => $this->exam_code,  
            'streams' => $this->streams,
            'subject' => $this->subjects,
            'students'=>$this->students,
            'marks'=>$this->marks,
            'users'=> $this->users,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
    ];
    }
}
