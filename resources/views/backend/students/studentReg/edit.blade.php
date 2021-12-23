@extends('admin.admin_master')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit Student Registration</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                {{-- start form --}}
                                <form method="POST" action="{{ route('registration.update',$assignStudent->student_id) }}" enctype="multipart/form-data" novalidate="">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $assignStudent->id }}">
                                    <div class="row">
                                        <div class="col-12">
                                            {{-- Row 1th --}}
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Student Name<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" value="{{$assignStudent->student->name}}" name="name" id="name" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Father's Name<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" value="{{$assignStudent->student->father_name}}" name="father_name" id="father_name" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Mother's Name<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" value="{{$assignStudent->student->mother_name}}" name="mother_name" id="mother_name" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Row 2th --}}
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Mobile Number<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" value="{{$assignStudent->student->mobile}}" name="mobile" id="mobile" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Address<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" value="{{$assignStudent->student->address}}" name="address" id="address" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Gender<span class="text-danger">*</span></h5>
                                                        <div class=controls>
                                                            <select name="gender" id="gender" required="" class="form-control">
                                                                <option value=""> -Select gender-</option>
                                                                <option value="male" {{ $assignStudent->student->gender =='male'?'selected':''}}>Male</option>
                                                                <option value="female" {{ $assignStudent->student->gender =='female'?'selected':''}}>Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Row 3th --}}
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Religion<span class="text-danger">*</span></h5>
                                                        <div class=controls>
                                                            <select name="religion" id="religion" required="" class="form-control">
                                                                <option value=""> -Select gender-</option>
                                                                <option value="Islamic" {{ $assignStudent->student->religion =='Islamic'?'selected':''}} >Islamic</option>
                                                                <option value="Hindi" {{ $assignStudent->student->religion =='Hindi'?'selected':''}}>Hindi</option>
                                                                <option value="Christian" {{ $assignStudent->student->religion =='Christian'?'selected':''}}>Christian</option>
                                                                <option value="jewish" {{ $assignStudent->student->religion =='female'?'jewish':''}}>jewish</option>
                                                                <option value="without_Religion" {{ $assignStudent->student->religion =='without_Religion'?'selected':''}}>without Religion</option>
                                                                <option value="other" {{ $assignStudent->student->religion =='other'?'selected':''}}>other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Date Of Birth<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="Date" value="{{ $assignStudent->student->date_of_birth }}" name="date_of_birth" id="date_of_birth" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Discount<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" value="{{ $assignStudent->discount->discount }}" name="discount" id="discount" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Row 4th --}}
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Year<span class="text-danger">*</span></h5>
                                                        <div class=controls>
                                                            <select name="year_id" id="year_id" required="" class="form-control">
                                                                <option value=""> -Select year-</option>
                                                                @foreach ($years as $year)
                                                                    <option value="{{ $year->id }}" {{$assignStudent->year_id == $year->id ?'selected':'' }}>{{ $year->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Class<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="class_id" id="class_id" required="" class="form-control">
                                                                <option value=""> -Select Class-</option>
                                                                @foreach ($classes as $class)
                                                                    <option value="{{ $class->id }}" {{$assignStudent->class_id == $class->id ?'selected':'' }}>{{ $class->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>group<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="group_id" id="group_id" required="" class="form-control">
                                                                <option value=""> -Select Group-</option>
                                                                @foreach ($groups as $group)
                                                                    <option value="{{ $group->id }}" {{$assignStudent->group_id == $group->id ?'selected':'' }}>{{ $group->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Row 5th --}}
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Shift<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="shift_id" id="shift_id" required="" class="form-control">
                                                                <option value=""> -Select Shift-</option>
                                                                @foreach ($shifts as $shift)
                                                                    <option value="{{ $shift->id }}" {{$assignStudent->shift_id == $shift->id ?'selected':'' }}>{{ $shift->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Image Profile<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="file" name="image" class="form-control" id="image">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <img id="showImage" src="{{!empty($assignStudent->student->image ) ?url('upload/user_images/'.$assignStudent->student->image ) :url('upload/avatar-1.png') }}" alt=""
                                                                style="width: 100px; border:1px solid #000000">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info mb-5" value="Submit">
                                    </div>
                                </form>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </section>

        </div>
    </div>
    <!-- /.content-wrapper -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0'])
            });
        });
    </script>
@endsection
