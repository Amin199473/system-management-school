<?php

namespace App\Http\Controllers\Backend\student;

use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\FeeCategoryAmount;
use App\Http\Controllers\Controller;
use App\Models\ExamType;
use PDF;

class ExamFeeController extends Controller
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
        return view('backend.students.examFee.index',compact('years','classes','examTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if ($year_id != '') {
            $where[] = ['year_id', 'like', $year_id . '%'];
        }
        if ($class_id != '') {
            $where[] = ['class_id', 'like', $class_id . '%'];
        }

        $allStudent = AssignStudent::with(['discount'])->where($where)->get();

        // dd($allStudent);
        $html['thsource']  = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll No</th>';
        $html['thsource'] .= '<th>Exam Fee</th>';
        $html['thsource'] .= '<th>Discount </th>';
        $html['thsource'] .= '<th>Student Fee </th>';
        $html['thsource'] .= '<th>Action</th>';


        foreach ($allStudent as $key => $v) {

            $registrationfee = FeeCategoryAmount::where('fee_category_id', '3')->where('class_id', $v->class_id)->first();

            $color = 'success';
            $html[$key]['tdsource']  = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v['student']['id_no'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v['student']['name'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v->roll . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $registrationfee->amount . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v['discount']['discount'] . '%' . '</td>';

            $originalfee = $registrationfee->amount;
            $discount = $v['discount']['discount'];
            $discounttablefee = $discount / 100 * $originalfee;
            $finalfee = (float)$originalfee - (float)$discounttablefee;

            $html[$key]['tdsource'] .= '<td>' . $finalfee . '$' . '</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-' . $color . '" title="PaySlip" target="_blanks" href="' . route('examFee.paySlip') . '?class_id=' . $v->class_id . '&student_id=' . $v->student_id .'&examType_id='.$request->examType_id.'">Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ExamFeePaySlip(Request $request)
    {
        $student_id = $request->student_id;
        $class_id = $request->class_id;
        $examType = ExamType::where('id',$request->examType_id)->first();
        $assignStudent = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->where('class_id',$class_id)->first();
        $registrationfee = FeeCategoryAmount::where('fee_category_id', '3')->where('class_id', $assignStudent->class_id)->first();

        $originalfee = $registrationfee->amount;
        $discount = $assignStudent['discount']['discount'];
        $discounttablefee = ($discount / 100) * $originalfee;
        $finalfee = (float) $originalfee - (float) $discounttablefee;


        // dd($originalfee);
        $pdf = PDF::loadView('backend.students.examFee.generatePdf', compact([
            'assignStudent',
            'finalfee',
            'originalfee',
            'discounttablefee',
            'examType'
        ]));
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

}
