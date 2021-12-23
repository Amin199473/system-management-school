<?php

namespace App\Http\Controllers\Backend\employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class MonthlySalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.employees.monthlySalary.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));

        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }


        $attendance = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with('user')->where($where)->get();

        $html['thsource']  = '<th>SL</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salry</th>';
        $html['thsource'] .= '<th>Salary This month</th>';
        $html['thsource'] .= '<th>Action</th>';


        foreach ($attendance as $key => $attend) {

            $totalAttendance = EmployeeAttendance::with('user')->where($where)->where('employee_id', $attend->employee_id)->get();
            $absentCount = count($totalAttendance->where('attendance_status', 'Absent'));

            $color = 'success';
            $html[$key]['tdsource']  = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['name'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['salary'] . '</td>';

            $salary = $attend['user']['salary'];
            $salaryPerDay = (float)$salary / 30;
            $totalSalaryMinus = (float)$absentCount * (float)$salaryPerDay;
            $totalSalary = (float)$salary - (float)$totalSalaryMinus;

            $html[$key]['tdsource'] .= '<td>' . $totalSalary . '$' . '</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-' . $color . '" title="PaySlip" target="_blanks" href="' . route('monthlySalary.show', $attend->employee_id) . '">Fee Slip</a>';
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $employee = EmployeeAttendance::where('employee_id', $id)->first();
        $date = date('Y-m', strtotime($employee->date));
        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }

        $details = EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$id)->get();
        $salary = $details[0]['user']['salary'];
        $salaryPerDay = (float)$salary / 30;
        $absentCount = count($details->where('attendance_status', 'Absent'));
        $totalSalaryMinus = (float)$absentCount * (float)$salaryPerDay;
        $totalSalary = (float)$salary - (float)$totalSalaryMinus;

        $pdf = PDF::loadView('backend.employees.monthlySalary.generatePdf', compact([
            'details',
            'salaryPerDay',
            'absentCount',
            'totalSalaryMinus',
            'totalSalary'
        ]));
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
