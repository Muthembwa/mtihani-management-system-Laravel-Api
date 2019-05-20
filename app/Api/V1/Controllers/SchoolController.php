<?php

namespace App\Api\V1\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\schoolResource;
use App\school;
use App\User;
//use App\role;


class SchoolController extends Controller
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        return schoolResource::collection(school::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //storing a school
        $school = school::create([
            'id' => $request->id,
            'schoolname' => $request->schoolname ]);
            return response()->json([
                'status' => 'Created'
            ], 201);

    }
    	/**
	 * Show-Action
	 *
	 * @param Request $request
	 * @param int $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show(Request $request, $id)
	{
		$school = school::find($id);
 
        return new schoolResource($school);	}

    	/**
	 * Update-Action
	 *
	 * @param Request $request
	 * @param int $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request, $id)
	{
		$school = school::findOrFail($id);
		$school->update($request->only('schoolname'));

        return new schoolResource($school);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
	{
		if ($school=school::find($id)->delete()){
            return response()->json([
                'status' => 'Deleted'
            ], 201);}
        else{ return response()->json([
            'status' => 'Hio shule haiko man'
        ], 204);}
    }
    


    	
}
