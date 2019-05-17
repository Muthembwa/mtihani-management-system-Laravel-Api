<?php

namespace App;

use Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
//use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    //use softDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'school_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Automatically creates hash for the user password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
       /**
     * Set to null if empty
     * @param $input
     */
    public function setRoleIdAttribute($input)
    {
        $this->attributes['school_id'] = $input ? $input : null;
    }


     //user_school relationship
     public function school()
     {
         return $this
         ->belongsTo(school::class);
     }
    //user_roles relationship
    public function roles()
    {
        return $this
        ->belongsToMany(role::class)
        ->as ('roles')
        ->withTimestamps(); 
    }
  //User_subject relationship
    public function subjects()
    {
        return $this
        ->belongsToMany(Subject::class)
        ->withTimestamps(); 
    }

    //user_streams relationship
    public function streams()
    {
        return $this
        ->belongsToMany(Stream::class)
        ->withTimestamps(); 
    }
    //user_exams relationship
    public function exams()
    {
        return $this
        ->belongsToMany(Exam::class)
        ->withTimestamps(); 
    }

    //students a teacher manage through stream
    public function students()
    {
        return $this->hasManyThrough('App\Student', 'App\Stream');
    }


    //check whether a user has a role
    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)){
            return true;
        }
        abort(401,'This action is anauthirized.');
            
    }
    //check whether a user has any role
    public function hasAnyRole($roles){
        if (is_array($roles)){
            foreach ($roles as $role){
                if ($this->hasRole($role)){
                    return true;
                }
            }
        }else{
            if($this->hasRole($roles))
                return true;
        }
    }
    //check whether a user has a valid role
    public function hasRole($role){
        if($this->roles()->where('title', $role)->first()){
            return true; 
        
        //return $user->roles()->where('title','Admin')->exists();
            
          
        }return false;
    }
  
}