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
                                <h4 class="box-title">Manage <strong>Employee Attendance Report</strong></h4>
                            </div>
                            <div class="box-body">
                                <form action="{{ route('getReportAttendance') }}" method="GET" target="_blank">
                                    @csrf
                                    @method("POST")
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Employee</h5>
                                                <div class=controls>
                                                    <select name="employee_id" id="employee_id" required="" class="form-control">
                                                        <option value=""> -Select Employee-</option>
                                                        @foreach ($employees as $employee)
                                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Date<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="date" id="date" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="padding-top: 25px">
                                            <input type="submit" class="btn btn-rounded btn-primary" value="Search">
                                        </div>
                                    </div>
                                </form>
                            </div>
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
