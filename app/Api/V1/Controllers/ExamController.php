<?php
namespace App\Api\V1\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Exam;
use App\Http\Resources\examResource;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return examResource::collection(Exam::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $exam = Exam::create([
            'id'=>$request->id,
            'examname'=>$request->examname,
            'term'=>$request->term,
            'exam_code'=>$request->exam_code
        ]);
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
        if($exam = Exam::find($id)){
            return new examResource ($exam);
        } 
        return response()->json([
            'status'=> 'The Exam does not exist'
        ],404);
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
        if ($exam = Exam::find($id)){
            $exam->update($request->only(['examname','term','exam_code']));
            return response()->json([
                'status' => 'Exam updated'
            ], 201);
        }
        return response()->json([
            'status' => 'This Exam does not exist'
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
        if ($exam=Exam::find($id)){
            $exam->delete();
            return response()->json([
                'status' => 'Deleted'
            ], 200);}
            return response()->json([
                'status' => 'This Exam does not exist'
            ], 404);
    }
}
