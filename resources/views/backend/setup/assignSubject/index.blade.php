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
                                <h3 class="box-title">Assign Subject List</h3>
                                <a href="{{ route('assignSubject.create') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Add Assign Subject</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Class Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($assignSubjects as $key=>$assign )
                                                <tr>
                                                    <td width="5%">{{ ++$key}}</td>
                                                    <td>{{$assign->class->name}}</td>
                                                    <td width="25%">
                                                        <div class="row">
                                                            <a href="{{ route('assignSubject.edit',$assign->class_id) }}" class="btn btn-info ml-2">Edit</a>
                                                            <a href="{{ route('assignSubject.details',$assign->class_id)}}" class="btn btn-primary ml-2">Details</a>
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



