<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentYears = StudentYear::all();
        return view('backend.setup.studentYear.index',compact('studentYears'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.setup.studentYear.create');
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
            'name'=>'required|unique:student_years'
        ]);

        $studentYear = new StudentYear();
        $studentYear->name = $request->name;
        $studentYear->save();
        $notification = array(
            'message' => 'Student Year Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('studentYear.index')->with($notification);

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
        $studentYear = StudentYear::find($id);
        return view('backend.setup.studentYear.edit',compact('studentYear'));
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
        $studentYear = StudentYear::find($id);
        $validateData = $request->validate([
            'name'=>'required|unique:student_years,name,'.$studentYear->id
        ]);

        $studentYear->name = $request->name;
        $studentYear->save();
        $notification = array(
            'message' => 'Student Year Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('studentYear.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $studentYear = StudentYear::find($id);
        $studentYear->delete();
        $notification = array(
            'message' => 'Student Year Deleted Successfully!',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    }
}
