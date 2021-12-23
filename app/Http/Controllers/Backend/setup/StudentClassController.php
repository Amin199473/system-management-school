<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentClasses = StudentClass::all();
        return view('backend.setup.studentClass.index',compact('studentClasses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.setup.studentClass.create');
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
            'name'=>'required|unique:student_classes'
        ]);

        $studentClass = new StudentClass();
        $studentClass->name = $request->name;
        $studentClass->save();
        $notification = array(
            'message' => 'Student Class Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('studentClass.index')->with($notification);

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
        $studentClass = StudentClass::find($id);
        return view('backend.setup.studentClass.edit',compact('studentClass'));
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
        $studentClass = StudentClass::find($id);
        $validateData = $request->validate([
            'name'=>'required|unique:student_classes,name,'.$studentClass->id
        ]);

        $studentClass->name = $request->name;
        $studentClass->save();
        $notification = array(
            'message' => 'Student Class Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('studentClass.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $studentClass = StudentClass::find($id);
        $studentClass->delete();
        $notification = array(
            'message' => 'Student Class Deleted Successfully!',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    }
}
