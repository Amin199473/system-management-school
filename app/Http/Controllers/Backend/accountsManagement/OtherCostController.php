<?php

namespace App\Http\Controllers\Backend\accountsManagement;

use App\Http\Controllers\Controller;
use App\Models\AccountOtherCost;
use Illuminate\Http\Request;

class OtherCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $otherCosts = AccountOtherCost::all();
        return view('backend.accountsManagement.otherCost.index',compact('otherCosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('backend.accountsManagement.otherCost.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //upload Profile Image
        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $filename = 'otherCost' . '_' . time() . '.' . $photo->getClientOriginalExtension();
            $location = public_path('upload/cost_images');
            $request->file('image')->move($location, $filename);
        }


        $otherCost =new AccountOtherCost();
        $otherCost->date = date('Y-m-d',strtotime($request->date));
        $otherCost->amount = $request->amount;
        $otherCost->description = $request->description;
        $otherCost->image = $filename ;
        $otherCost->save();

        $notification = array(
            'message' => 'Other Cost Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('otherCost.index')->with($notification);
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
        $otherCost = AccountOtherCost::find($id);
        return view('backend.accountsManagement.otherCost.edit',compact('otherCost'));
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
        $otherCost = AccountOtherCost::find($id);
        $otherCost->date = date('Y-m-d',strtotime($request->date));
        $otherCost->amount = $request->amount;
        $otherCost->description = $request->description;
        //upload Profile Image
        if ($request->hasFile('image')) {
            @unlink(public_path('upload/cost_images/'.$otherCost->image));
            $photo = $request->file('image');
            $filename = 'otherCost' . '_' . time() . '.' . $photo->getClientOriginalExtension();
            $location = public_path('upload/cost_images');
            $request->file('image')->move($location, $filename);
            $otherCost->image = $filename ;
        }
        $otherCost->save();


        $notification = array(
            'message' => 'Other Cost updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('otherCost.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $otherCost = AccountOtherCost::find($id);
        $otherCost->delete();
        $notification = array(
            'message' => 'Other Cost Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }
}
