@extends('admin.admin_master')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit Employee</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                {{-- start form --}}
                                <form method="POST" action="{{ route('employeeRegistration.update',$employee->id) }}" enctype="multipart/form-data" novalidate="">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            {{-- Row 1th --}}
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Employee Name<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" value="{{ $employee->name}}" name="name" id="name" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Father's Name<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" value="{{ $employee->father_name}}" name="father_name" id="father_name" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Mother's Name<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" value="{{ $employee->mother_name}}"  name="mother_name" id="mother_name" class="form-control">
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
                                                            <input type="text" value="{{ $employee->mobile}}" name="mobile" id="mobile" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Address<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" value="{{ $employee->address}}"  name="address" id="address" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Gender<span class="text-danger">*</span></h5>
                                                        <div class=controls>
                                                            <select name="gender" id="gender" required="" class="form-control">
                                                                <option value=""> -Select gender-</option>
                                                                <option value="male" {{  $employee->gender == 'male'? 'selected': ''}}>Male</option>
                                                                <option value="female" {{  $employee->gender == 'female'? 'selected': '' }}>Female</option>
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
                                                                <option value="Islamic" {{  $employee->religion == 'Islamic'? 'selected': '' }}>Islamic</option>
                                                                <option value="Hindi" {{  $employee->religion == 'Hindi'? 'selected': '' }}>Hindi</option>
                                                                <option value="Christian" {{  $employee->religion == 'Christian'? 'selected': '' }}>Christian</option>
                                                                <option value="jewish" {{  $employee->religion == 'jewish'? 'selected': '' }}>jewish</option>
                                                                <option value="without_Religion" {{  $employee->religion == 'without_Religion'? 'selected': '' }}>without Religion</option>
                                                                <option value="other" {{  $employee->religion == 'other'? 'selected': '' }}>other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Date Of Birth<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="Date" value="{{ $employee->date_of_birth }}"  name="date_of_birth" id="date_of_birth" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <h5>Designation<span class="text-danger">*</span></h5>
                                                            <div class=controls>
                                                                <select name="designation_id" id="designation_id" required="" class="form-control">
                                                                    <option value=""> -Select Designation-</option>
                                                                    @foreach ($designations as $designation)
                                                                        <option value="{{ $designation->id }}" {{$employee->designation_id == $designation->id ? 'selected' :''}}>{{ $designation->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            {{-- Row 4th --}}
                                            <div class="row">
                                                <div class="col-md-4">
                                                    @if(!$employee)
                                                    <div class="form-group">
                                                        <h5>Salary<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" value="{{ $employee->salary }}" name="salary" id="salary" class="form-control">
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-4">
                                                    @if(!$employee)
                                                    <div class="form-group">
                                                        <h5>Join Date<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="Date" value="{{ $employee->join_date }}" name="join_date" id="join_date" class="form-control">
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Image Profile<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="file" name="image" class="form-control" id="image">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Row 5th --}}
                                            <div class="row">
                                                <div class="col-md-4">

                                                </div>

                                                <div class="col-md-4">

                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <img id="showImage" src="{{!empty($employee->image)? url('upload/employee_images/'.$employee->image) : url('upload/avatar-1.png') }}" alt="" style="width: 100px; border:1px solid #000000">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info mb-5" value="Update">
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
