<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Stream
 *
 * @package App
 * @property string $class_name
*/
class Stream extends Model
{
    //use SoftDeletes;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    protected $fillable = ['class_name','class_slogan'];


     /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = ['school_id'];
    


 /**
     * Set school to the school of the user creating the stream
     * @param $user
     */
    public function setSchoolIdAttribute($user)
    {
        $this->attributes['school_id'] = $user->school('id');
    }

   //students relationship

    public function students()
    {
      return $this
        ->hasMany(Student::class); 
    }

   //school relationship
    
    public function school()
    {
       return $this
       ->belongsTo(school::class, 'school_id');
    }

    //users relationship

    public function class_teachers()
    {
        return $this->belongsToMany(User::class)
        ->withTimestamps();
    
    }

    //exams relationship

    public function exams()
    {
       return $this
       ->belongsToMany(Exam::class)
       ->withTimestamps();
      
    }

    //marks for the stream through exams
    public function marks()
    {
        return $this->hasManyThrough('App\Mark', 'App\Student');
    }
}
