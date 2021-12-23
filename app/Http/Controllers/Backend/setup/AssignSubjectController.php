<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class AssignSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignSubjects = AssignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.setup.assignSubject.index',compact('assignSubjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schoolSubjects = SchoolSubject::all();
        $classes = StudentClass::all();
        return view('backend.setup.assignSubject.create',compact('schoolSubjects','classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'class_id'=>'required',
            'subject_id[]'=>'required',
            'full_mark[]'=>'required',
            'pass_mark[]'=>'required',
            'subjective_mark[]'=>'required',
        ]);
        $countSubject = count($request->subject_id);
        if ($countSubject != null) {
            for ($i = 0; $i < $countSubject; $i++) {
                $assignSubject = new AssignSubject();
                $assignSubject->class_id = $request->class_id;
                $assignSubject->subject_id = $request->subject_id[$i];
                $assignSubject->full_mark = $request->full_mark[$i];
                $assignSubject->pass_mark = $request->pass_mark[$i];
                $assignSubject->subjective_mark = $request->subjective_mark[$i];
                $assignSubject->save();
            }
        }

        $notification = array(
            'message' => 'Assign Subject Inserted  Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('assignSubject.index')->with($notification);
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
        $studentClasses = AssignSubject::where('class_id',$id)->orderBy('subject_id','asc')->get();
        $subjects = SchoolSubject::all();
        $classes = StudentClass::all();
        return view('backend.setup.assignSubject.edit',compact('studentClasses','subjects','classes'));

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
        if ($request->subject_id == null) {
            $notification = array(
                'message' => 'sorry You Do not select any Subject',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {
            $countSubject = count($request->subject_id);
            AssignSubject::where('class_id',$id)->delete();
                for ($i = 0; $i < $countSubject; $i++) {
                    $assignSubject = new AssignSubject();
                    $assignSubject->class_id = $request->class_id;
                    $assignSubject->subject_id = $request->subject_id[$i];
                    $assignSubject->full_mark = $request->full_mark[$i];
                    $assignSubject->pass_mark = $request->pass_mark[$i];
                    $assignSubject->subjective_mark = $request->subjective_mark[$i];
                    $assignSubject->save();
                }
            $notification = array(
                'message' => 'Assign Subject Updated  Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('assignSubject.index')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        $assignSubjects = AssignSubject::where('class_id', $id)->orderBy('subject_id', 'asc')->get();
        return view('backend.setup.assignSubject.details',compact('assignSubjects'));
    }
}
