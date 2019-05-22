<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    
    //use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=['subjectname','subject_code'];
    
      /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

   //schools relationship

    public function schools()
    {
        return $this
        ->belongsToMany(school::class)
        ->withTimestamps(); 
    }

    //students relationship

    public function students()
    {
        return $this
        ->belongsToMany(Student::class, 'marks')
        ->as('masks')
        ->withTimestamps(); 
    }

    //users relationship
    public function users()
    {
        return $this
        ->belongsToMany(User::class)
        ->withTimestamps(); 
    }

    //streams relationship
    public function streams()
    {
        return $this
        ->belongsToMany(Stream::class)
        ->withTimestamps(); 
    }

    //exams relationship

    public function exams()
    {
        return $this
        ->belongsToMany(Exam::class)
        ->withTimestamps(); 
    }
}

