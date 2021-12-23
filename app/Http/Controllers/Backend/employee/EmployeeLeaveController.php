<?php

namespace App\Http\Controllers\Backend\employee;

use App\Models\User;
use App\Models\LeavePurpose;
use Illuminate\Http\Request;
use App\Models\EmployeeLeave;
use App\Http\Controllers\Controller;

class EmployeeLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employeeLeaves = EmployeeLeave::orderBy('id','desc')->get();
        return view('backend.employees.employeeLeave.index', compact('employeeLeaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = User::where('user_type', 'Employee')->get();
        $leavePurposes = LeavePurpose::all();
        return view('backend.employees.employeeLeave.create', compact('leavePurposes', 'employees'));
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
            'employee_id'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'leave_purpose_id'=>'required',
        ]);

        if ($request->leave_purpose_id == '0') {
            $leavePurpose = new LeavePurpose();
            $leavePurpose->name = $request->name;
            $leavePurpose->save();
            $leave_purpose_id = $leavePurpose->id;
        } else {
            $leave_purpose_id = $request->leave_purpose_id;
        }

        $employeeLeave = new EmployeeLeave();
        $employeeLeave->employee_id = $request->employee_id;
        $employeeLeave->leave_purpose_id = $leave_purpose_id;
        $employeeLeave->start_date = date('Y-m-d', strtotime($request->start_date));
        $employeeLeave->end_date = date('Y-m-d', strtotime($request->end_date));
        $employeeLeave->save();

        $notification = array(
            'message' => 'Employee Leave Purose  Done Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employeeLeave.index')->with($notification);
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
        $employeeLeave = EmployeeLeave::find($id);
        $employees = User::where('user_type', 'Employee')->get();
        $leavePurposes = LeavePurpose::all();
        return view('backend.employees.employeeLeave.edit', compact(
            [
                'employeeLeave',
                'employees',
                'leavePurposes'
            ]
        ));
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
        if ($request->leave_purpose_id == '0') {
            $leavePurpose = new LeavePurpose();
            $leavePurpose->name = $request->name;
            $leavePurpose->save();
            $leave_purpose_id = $leavePurpose->id;
        } else {
            $leave_purpose_id = $request->leave_purpose_id;
        }

        $employeeLeave =EmployeeLeave::find($id);
        $employeeLeave->employee_id = $request->employee_id;
        $employeeLeave->leave_purpose_id = $leave_purpose_id;
        $employeeLeave->start_date = date('Y-m-d', strtotime($request->start_date));
        $employeeLeave->end_date = date('Y-m-d', strtotime($request->end_date));
        $employeeLeave->save();

        $notification = array(
            'message' => 'Employee Leave Purose Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employeeLeave.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employeeLeave = EmployeeLeave::find($id);
        $employeeLeave->delete();
        $notification = array(
            'message' => 'Employee Leave Purose Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employeeLeave.index')->with($notification);
    }
}
