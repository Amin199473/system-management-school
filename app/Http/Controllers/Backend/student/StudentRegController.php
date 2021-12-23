<?php

namespace App\Http\Controllers\Backend\student;

use App\Models\User;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRegRequest;
use App\Models\DiscountStudent;

use PDF;
class StudentRegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $assignStudents = AssignStudent::all();
        return view('backend.students.studentReg.index', compact('assignStudents', 'years', 'classes'));
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
        $groups = StudentGroup::all();
        $shifts = StudentShift::all();
        return view('backend.students.studentReg.create', compact([
            'years',
            'classes',
            'groups',
            'shifts'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRegRequest $request)
    {
        dd($request);
        $validation = $request->validate([
            ''
        ]);

        DB::transaction(function () use ($request) {
            $checkYear = StudentYear::find($request->year_id)->name;
            $student = User::where('user_type', 'Student')->orderBy('id', 'DESC')->first();
            if ($student == null) {
                $firstReg = 0;
                $studentID = $firstReg + 1;
                if ($studentID < 10) {
                    $id_no = '000' . $studentID;
                } elseif ($studentID < 100) {
                    $id_no = '00' . $studentID;
                } elseif ($studentID < 1000) {
                    $id_no = '0' . $studentID;
                }
            } else {
                $student = User::where('user_type', 'Student')->orderBy('id', 'DESC')->first()->id;
                $studentID = $student + 1;

                if ($studentID < 10) {
                    $id_no = '000' . $studentID;
                } elseif ($studentID < 100) {
                    $id_no = '00' . $studentID;
                } elseif ($studentID < 1000) {
                    $id_no = '0' . $studentID;
                }
            }

            $final_id_no = $checkYear . $id_no;
            $user = new User();
            $code = rand(00000, 99999);
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->user_type = 'Student';
            $user->code = $code;
            $user->name = $request->name;
            $user->father_name = $request->father_name;
            $user->mother_name = $request->mother_name;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
            //upload Profile Image
            if ($request->hasFile('image')) {
                $photo = $request->file('image');
                $filename = 'Avatar' . '_' . time() . '.' . $photo->getClientOriginalExtension();
                $location = public_path('upload/user_images');
                $request->file('image')->move($location, $filename);
            }
            $user->image = $filename;
            $user->save();

            $assignStudent = new AssignStudent();
            $assignStudent->student_id = $user->id;
            $assignStudent->year_id = $request->year_id;
            $assignStudent->class_id = $request->class_id;
            $assignStudent->group_id = $request->group_id;
            $assignStudent->shift_id = $request->shift_id;
            $assignStudent->save();

            $discountStudent = new DiscountStudent();
            $discountStudent->assign_student_id = $assignStudent->id;
            $discountStudent->fee_category_id = '1';
            $discountStudent->discount = $request->discount;
            $discountStudent->save();
        });

        $notification = array(
            'message' => 'Student Registration Done Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('registration.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function studentSearch(Request $request)
    {
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $assignStudents = AssignStudent::where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
        return view('backend.students.studentReg.index', compact('assignStudents', 'years', 'classes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $groups = StudentGroup::all();
        $shifts = StudentShift::all();
        $assignStudent = AssignStudent::with(['student', 'discount'])->where('student_id', $id)->first();
        // dd($assignStudent->toArray());
        return view('backend.students.studentReg.edit', compact([
            'years',
            'classes',
            'groups',
            'shifts',
            'assignStudent',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $student_id)
    {
        DB::transaction(function () use ($request, $student_id) {
            $user = User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->father_name = $request->father_name;
            $user->mother_name = $request->mother_name;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
            //upload Profile Image
            if ($request->hasFile('image')) {
                $photo = $request->file('image');
                @unlink(public_path('upload/user_images/' . $user->image));
                $filename = 'Avatar' . '_' . time() . '.' . $photo->getClientOriginalExtension();
                $location = public_path('upload/user_images');
                $request->file('image')->move($location, $filename);
                $user->image = $filename;
            }
            $user->save();

            $assignStudent = AssignStudent::where('id', $request->id)->where('student_id', $student_id)->first();
            $assignStudent->year_id = $request->year_id;
            $assignStudent->class_id = $request->class_id;
            $assignStudent->group_id = $request->group_id;
            $assignStudent->shift_id = $request->shift_id;
            $assignStudent->save();

            $discountStudent = DiscountStudent::where('assign_student_id', $request->id)->first();
            $discountStudent->discount = $request->discount;
            $discountStudent->save();
        });

        $notification = array(
            'message' => 'Student Registration Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('registration.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Promotion($id)
    {
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $groups = StudentGroup::all();
        $shifts = StudentShift::all();
        $assignStudent = AssignStudent::with(['student', 'discount'])->where('student_id', $id)->first();
        return view('backend.students.studentReg.promotion', compact([
            'years',
            'classes',
            'groups',
            'shifts',
            'assignStudent'
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePromotion(Request $request, $student_id)
    {

        DB::transaction(function () use ($request, $student_id) {
            $user = User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->father_name = $request->father_name;
            $user->mother_name = $request->mother_name;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
            //upload Profile Image
            if ($request->hasFile('image')) {
                $photo = $request->file('image');
                @unlink(public_path('upload/user_images/' . $user->image));
                $filename = 'Avatar' . '_' . time() . '.' . $photo->getClientOriginalExtension();
                $location = public_path('upload/user_images');
                $request->file('image')->move($location, $filename);
                $user->image = $filename;
            }
            $user->save();

            $assignStudent = new AssignStudent();
            $assignStudent->student_id = $user->id;
            $assignStudent->year_id = $request->year_id;
            $assignStudent->class_id = $request->class_id;
            $assignStudent->group_id = $request->group_id;
            $assignStudent->shift_id = $request->shift_id;
            $assignStudent->save();

            $discountStudent = new DiscountStudent();
            $discountStudent->assign_student_id = $assignStudent->id;
            $discountStudent->fee_category_id = '1';
            $discountStudent->discount = $request->discount;
            $discountStudent->save();
        });

        $notification = array(
            'message' => 'Student Promotion Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('registration.index')->with($notification);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generatePdf($id){


        $assignStudent = AssignStudent::with(['student', 'discount'])->where('student_id', $id)->first();

        $pdf = PDF::loadView('backend.students.studentReg.generatePdf', compact('assignStudent'));
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
