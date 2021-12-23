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
                                <h3 class="box-title">Fee Amount Details</h3>
                                <a href="{{ route('feeAmount.create') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Add Fee Amount</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <h4><strong>Fee Category : </strong>{{$feeAmounts[0]['fee_category']['name']}}</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>SL</th>
                                                <th>Class Name</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($feeAmounts as $key=>$amount )
                                                <tr>
                                                    <td width="5%">{{ ++$key}}</td>
                                                    <td>{{$amount->student_class->name}}</td>
                                                    <td>{{$amount->amount}}</td>
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



