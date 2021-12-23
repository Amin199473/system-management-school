@extends('admin.admin_master')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Student Registration</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                {{-- start form --}}
                                <form method="POST" action="{{ route('registration.store') }}" enctype="multipart/form-data" novalidate="">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-12">
                                            {{-- Row 1th --}}
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Student Name<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="name" id="name" class="form-control">
                                                        </div>
                                                        @error('name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Father's Name<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="father_name" id="father_name" class="form-control">
                                                        </div>
                                                        @error('father_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Mother's Name<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="mother_name" id="mother_name" class="form-control">
                                                        </div>
                                                        @error('mother_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Row 2th --}}
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Mobile Number<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="mobile" id="mobile" class="form-control">
                                                        </div>
                                                        @error('mobile')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Address<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="address" id="address" class="form-control">
                                                        </div>
                                                        @error('address')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Gender<span class="text-danger">*</span></h5>
                                                        <div class=controls>
                                                            <select name="gender" id="gender" required="" class="form-control">
                                                                <option value=""> -Select gender-</option>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                            </select>
                                                            @error('gender')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
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
                                                                <option value="Islamic">Islamic</option>
                                                                <option value="Hindi">Hindi</option>
                                                                <option value="Christian">Christian</option>
                                                                <option value="jewish">jewish</option>
                                                                <option value="without_Religion">without Religion</option>
                                                                <option value="other">other</option>
                                                            </select>
                                                            @error('religion')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Date Of Birth<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="Date" name="date_of_birth" id="date_of_birth" class="form-control">
                                                        </div>
                                                        @error('date_of_birth')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Discount<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="discount" id="discount" class="form-control">
                                                        </div>
                                                        @error('discount')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
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
                                                                    <option value="{{ $year->id }}">{{ $year->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('year_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
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
                                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('class_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
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
                                                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('group_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
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
                                                                    <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('shift_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Image Profile<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="file" name="image" class="form-control" id="image">
                                                        </div>
                                                        @error('image')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <img id="showImage" src="{{ url('upload/avatar-1.png') }}" alt=""
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
