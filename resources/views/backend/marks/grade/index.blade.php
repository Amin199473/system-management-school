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
                                <h3 class="box-title">Grade Mark List</h3>
                                <a href="{{ route('marksGrade.create') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Add Grade Marks</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Grade Name</th>
                                                <th>Grade Point</th>
                                                <th>Start Marks</th>
                                                <th>End Marks</th>
                                                <th>Point Range</th>
                                                <th>Remarks</th>
                                                <th width="15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($grades as $key=>$grade )
                                                <tr>
                                                    <td width="5%">{{ ++$key}}</td>
                                                    <td>{{$grade->grade_name}}</td>
                                                    <td>{{ number_format((float)$grade->grade_point,2)}}</td>
                                                    <td>{{$grade->start_marks}}</td>
                                                    <td>{{$grade->end_marks}}</td>
                                                    <td>{{$grade->start_point}} - {{$grade->end_point}} </td>
                                                    <td>{{$grade->remarks}}</td>
                                                    <td width="25%">
                                                        <div class="row">
                                                            <a href="{{ route('marksGrade.edit',$grade->id) }}" class="btn btn-info ml-2">Edit</a>
                                                            <form method="POST" action="{{ route("marksGrade.destroy" ,$grade->id) }}" id="form" class="form-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input id="delete" style="background-color: red; color:white" class="btn btn-danger ml-2" type="submit" value="Delete">
                                                            </form>
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



