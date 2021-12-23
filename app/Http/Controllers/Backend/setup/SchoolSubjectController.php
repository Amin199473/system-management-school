<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;

class SchoolSubjectController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schoolSubjects = SchoolSubject::all();
        return view('backend.setup.schoolSubject.index',compact('schoolSubjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.setup.schoolSubject.create');
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
            'name'=>'required|unique:school_subjects'
        ]);

        $schoolSubject = new SchoolSubject();
        $schoolSubject->name = $request->name;
        $schoolSubject->save();
        $notification = array(
            'message' => 'School Subject Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('schoolSubject.index')->with($notification);

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
        $schoolSubject = SchoolSubject::find($id);
        return view('backend.setup.schoolSubject.edit',compact('schoolSubject'));
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
        $schoolSubject = SchoolSubject::find($id);
        $validateData = $request->validate([
            'name'=>'required|unique:School_subjects,name,'.$schoolSubject->id
        ]);

        $schoolSubject->name = $request->name;
        $schoolSubject->save();
        $notification = array(
            'message' => 'School Subject Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('schoolSubject.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schoolSubject = SchoolSubject::find($id);
        $schoolSubject->delete();
        $notification = array(
            'message' => 'School Subject Deleted Successfully!',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    }
}
