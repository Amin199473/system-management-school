<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentRollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = StudentYear::all();
        $classes = StudentClass::all();
        return view('backend.students.rollGenerate.rollGenerate', compact('years', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStudents(Request $request)
    {
        $assignStudent = AssignStudent::with('student')->where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
        return response()->json($assignStudent);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if ($request->student_id != null) {
            for ($i = 0; $i <count($request->student_id); $i++) {
                AssignStudent::where('year_id', $year_id)
                    ->where('class_id',$class_id)
                    ->where('student_id', $request->student_id[$i])
                    ->update([
                        'roll' => $request->roll[$i]
                    ]);
            }
            $notification = array(
                'message' => 'well Done Roll Generated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Sorry There are no Student',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
