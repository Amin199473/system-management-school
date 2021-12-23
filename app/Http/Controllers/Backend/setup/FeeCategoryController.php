<?php

namespace App\Http\Controllers\Backend\setup;

use App\Models\FeeCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feeCategories = FeeCategory::all();
        return view('backend.setup.feeCategory.index',compact('feeCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.setup.feeCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'=>'required|unique:fee_categories'
        ]);

        $feeCategory = new FeeCategory();
        $feeCategory->name = $request->name;
        $feeCategory->save();
        $notification = array(
            'message' => 'Fee Category Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('feeCategory.index')->with($notification);

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
        $feeCategory = FeeCategory::find($id);
        return view('backend.setup.feeCategory.edit',compact('feeCategory'));
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
        $feeCategory = FeeCategory::find($id);
        $validateData = $request->validate([
            'name'=>'required|unique:fee_categories,name,'.$feeCategory->id
        ]);

        $feeCategory->name = $request->name;
        $feeCategory->save();
        $notification = array(
            'message' => 'Fee Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('feeCategory.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feeCategory = FeeCategory::find($id);
        $feeCategory->delete();
        $notification = array(
            'message' => 'Fee Category Deleted Successfully!',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    }
}
