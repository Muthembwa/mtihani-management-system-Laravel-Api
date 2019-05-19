<?php
namespace App\Api\V1\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\streamResource;
use App\Stream;

class StreamController extends Controller
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
        return streamResource::collection(Stream::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stream = Stream::create([
            'id' => $request->id,
            'class_name' => $request->class_name ]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
