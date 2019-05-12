<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
   
  use SoftDeletes;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
  protected $fillable = ['title'];


     /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
  protected $hidden = [];

  
  //users relationship
  public function users()
  {
    return $this
      ->belongsToMany(User::class)
      ->withTimestamps();
  }
}
