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
                                <h3 class="box-title">Employee Salary Details</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <h4><strong>Employee Name : </strong>{{$employee->name}}</h4>
                                <h4><strong>Employee ID NO : </strong>{{$employee->id_no}}</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>SL</th>
                                                <th>Previuos Salary</th>
                                                <th>Increment Salary</th>
                                                <th>Present Salary</th>
                                                <th>Effected Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($salaryLogs as $key=>$log )
                                                <tr>
                                                    <td width="5%">{{ ++$key}}</td>
                                                    <td>{{$log->previous_salary	}}$</td>
                                                    <td>{{$log->increment_salary}}$</td>
                                                    <td>{{$log->present_salary}}$</td>
                                                    <td>{{$log->effected_salary}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
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



