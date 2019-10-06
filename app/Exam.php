<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['examname', 'term', 'exam_code'];

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
        ->as('schools')
        ->withTimestamps(); 
    }


    //streams relationship

    public function streams()
    {
        return $this
        ->belongsToMany(Stream::class)
        ->as('streams')
        ->withTimestamps(); 
    }

    //users relationship

    public function users() 
    {
        return $this
        ->belongsToMany(User::class)
        ->as('users'); 
    }
    public function subjects() 
    {
        return $this
        ->belongsToMany(Subject::class)
        ->as('subjects')
        ->withTimestamps(); 
    }


    //students relationship

    public function students() 
    {
        return $this
        ->belongsToMany(Student::class)
        ->as('students')
        ->withTimestamps(); 
    }
    //marks relationship

   //marks for the school through exams
   public function marks()
   {
       return $this
       ->hasMany('App\Mark');
   }

    
}
