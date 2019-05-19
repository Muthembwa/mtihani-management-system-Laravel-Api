<?php

namespace App\Api\V1\Controllers;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use App\User;
use App\role;
use App\school;
use App\Http\Resources\userResource;
use Auth;

class UserController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.role:SuperAdmin');
    }
    
    /**Show all users as in the userResourse */
    public function index()
    { 
      

      return userResource::collection(User::with('roles')->paginate(25));
        }
       //$role_name = $user->role->name;  
      //return $role_name  ;
    
    
    /**store all users as in the userResourse */
    public function store(Request $request)
    {
      $user = User::create([
        'id' => $request->id,
        'name' => $request->name,
        'email' => $request->email,
        //'school'=> $request->school,
        'password' =>$request->password
        //'created_at' => (string)$request->created_at,
       // 'updated_at' => (string)$request->updated_at, 
       // 'role_id' => $request->role()->id,
        //'title' => $request->roles()->title,
      ]);
      //$roles = \App\role::get()->pluck('title', 'id')->prepend(trans('please Select'), '');
      return new userResource($user);
    }
    public function show(User $user)
    {
      return new userResource($user);
    }

    public function update(Request $request, User $user)
    {
      // check if currently authenticated user is the owner of the user
      if ($request->role()->id !== $user->role_id) {
        return response()->json(['error' => 'You can not edit users own users.'], 403);
      }

      $user->update($request->only(['name', 'email', 'password','school']));

      return new userResourse($user);
    }

    public function destroy(User $user)
    {
      $user->delete();

      return response()->json(null, 204);
    }
    
}
