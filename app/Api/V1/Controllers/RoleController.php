<?php                                                                                                                                 

namespace App\Api\V1\Controllers;
use App\User;
use App\role;
//use App\Http\Middleware\RoleAuthorization;
use App\Http\Resources\rolesResource;
use Illuminate\Http\Request;

class RoleController extends \App\Http\Controllers\Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth.role:ExamAdmin');
    }
    public function index()
    
    {
      $this->middleware('auth.role:SuperAdmin');
      $this->middleware('auth.role:ExamAdmin');
      return rolesResource::collection(role::all());
    }

    public function store(Request $request, User $user)
    {
      $role = role::firstOrCreate(
        [
          'id' => $request->id,
          'role' => $request->role,
          //'user_id' => $request->user()->id,
          
        ]);

      return new rolesResource($role);
    }
}
