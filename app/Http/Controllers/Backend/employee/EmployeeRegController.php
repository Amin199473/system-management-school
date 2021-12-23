<?php

namespace App\Http\Controllers\Backend\employee;

use App\Models\User;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRegRequest;
use App\Models\EmployeeSalaryLog;
use PDF;
class EmployeeRegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $employees = User::where('user_type', 'Employee')->get();
        return view('backend.employees.employeeReg.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designations = Designation::all();
        return view('backend.employees.employeeReg.create', compact('designations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRegRequest $request)
    {
        dd($request);
        DB::transaction(function () use ($request) {
            $checkYear = date('Ym', strtotime($request->join_date));
            $employee = User::where('user_type', 'Employee')->orderBy('id', 'DESC')->first();
            if ($employee == null) {
                $firstReg = 0;
                $employeeID = $firstReg + 1;
                if ($employeeID < 10) {
                    $id_no = '000' . $employeeID;
                } elseif ($employeeID < 100) {
                    $id_no = '00' . $employeeID;
                } elseif ($employeeID < 1000) {
                    $id_no = '0' . $employeeID;
                }
            } else {
                $employee = User::where('user_type', 'Employee')->orderBy('id', 'DESC')->first()->id;
                $employeeID = $employee + 1;

                if ($employeeID < 10) {
                    $id_no = '000' . $employeeID;
                } elseif ($employeeID < 100) {
                    $id_no = '00' . $employeeID;
                } elseif ($employeeID < 1000) {
                    $id_no = '0' . $employeeID;
                }
            }

            $final_id_no = $checkYear . $id_no;
            $user = new User();
            $code = rand(00000, 99999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->user_type = 'Employee';
            $user->code = $code;
            $user->name = $request->name;
            $user->father_name = $request->father_name;
            $user->mother_name = $request->mother_name;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->designation_id = $request->designation_id;
            $user->salary = $request->salary;
            $user->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
            $user->join_date = date('Y-m-d', strtotime($request->join_date));
            //upload Profile Image
            if ($request->hasFile('image')) {
                $photo = $request->file('image');
                $filename = 'Avatar' . '_' . time() . '.' . $photo->getClientOriginalExtension();
                $location = public_path('upload/employee_images');
                $request->file('image')->move($location, $filename);
            }
            $user->image = $filename;
            $user->save();


            $employeeSalary = new EmployeeSalaryLog();
            $employeeSalary->employee_id = $user->id;
            $employeeSalary->effected_salary = date('Y-m-d', strtotime($request->join_date));
            $employeeSalary->previous_salary = $request->salary;
            $employeeSalary->present_salary = $request->salary;
            $employeeSalary->increment_salary = '0';
            $employeeSalary->save();
        });

        $notification = array(
            'message' => 'Employee Registration Done Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employeeRegistration.index')->with($notification);
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
        $employee = User::find($id);
        $designations = Designation::all();
        return view('backend.employees.employeeReg.edit',compact('designations','employee'));
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

            $user =User::find($id);
            $user->name = $request->name;
            $user->father_name = $request->father_name;
            $user->mother_name = $request->mother_name;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->designation_id = $request->designation_id;
            $user->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
            ;
            //upload Profile Image
            if ($request->hasFile('image')) {
                $photo = $request->file('image');
                @unlink(public_path('upload/employee_images/'.$user->image));
                $filename = 'Avatar' . '_' . time() . '.' . $photo->getClientOriginalExtension();
                $location = public_path('upload/employee_images');
                $request->file('image')->move($location, $filename);
                $user->image = $filename;
            }

            $user->save();


        $notification = array(
            'message' => 'Employee Updated  Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employeeRegistration.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        $employee = User::find($id);
        $pdf = PDF::loadView('backend.employees.employeeReg.generatePdf', compact('employee'));
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
