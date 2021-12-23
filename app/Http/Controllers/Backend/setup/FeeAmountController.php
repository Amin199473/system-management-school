<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class FeeAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$feeAmounts = FeeCategoryAmount::all();
        $feeAmounts = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.feeAmount.index', compact('feeAmounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $feeCategories = FeeCategory::all();
        $classes = StudentClass::all();
        return view('backend.setup.feeAmount.create', compact('feeCategories', 'classes'));
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
            'fee_category_id'=>'required',
            'class_id[]'=>'required',
            'amount[]'=>'required',
        ]);

        $countClass = count($request->class_id);
        if ($countClass != null) {
            for ($i = 0; $i < $countClass; $i++) {
                $feeCategoryAmount = new FeeCategoryAmount();
                $feeCategoryAmount->fee_category_id = $request->fee_category_id;
                $feeCategoryAmount->class_id = $request->class_id[$i];
                $feeCategoryAmount->amount = $request->amount[$i];
                $feeCategoryAmount->save();
            }
        }

        $notification = array(
            'message' => 'Fee Amount Inserted  Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('feeAmount.index')->with($notification);
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
        $feeAmounts = FeeCategoryAmount::where('fee_category_id', $id)->orderBy('class_id', 'asc')->get();
        $feeCategories = FeeCategory::all();
        $classes = StudentClass::all();
        return view('backend.setup.feeAmount.edit', compact('feeAmounts', 'feeCategories', 'classes'));
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
        if ($request->class_id == null) {
            $notification = array(
                'message' => 'sorry You Do not select any Class Amount',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {

            $countClass = count($request->class_id);
            FeeCategoryAmount::where('fee_category_id', $id)->delete();
            for ($i = 0; $i < $countClass; $i++) {
                $feeCategoryAmount = new FeeCategoryAmount();
                $feeCategoryAmount->fee_category_id = $request->fee_category_id;
                $feeCategoryAmount->class_id = $request->class_id[$i];
                $feeCategoryAmount->amount = $request->amount[$i];
                $feeCategoryAmount->save();
            }
            $notification = array(
                'message' => 'Fee Amount Updated  Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('feeAmount.index')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        $feeAmounts = FeeCategoryAmount::where('fee_category_id', $id)->orderBy('class_id', 'asc')->get();
        return view('backend.setup.feeAmount.details',compact('feeAmounts'));
    }
}
