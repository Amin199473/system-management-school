@extends('admin.admin_master')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Employee Attendance</h3>
                                <a href="{{ route('employeeAttendance.create') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Add Attendance</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($employeeAttendances as $key=>$attendance )
                                                <tr>
                                                    <td width="5%">{{ ++$key}}</td>
                                                    <td>{{date('d-m-Y',strtotime($attendance->date))}}</td>
                                                    <td width="25%">
                                                        <div class="row">
                                                            <a href="{{route('employeeAttendance.edit',$attendance->date)}}" class="btn btn-info ml-2">Edit</a>
                                                            <a href="{{route('employeeAttendance.details',$attendance->date)}}" class="btn btn-primary ml-2">Details</a>
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



