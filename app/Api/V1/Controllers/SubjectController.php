<?php

namespace App\Api\V1\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subject;
Use App\Http\Resources\subjectResource;


class SubjectController extends Controller
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
        return subjectResource::collection(Subject::all());  
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subject = Subject::create([
            'id' => $request->id,
            'subjectname' => $request->subjectname,
            'subject_code' => $request ->subject_code ]);
            return response()->json([
                'status' => 'Created'
            ], 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($subject = Subject::find($id)){
            return new subjectResource($subject);	
        }
        return response()->json([
            'status' => 'This Subject does not exist'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($subject = Subject::find($id)){
            $subject->update($request->only(['subjectname','subject_code']));
            return new subjectResource($subject);
        }
        return response()->json([
            'status' => 'This Subject does not exist'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)  
    {
        if ($subject=Subject::find($id)){
            $subject->delete();
            return response()->json([
                'status' => 'Deleted'
            ], 200);}
            return response()->json([],204);
    }
}
