<?php

namespace App\Http\Controllers\Backend\employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employeeAttendances = EmployeeAttendance::select('date')->groupBy('date')->orderBy('date','desc')->get();
        // dd($employeeAttendances);
        return view('backend.employees.employeeAttendance.index',compact('employeeAttendances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = User::where('user_type','Employee')->get();
        return view('backend.employees.employeeAttendance.create',compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $countEmployee = count($request->employee_id);
        for ($i=0; $i < $countEmployee ; $i++) {
            $attendance_status = 'attendance_status'.$i;
            $attend = new EmployeeAttendance();
            $attend->employee_id = $request->employee_id[$i];
            $attend->date = date('Y-m-d',strtotime($request->date));
            $attend->attendance_status = $request->$attendance_status;
            $attend->save();
        }

        $notification = array(
            'message' => 'Employee Attendance  Insterted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employeeAttendance.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($date)
    {
        $attendance = EmployeeAttendance::where('date',$date)->get();
        return view('backend.employees.employeeAttendance.edit',compact('attendance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $date)
    {

        EmployeeAttendance::where('date',date('Y-m-d',strtotime($date)))->delete();
        $countEmployee = count($request->employee_id);
        for ($i=0; $i < $countEmployee ; $i++) {
            $attendance_status = 'attendance_status'.$i;
            $attend = new EmployeeAttendance();
            $attend->employee_id = $request->employee_id[$i];
            $attend->date = date('Y-m-d',strtotime($request->date));
            $attend->attendance_status = $request->$attendance_status;
            $attend->save();
        }

        $notification = array(
            'message' => 'Employee Attendance  Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employeeAttendance.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($date)
    {
        $attendance = EmployeeAttendance::where('date',date('Y-m-d',strtotime($date)))->get();
        return view('backend.employees.employeeAttendance.details',compact('attendance'));
    }
}
