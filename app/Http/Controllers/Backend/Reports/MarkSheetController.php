<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\MarksGrade;
use App\Models\StudentClass;
use App\Models\StudentMarks;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class MarkSheetController extends Controller
{
    public function markSheet()
    {

        $years = StudentYear::orderBy('id', 'desc')->get();
        $classes = StudentClass::all();
        $examTypes = ExamType::all();
        return view('backend.report.markSheet.index', compact([
            'years',
            'classes',
            'examTypes'
        ]));
    }

    public function GetReportMarkSheet(Request $request)
    {

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $id_no = $request->id_no;

        $count_fail = StudentMarks::where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->where('exam_type_id', $exam_type_id)
            ->where('id_no', $id_no)
            ->where('marks', '<', '33')
            ->get()->count();

        $singleStudent = StudentMarks::where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->where('exam_type_id', $exam_type_id)
            ->where('id_no', $id_no)
            ->first();

        if ($singleStudent == true) {

            $allMarks = StudentMarks::with(['assign_subject', 'year'])
                ->where('year_id', $year_id)
                ->where('class_id', $class_id)
                ->where('exam_type_id', $exam_type_id)
                ->where('id_no', $id_no)
                ->get();

            $allGrades = MarksGrade::all();

            return view('backend.report.markSheet.markSheetPdf',compact([
                'count_fail',
                'allMarks',
                'allGrades',
            ]));
        }else{
            $notification = array(
                'message' => 'Sorry These Criteria Does Not Match!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }
}
