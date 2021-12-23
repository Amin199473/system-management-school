<?php

namespace App\Http\Controllers\Backend\employee;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EmployeeSalaryLog;

class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = User::where('user_type', 'Employee')->get();
        return view('backend.employees.employeeSalary.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function IncrementSalary($id)
    {
        $employee = User::find($id);
        return view('backend.employees.employeeSalary.increment', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UpdateIncrementSalary(Request $request, $id)
    {

        $validate = $request->validate([
            'increment_salary'=>'required',
            'effected_salary'=>'required'
        ]);
        $employee = User::find($id);
        $previuos_salary = $employee->salary;
        $present_salary = (float)$previuos_salary + (float)$request->increment_salary;
        $employee->salary = $present_salary;
        $employee->save();

        $salaryUpdate = new EmployeeSalaryLog();
        $salaryUpdate->employee_id = $id;
        $salaryUpdate->previous_salary = $previuos_salary;
        $salaryUpdate->increment_salary = $request->increment_salary;
        $salaryUpdate->present_salary = $present_salary;
        $salaryUpdate->effected_salary = date('Y-m-d', strtotime($request->effected_salary));
        $salaryUpdate->save();


        $notification = array(
            'message' => 'Employee Salary Increment Done Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employeeSalary.index')->with($notification);
    }

    public function EmployeeSalaryDetails($id)
    {
        $employee = User::find($id);
        $salaryLogs = EmployeeSalaryLog::where('employee_id', $employee->id)->get();

        return view('backend.employees.employeeSalary.details', compact('employee','salaryLogs'));
    }
}
