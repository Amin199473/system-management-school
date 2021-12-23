<?php

namespace App\Http\Controllers\Backend\accountsManagement;

use App\Models\FeeCategory;
use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\AccountStudentFee;
use App\Models\FeeCategoryAmount;
use App\Http\Controllers\Controller;

class StudentFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentFees = AccountStudentFee::all();
        return view('backend.accountsManagement.studentFee.index', compact('studentFees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $feeCategories = FeeCategory::all();
        return view('backend.accountsManagement.studentFee.create', compact(
            [
                'years',
                'classes',
                'feeCategories'
            ]
        ));
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
        AccountStudentFee::where('year_id', $request->year_id)->where('class_id', $request->class_id)
            ->where('fee_category_id',$request->fee_category_id)->where('date', $date)->delete();

        $chackData = $request->checkmanage;
        if($chackData != null){
            for ($i=0; $i <count($chackData) ; $i++) {
                $studentFee = new AccountStudentFee();
                $studentFee->year_id = $request->year_id;
                $studentFee->class_id =$request->class_id;
                $studentFee->fee_category_id = $request->fee_category_id;
                $studentFee->student_id = $request->student_id[$chackData[$i]];
                $studentFee->amount = $request->amount[$chackData[$i]];
                $studentFee->date = $date;
                $studentFee->save();
            }
        }
        if(!empty(@$studentFee) || empty($chackData)){
            $notification = array(
                'message' => 'Well Done Data Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('studentFee.index')->with($notification);
        }else
        {
            $notification = array(
                'message' => 'sorry data not saved',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    //Action method for ajax request
    public function StudentFeeGet(Request $request)
    {

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $fee_category_id = $request->fee_category_id;
        $date = date('Y-m', strtotime($request->date));

        $data = AssignStudent::with(['discount'])->where('year_id', $year_id)->where('class_id', $class_id)->get();

        $html['thsource']  = '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Father Name</th>';
        $html['thsource'] .= '<th>Original Fee </th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th>Fee (This Student)</th>';
        $html['thsource'] .= '<th>Select</th>';

        foreach ($data as $key => $std) {
            $registrationfee = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->where('class_id', $std->class_id)->first();
            $accountstudentfees = AccountStudentFee::where('student_id', $std->student_id)->where('year_id', $std->year_id)->where('class_id', $std->class_id)->where('fee_category_id', $fee_category_id)->where('date', $date)->first();

            if ($accountstudentfees != null) {
                $checked = 'checked';
            } else {
                $checked = '';
            }

            $html[$key]['tdsource']  = '<td>' . $std['student']['id_no'] . '<input type="hidden" name="fee_category_id" value= " ' . $fee_category_id . ' " >' . '</td>';
            $html[$key]['tdsource']  .= '<td>' . $std['student']['name'] . '<input type="hidden" name="year_id" value= " ' . $std->year_id . ' " >' . '</td>';
            $html[$key]['tdsource']  .= '<td>' . $std['student']['father_name'] . '<input type="hidden" name="class_id" value= " ' . $std->class_id . ' " >' . '</td>';
            $html[$key]['tdsource']  .= '<td>' . $registrationfee->amount . '$' . '<input type="hidden" name="date" value= " ' . $date . ' " >' . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $std['discount']['discount'] . '%' . '</td>';

            $orginalfee = $registrationfee->amount;
            $discount = $std['discount']['discount'];
            $discountablefee = $discount / 100 * $orginalfee;
            $finalfee = (int)$orginalfee - (int)$discountablefee;

            $html[$key]['tdsource'] .= '<td>' . '<input type="text" name="amount[]" value="' . $finalfee . ' " class="form-control" readonly>' . '</td>';
            $html[$key]['tdsource'] .= '<td>' . '<input type="hidden" name="student_id[]" value="' . $std->student_id . '">' . '<input type="checkbox" name="checkmanage[]" id="id' . $key . '" value="' . $key . '" ' . $checked . ' style="transform: scale(1.5);margin-left: 10px;"> <label for="id' . $key . '"> </label> ' . '</td>';
        }
        return response()->json(@$html);
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
