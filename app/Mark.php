<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['exam_id','student_id', 'subject_id', 'mark'];

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
    public function setExamIdAttribute($input)
    {
        $this->attributes['exam_id'] = $input ? $input : null;
    }
    public function setStudentIdAttribute($input)
    {
        $this->attributes['student_id'] = $input ? $input : null;
    }
    public function setSubjectIdAttribute($input)
    {
        $this->attributes['subject_id'] = $input ? $input : null;
    }
   
    //exam relationship
   public function exam()
   {
       return $this
       ->belongsTo(Exam::class, 'exam_id')
       ->withTimestamps()
       ->withTrashed(); 
   }
    //student relationship

   public function student()
   {
       return $this
       ->belongsTo(Student::class, 'student_id')
       ->withTimestamps()
       ->withTrashed(); 
   }
    //subject relationship

   public function subject()
   {
       return $this
       ->belongsTo(Subject::class, 'subject_id')
       ->withTimestamps()
       ->withTrashed(); 
   }
  
}
