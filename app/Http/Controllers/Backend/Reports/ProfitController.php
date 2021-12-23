<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;
use App\Models\AccountOtherCost;
use App\Models\AccountStudentFee;
use Illuminate\Http\Request;
use PDF;
class ProfitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function MonthlyProfit()
    {
        return view('backend.report.profit.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function GetMonthlyProfit(Request $request)
    {
        $start_date = date('Y-m', strtotime($request->start_date));
        $end_date = date('Y-m', strtotime($request->end_date));
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));

        $student_fee = AccountStudentFee::whereBetween('date', [$start_date, $end_date])->sum('amount');
        $other_cost = AccountOtherCost::whereBetween('date', [$sdate, $edate])->sum('amount');
        $emp_salary = AccountEmployeeSalary::whereBetween('date', [$start_date, $end_date])->sum('amount');


        $total_cost = $other_cost + $emp_salary;
        $profit = $student_fee - $total_cost;

        $html['thsource']  = '<th>Student Fee</th>';
        $html['thsource'] .= '<th>Other Cost</th>';
        $html['thsource'] .= '<th>Employee Salary</th>';
        $html['thsource'] .= '<th>Total Cost</th>';
        $html['thsource'] .= '<th>Profit </th>';
        $html['thsource'] .= '<th>Action</th>';

        $color = 'success';
        $html['tdsource']  = '<td>' . $student_fee . '$</td>';
        $html['tdsource']  .= '<td>' . $other_cost . '$</td>';
        $html['tdsource']  .= '<td>' . $emp_salary . '$</td>';
        $html['tdsource']  .= '<td>' . $total_cost . '$</td>';
        $html['tdsource']  .= '<td>' . $profit . '$</td>';
        $html['tdsource'] .= '<td>';
        $html['tdsource'] .= '<a class="btn btn-sm btn-' . $color . '" title="PDF" target="_blanks" href="' . route('reportProfitPDF') . '?start_date=' . $sdate . '&end_date=' . $edate . '">Pay Slip</a>';
        $html['tdsource'] .= '</td>';

        return response()->json(@$html);


        return response()->json(@$html);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ReportProfitPDF(Request $request)
    {
        $start_date = date('Y-m', strtotime($request->start_date));
        $end_date = date('Y-m', strtotime($request->end_date));
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));


        $student_fee = AccountStudentFee::whereBetween('date', [$start_date, $end_date])->sum('amount');
        $other_cost = AccountOtherCost::whereBetween('date', [$sdate, $edate])->sum('amount');
        $emp_salary = AccountEmployeeSalary::whereBetween('date', [$start_date, $end_date])->sum('amount');


        $total_cost = $other_cost + $emp_salary;
        $profit = $student_fee - $total_cost;


        $pdf = PDF::loadView('backend.report.profit.generatePdf', compact([
            'sdate',
            'edate',
            'student_fee',
            'other_cost',
            'emp_salary',
            'total_cost',
            'profit',
        ]));
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
