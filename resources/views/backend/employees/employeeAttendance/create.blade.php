@extends('admin.admin_master')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Employee Attendacne</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                {{-- start form --}}
                                <form method="POST" action="{{ route('employeeAttendance.store') }}" enctype="multipart/form-data" novalidate="">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <h5>Attendance Date <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="date" id="date" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-striped" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2" class="text-center" style="vertical-align: middle;">SL</th>
                                                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Employee List</th>
                                                        <th colspan="3" class="text-center" style="vertical-align: middle;width:30%">Attendance Status
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center btn present_all" style="display: table-cell;background-color:black">Present
                                                        </th>
                                                        <th class="text-center btn leave_all" style="display: table-cell;background-color:black">Leave
                                                        </th>
                                                        <th class="text-center btn absent_all" style="display: table-cell;background-color:black">Absent
                                                        </th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($employees as $key => $employee )
                                                    <tr class="text-center" id="div{{$employee->id}}" >
                                                        <input type="hidden" name="employee_id[]" value="{{$employee->id}}">
                                                        <td>{{ $key+1}}</td>
                                                        <td>{{ $employee->name}}</td>
                                                        <td colspan="3">
                                                            <input name="attendance_status{{$key}}" value="Present" type="radio" id="Present{{$key}}" checked="checked">
                                                            <label for="Present{{$key}}">Present</label>

                                                            <input name="attendance_status{{$key}}" value="Leave" type="radio" id="Leave{{$key}}">
                                                            <label for="Leave{{$key}}">Leave</label>

                                                            <input name="attendance_status{{$key}}" value="Absent" type="radio" id="Absent{{$key}}">
                                                            <label for="Absent{{$key}}">Absent</label>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>

                                            </table>
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
@endsection
