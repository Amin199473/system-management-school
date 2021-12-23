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
                                <h3 class="box-title">Student Fee List</h3>
                                <a href="{{ route('studentFee.create') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Add Student Fee</a>
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
                                                <th>Year</th>
                                                <th>Class</th>
                                                <th>Fee Type</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($studentFees as $key=>$fee )
                                                <tr>
                                                    <td width="5%">{{ ++$key}}</td>
                                                    <td>{{$fee->student->name}}</td>
                                                    <td>{{$fee->student->id_no}}</td>
                                                    <td>{{$fee->year->name}}</td>
                                                    <td>{{$fee->class->name}}</td>
                                                    <td>{{$fee->feeCategory->name}}</td>
                                                    <td>{{$fee->amount}}</td>
                                                    <td>{{date('M Y',strtotime($fee->date))}}</td>
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



