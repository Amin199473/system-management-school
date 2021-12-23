<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examTypes = ExamType::all();
        return view('backend.setup.examType.index',compact('examTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.setup.examType.create');
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
            'name'=>'required|unique:exam_types'
        ]);

        $examType= new ExamType();
        $examType->name = $request->name;
        $examType->save();
        $notification = array(
            'message' => 'Exam Type Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('examType.index')->with($notification);

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
        $examType = ExamType::find($id);
        return view('backend.setup.examType.edit',compact('examType'));
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
        $examType = ExamType::find($id);
        $validateData = $request->validate([
            'name'=>'required|unique:exam_types,name,'.$examType->id
        ]);

        $examType->name = $request->name;
        $examType->save();
        $notification = array(
            'message' => 'Exam Type Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('examType.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $examType = ExamType::find($id);
        $examType->delete();
        $notification = array(
            'message' => 'Exam Type Deleted Successfully!',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    }
}
