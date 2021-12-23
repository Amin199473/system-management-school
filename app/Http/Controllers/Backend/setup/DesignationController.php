<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designations = Designation::all();
        return view('backend.setup.designation.index',compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.setup.designation.create');
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
            'name'=>'required|unique:designations'
        ]);

        $designation = new Designation();
        $designation->name = $request->name;
        $designation->save();
        $notification = array(
            'message' => 'Designation Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('designation.index')->with($notification);
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
        $designation = Designation::find($id);
        return view('backend.setup.designation.edit',compact('designation'));
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
        $designation = Designation::find($id);
        $validateData = $request->validate([
            'name'=>'required|unique:designations,name,'.$designation->id
        ]);

        $designation->name = $request->name;
        $designation->save();
        $notification = array(
            'message' => 'Designation Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('designation.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $designation = Designation::find($id);
        $designation->delete();
        $notification = array(
            'message' => 'Designation Deleted Successfully!',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }
}
