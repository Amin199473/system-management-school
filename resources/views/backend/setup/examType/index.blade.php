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
                                <h3 class="box-title">Exam Type List</h3>
                                <a href="{{ route('examType.create') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Add Exam Type</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($examTypes as $key=>$exam )
                                                <tr>
                                                    <td width="5%">{{ ++$key}}</td>
                                                    <td>{{$exam->name}}</td>
                                                    <td width="25%">
                                                        <div class="row">
                                                            <a href="{{ route('examType.edit',$exam->id) }}" class="btn btn-info ml-2">Edit</a>

                                                            <form method="POST" action="{{ route("examType.destroy" ,$exam->id) }}" id="form" class="form-inline">
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



