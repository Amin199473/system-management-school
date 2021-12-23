<?php

namespace App\Http\Controllers\Backend\accountsManagement;

use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;

class AccountsEmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employeeSalaries = AccountEmployeeSalary::all();
        return view('backend.accountsManagement.accountEmployeeSalary.index',compact('employeeSalaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.accountsManagement.accountEmployeeSalary.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $date = date('Y-m', strtotime($request->date));
        AccountEmployeeSalary::where('date', $date)->delete();

        $chackData = $request->checkmanage;
        if($chackData != null){
            for ($i=0; $i <count($chackData) ; $i++) {
                $accountEmployeeSalary = new AccountEmployeeSalary();
                $accountEmployeeSalary->employee_id =$request->employee_id[$chackData[$i]];
                $accountEmployeeSalary->amount = $request->amount[$chackData[$i]];
                $accountEmployeeSalary->date = $date;
                $accountEmployeeSalary->save();
            }
        }
        if(!empty(@$accountEmployeeSalary) || empty($chackData)){
            $notification = array(
                'message' => 'Well Done Data Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('accountEmployeeSalary.index')->with($notification);
        }else
        {
            $notification = array(
                'message' => 'sorry data not saved',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }


    public function accountSalaryGetEmployee(Request $request){

        $date = date('Y-m', strtotime($request->date));

        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }


        $attendance = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with('user')->where($where)->get();

        $html['thsource']  = '<th>SL</th>';
        $html['thsource'] .= '<th>ID NO</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salry</th>';
        $html['thsource'] .= '<th>Salary This month</th>';
        $html['thsource'] .= '<th>select</th>';

        foreach ($attendance as $key => $attend) {
            $account_salary =AccountEmployeeSalary::where('employee_id',$attend->employee_id)->where($where)->first();


            if ($account_salary != null) {
                $checked = 'checked';
            } else {
                $checked = '';
            }

            $totalAttendance = EmployeeAttendance::with('user')->where($where)->where('employee_id', $attend->employee_id)->get();
            $absentCount = count($totalAttendance->where('attendance_status', 'Absent'));

            $color = 'success';
            $html[$key]['tdsource']  = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['id_no'].
            '<input type ="hidden" name ="date" value="'.$date.'">'
            . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['name'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['salary'] . '</td>';

            $salary = $attend['user']['salary'];
            $salaryPerDay = (float)$salary / 30;
            $totalSalaryMinus = (float)$absentCount * (float)$salaryPerDay;
            $totalSalary = (float)$salary - (float)$totalSalaryMinus;

            $html[$key]['tdsource'] .= '<td>' . $totalSalary . '<input type ="hidden" name ="amount[]" value="'.$totalSalary.'">' . '</td>';

            $html[$key]['tdsource'] .= '<td>' . '<input type="hidden" name="employee_id[]" value="' . $attend->employee_id . '">' . '<input type="checkbox" name="checkmanage[]" id="id' . $key . '" value="' . $key . '" ' . $checked . ' style="transform: scale(1.5);margin-left: 10px;"> <label for="id' . $key . '"> </label> ' . '</td>';
        }
        return response()->json(@$html);

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
