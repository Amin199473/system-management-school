<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\StudentGroup;
use Illuminate\Http\Request;

class StudentGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentGroups = StudentGroup::all();
        return view('backend.setup.studentGroup.index',compact('studentGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.setup.studentGroup.create');
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
            'name'=>'required|unique:student_groups'
        ]);

        $studentGroup = new StudentGroup();
        $studentGroup->name = $request->name;
        $studentGroup->save();
        $notification = array(
            'message' => 'Student Group Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('studentGroup.index')->with($notification);

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
        $studentGroup = StudentGroup::find($id);
        return view('backend.setup.StudentGroup.edit',compact('studentGroup'));
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
        $studentGroup = StudentGroup::find($id);
        $validateData = $request->validate([
            'name'=>'required|unique:student_groups,name,'.$studentGroup->id
        ]);

        $studentGroup->name = $request->name;
        $studentGroup->save();
        $notification = array(
            'message' => 'Student Group Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('studentGroup.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $studentGroup = StudentGroup::find($id);
        $studentGroup->delete();
        $notification = array(
            'message' => 'Student Group Deleted Successfully!',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    }
}
