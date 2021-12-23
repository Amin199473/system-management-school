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
                                <h3 class="box-title">Attendance Details</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <h4><strong>Attendance Date : </strong>{{date('d-m-Y',strtotime($attendance[0]['date']))}}</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>SL</th>
                                                <th>Name</th>
                                                <th>ID NO</th>
                                                <th>Attendance Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($attendance as $key=>$attend )
                                                <tr>
                                                    <td width="5%">{{ ++$key}}</td>
                                                    <td>{{$attend->user->name}}</td>
                                                    <td>{{$attend->user->id_no}}</td>
                                                    <td>{{$attend->attendance_status}}</td>
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



