<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

   // use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'adm_no','student_name', 'stream_id','parents_name','parents_email','parents_phone_no'];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    
    /**
     * Set to null if empty
     * @param $input
     */
    public function setClassNameIdAttribute($input)
    {
        $this->attributes['stream_id'] = $input ? $input : null;
    }
    //streams relationship
    public function stream()
    {
        return $this
        ->belongsTo(Stream::class, 'stream_id'); 
    }
    //subjects relationship

    public function subjects() 
    {
        return $this
        ->belongsToMany(Subject::class)
        ->withTimestamps(); 
    }
    //exams relationship
    public function exams() 
    {
        return $this
        ->belongsToMany(Exam::class)
        ->as('exams')
        ->withTimestamps(); 
   }
   public function marks()
    {
        return $this
        ->hasMany(Mark::class);
    }
    
}
