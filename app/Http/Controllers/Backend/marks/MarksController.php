<?php

namespace App\Http\Controllers\Backend\marks;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\AssignSubject;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\StudentMarks;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class MarksController extends Controller
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
        $examTypes = ExamType::all();
        return view('backend.marks.mark.index', compact('years', 'classes', 'examTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $class_id = $request->class_id;
        $subjects = AssignSubject::with('school_subject')->where('class_id', $class_id)->get();

        return response()->json($subjects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function GetStudents(Request $request)

    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $students = AssignStudent::with('student')->where('year_id', $year_id)->where('class_id', $class_id)->get();
        return response()->json($students);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function marksEntryStore(Request $request)
    {

        $studentCount = count($request->student_id);
        if ($studentCount) {
            for ($i = 0; $i < $studentCount; $i++) {
                $assignMarks = new StudentMarks();
                $assignMarks->year_id = $request->year_id;
                $assignMarks->class_id = $request->class_id;
                $assignMarks->assign_subject_id = $request->assign_subject_id;
                $assignMarks->exam_type_id = $request->exam_type_id;
                $assignMarks->student_id = $request->student_id[$i];
                $assignMarks->id_no = $request->id_no[$i];
                $assignMarks->marks = $request->marks[$i];
                $assignMarks->save();
            }
            $notification = array(
                'message' => 'Student marks Inserted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }



    public function marksEdit()
    {

        $years = StudentYear::all();
        $classes = StudentClass::all();
        $examTypes = ExamType::all();
        return view('backend.marks.mark.marksEdit', compact('years', 'classes', 'examTypes'));
    }


    public function marksGetStudentsEdit(Request $request)
    {

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $assign_subject_id = $request->assign_subject_id;
        $exam_type_id = $request->exam_type_id;

        $getStrudent = StudentMarks::with('student')->where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->where('assign_subject_id', $assign_subject_id)
            ->where('exam_type_id', $exam_type_id)
            ->get();

        return response()->json($getStrudent);
    }


    public function marksGetStudentsUpdate(Request $request)
    {

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $assign_subject_id = $request->assign_subject_id;
        $exam_type_id = $request->exam_type_id;

        StudentMarks::where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->where('assign_subject_id', $assign_subject_id)
            ->where('exam_type_id', $exam_type_id)
            ->delete();

        $studentCount = count($request->student_id);
        if ($studentCount) {
            for ($i = 0; $i < $studentCount; $i++) {
                $assignMarks = new StudentMarks();
                $assignMarks->year_id = $request->year_id;
                $assignMarks->class_id = $request->class_id;
                $assignMarks->assign_subject_id = $request->assign_subject_id;
                $assignMarks->exam_type_id = $request->exam_type_id;
                $assignMarks->student_id = $request->student_id[$i];
                $assignMarks->id_no = $request->id_no[$i];
                $assignMarks->marks = $request->marks[$i];
                $assignMarks->save();
            }
            $notification = array(
                'message' => 'Student marks Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }
}
