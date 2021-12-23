@extends('admin.admin_master')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box bb-3 border-warning">
                            <div class="box-header">
                                <h4 class="box-title">Student <strong> Search</strong></h4>
                            </div>
                            <div class="box-body">
                                <form action="{{ route('studentSearch') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Year</h5>
                                                <div class=controls>
                                                    <select name="year_id" id="year_id" required="" class="form-control">
                                                        <option value=""> -Select year-</option>
                                                        @foreach ($years as $year)
                                                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Class</h5>
                                                <div class=controls>
                                                    <select name="class_id" id="class_id" required="" class="form-control">
                                                        <option value=""> -Select Class-</option>
                                                        @foreach ($classes as $class)
                                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-4" style="padding-top: 25px;">
                                            <div class="text-xs-right">
                                                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Search">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Student List</h3>
                                <a href="{{ route('registration.create') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Register
                                    Student</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>ID NO</th>
                                                <th>Roll</th>
                                                <th>Year</th>
                                                <th>Class</th>
                                                <th>Image</th>
                                                @if (Auth::User()->role =='Admin')
                                                <th>Code</th>
                                                @endif
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($assignStudents as $key => $assignStudent)
                                                <tr>
                                                    <td>{{ $assignStudent->student->name }}</td>
                                                    <td>{{ $assignStudent->student->id_no }}</td>
                                                    <td>{{ $assignStudent->roll }}</td>
                                                    <td>{{ $assignStudent->year->name }}</td>
                                                    <td>{{ $assignStudent->class->name }}</td>
                                                    <td>
                                                        <img style="width: 70px; height:70px;" class="rounded-circle bg-white" src="{{!empty($assignStudent->student->image)? url('upload/user_images/'.$assignStudent->student->image) : url('upload/avatar-1.png') }}" alt="User Avatar">
                                                    </td>
                                                    @if (Auth::User()->role =='Admin')
                                                    <td>{{ $assignStudent->student->code  }}</td>
                                                    @endif
                                                    <td width="25%">
                                                        <div class="row">
                                                            <a href="{{ route('registration.edit', $assignStudent->student_id) }}" class="btn btn-info ml-2"><i class="fa fa-edit"></i></a>
                                                            <a href="{{ route('promotion', $assignStudent->student_id) }}" class="btn btn-danger ml-2"><i class="fa fa-check-square" aria-hidden="true"></i></a>
                                                            <a target="_blank" title="details" href="{{ route('generatePdf',$assignStudent->student_id) }}" class="btn btn-success ml-2"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
    </div>
    <!-- /.content-wrapper -->
@endsection
