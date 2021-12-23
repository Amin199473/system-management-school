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
                                <h3 class="box-title">Employee List</h3>
                                <a href="{{ route('employeeRegistration.create') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Add Employee</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Name</th>
                                                <th>ID NO</th>
                                                <th>Mobile</th>
                                                <th>Gender</th>
                                                <th>Join Date</th>
                                                <th>Salary</th>
                                                @if (Auth::user()->role == 'Admin')
                                                <th>Code</th>
                                                @endif
                                                <th width="15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($employees as $key=>$employee )
                                                <tr>
                                                    <td width="5%">{{ ++$key}}</td>
                                                    <td>{{$employee->name}}</td>
                                                    <td>{{$employee->id_no}}</td>
                                                    <td>{{$employee->mobile}}</td>
                                                    <td>{{$employee->gender}}</td>
                                                    <td>{{$employee->join_date}}</td>
                                                    <td>{{$employee->salary}}</td>
                                                    @if(Auth::user()->role =='Admin')
                                                    <td>{{$employee->code}}</td>
                                                    @endif
                                                    <td width="25%">
                                                        <div class="row">
                                                            <a href="{{ route('employeeRegistration.edit',$employee->id) }}" class="btn btn-info ml-2">Edit</a>
                                                            <a href="{{ route('employeeRegistration.details',$employee->id) }}" class="btn btn-primary ml-2">Details</a>
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



