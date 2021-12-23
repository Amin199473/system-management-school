<?php

namespace App\Http\Controllers\Backend\marks;

use App\Http\Controllers\Controller;
use App\Models\MarksGrade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = MarksGrade::all();
        return view('backend.marks.grade.index',compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.marks.grade.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $grade = new MarksGrade();
        $grade->grade_name = $request->grade_name;
        $grade->grade_point = $request->grade_point;
        $grade->start_marks = $request->start_marks;
        $grade->end_marks = $request->end_marks;
        $grade->start_point = $request->start_point;
        $grade->end_point = $request->end_point;
        $grade->remarks = $request->remarks;
        $grade->save();

        $notification = array(
            'message' => 'Grade Marks Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('marksGrade.index')->with($notification);
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
        $grade = MarksGrade::find($id);
        return view('backend.marks.grade.edit',compact('grade'));
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
        $grade = MarksGrade::find($id);
        $grade->grade_name = $request->grade_name;
        $grade->grade_point = $request->grade_point;
        $grade->start_marks = $request->start_marks;
        $grade->end_marks = $request->end_marks;
        $grade->start_point = $request->start_point;
        $grade->end_point = $request->end_point;
        $grade->remarks = $request->remarks;
        $grade->save();

        $notification = array(
            'message' => 'Grade Marks Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('marksGrade.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grade = MarksGrade::find($id);
        $grade->delete();
        $notification = array(
            'message' => 'Grade Marks deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }
}
