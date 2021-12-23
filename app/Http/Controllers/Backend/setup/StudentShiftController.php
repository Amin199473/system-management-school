<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\StudentShift;
use Illuminate\Http\Request;

class StudentShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentShifts = StudentShift::all();
        return view('backend.setup.studentShift.index',compact('studentShifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.setup.studentShift.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'=>'required|unique:student_shifts'
        ]);

        $StudentShift = new StudentShift();
        $StudentShift->name = $request->name;
        $StudentShift->save();
        $notification = array(
            'message' => 'Student Shift Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('studentShift.index')->with($notification);

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
        $studentShift = StudentShift::find($id);
        return view('backend.setup.studentShift.edit',compact('studentShift'));
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
        $studentShift = StudentShift::find($id);
        $validateData = $request->validate([
            'name'=>'required|unique:student_shifts,name,'.$studentShift->id
        ]);

        $studentShift->name = $request->name;
        $studentShift->save();
        $notification = array(
            'message' => 'Student Shift Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('studentShift.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $studentShift = StudentShift::find($id);
        $studentShift->delete();
        $notification = array(
            'message' => 'Student Shift Deleted Successfully!',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    }
}
