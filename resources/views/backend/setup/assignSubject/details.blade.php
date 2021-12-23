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
                                <h3 class="box-title">Assign Subject Details</h3>
                                <a href="{{ route('assignSubject.create') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Add Assign Subject</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <h4><strong>Student Class : </strong>{{$assignSubjects[0]['class']['name']}}</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>SL</th>
                                                <th>School Subject</th>
                                                <th>Full Mark</th>
                                                <th>Pass Mark</th>
                                                <th>Subject Mark</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($assignSubjects as $key=>$subject )
                                                <tr>
                                                    <td width="5%">{{ ++$key}}</td>
                                                    <td>{{$subject->school_subject->name}}</td>
                                                    <td>{{$subject->full_mark}}</td>
                                                    <td>{{$subject->pass_mark}}</td>
                                                    <td>{{$subject->subjective_mark}}</td>
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



