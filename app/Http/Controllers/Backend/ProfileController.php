<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('backend.profile.index',compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('backend.profile.edit',compact('user'));
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
        $user= User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->gender = $request->gender;

        //upload Profile Image
        if ($request->hasFile('image')) {
            @unlink(public_path('upload/user_images/'.$user->image));
            $photo = $request->file('image');
            $filename = 'Avatar' . '_' . time() . '.' . $photo->getClientOriginalExtension();
            $location = public_path('upload/user_images');
            $request->file('image')->move($location, $filename);
            $user->image=$filename;
        }
        $user->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('profile.index')->with($notification);

    }

    public function ChangePassword(){

        return view('backend.profile.changePassword');

    }


    public function UpdatePassword(Request $request){
        $validateData = $request->validate([
            'oldpassword'=>'required',
            'password'=>'required|confirmed'
        ]);
        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword, $hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        }else{
            $notification = array(
                'message' => 'The Current Password Is Wrong',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }
}

