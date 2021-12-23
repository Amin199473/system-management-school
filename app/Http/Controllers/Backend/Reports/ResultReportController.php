<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\StudentMarks;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ResultReportController extends Controller
{
    public function ResultReport()
    {

        $years = StudentYear::all();
        $classes = StudentClass::all();
        $examTypes = ExamType::all();

        return view('backend.report.studentResult.index', compact([
            'years',
            'classes',
            'examTypes',
        ]));
    }

    public function GetResultReportStudent(Request $request)
    {

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;

        $singleResult = StudentMarks::where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->where('exam_type_id', $exam_type_id)
            ->first();

        if ($singleResult == true) {
            $data['allData'] = StudentMarks::select('year_id', 'class_id', 'exam_type_id', 'student_id','id_no')
                ->where('year_id', $year_id)->where('class_id', $class_id)
                ->where('exam_type_id', $exam_type_id)
                ->groupBy('year_id')
                ->groupBy('class_id')
                ->groupBy('exam_type_id')
                ->groupBy('student_id')
                ->groupBy('id_no')
                ->get();



            $pdf = PDF::loadView('backend.report.studentResult.generatePdf', $data);
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
        } else {
            $notification = array(
                'message' => 'Sorry These Criteria Does not match',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function StudentIdCard()
    {
        $years = StudentYear::all();
        $classes = StudentClass::all();

        return view('backend.report.IdCard.index', compact(['years', 'classes']));
    }


    public function GetStudentIDCard(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        $checke_data = AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->first();

        if ($checke_data == true) {
            $data['allData'] = AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->get();


            $pdf = PDF::loadView('backend.report.IdCard.generatePdf', $data);
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
        } else {
            $notification = array(
                'message' => 'Sorry These Criteria Does not match',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
