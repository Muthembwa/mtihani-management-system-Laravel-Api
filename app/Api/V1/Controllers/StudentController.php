<?php
namespace App\Api\V1\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Http\Resources\studentResource;

class StudentController extends Controller
{
    
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.role:SuperAdmin');
       // $this->middleware('auth.role:SchoolAdmin',['only' => ['show']]);
        //$this->middleware('auth.role:ExamTeacher',['only' => [ 'update', 'show', 'destroy']]);
       // $this->middleware('auth.role:ClassTeacher',['only' => [ 'store','update', 'show', 'destroy']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return studentResource::collection(Student::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //storing a student
         $student = Student::create([
            'id' => $request->id,
            'adm_no' => $request->adm_no,
            'student_name' => $request->student_name,
            'parents_name' => $request->parents_name ,
            'parents_email' => $request->parents_email,
            'parents_phone_no' => $request->parents_phone_no,  ]);
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
		if ($student = Student::find($id)){
            return new studentResource($student);	
        }
        return response()->json([
            'status' => 'This candidate does not exist'
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
		$student = Student::findOrFail($id);
        $student->update($request->only(['adm_no','student_name','stream','parents_name','parents_email','parents_phone_no']));
        return new studentResource($student);	
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($student=Student::find($id)->delete()){
            return response()->json([
                'status' => 'Deleted'
            ], 200);}
    }
}
