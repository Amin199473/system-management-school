<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
class AttendanceReportController extends Controller
{
    public function AttendanceReport()
    {

        $employees = User::where('user_type', 'Employee')->get();
        return view('backend.report.attendanceReport.index', compact('employees'));
    }

    public function GetReportAttendance(Request $request)
    {
        $employee_id = $request->employee_id;
        if($employee_id != ''){
            $where[] =['employee_id', $employee_id];
        }

        $date = date('Y-m',strtotime($request->date));

        if($date != ''){
            $where[] =['date','like', $date.'%'];
        }

        $singleAttendance = EmployeeAttendance::with('user')->where($where)->get();

        if($singleAttendance == true){
            $absents = EmployeeAttendance::with('user')->where($where)->where('attendance_status','Absent')->get()->count();
            $leaves= EmployeeAttendance::with('user')->where($where)->where('attendance_status','Leave')->get()->count();
            $month = date('m-Y',strtotime($request->date));

            $pdf = PDF::loadView('backend.report.attendanceReport.generatePdf', compact([
                'absents',
                'leaves',
                'singleAttendance',
                'month',
            ]));
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
        }else{
            $notification = array(
                'message' => 'Sorry These Criteria Does Not Match!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }


    }
}
