<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
   // 
    protected $fillable = ['title'];
    protected $hidden = [];

    public function users()
    {
      return $this
        ->belongsToMany(User::class)
        ->withTimestamps();
    }
}
