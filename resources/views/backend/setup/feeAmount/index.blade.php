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
                                <h3 class="box-title">Student Fee Amount List</h3>
                                <a href="{{ route('feeAmount.create') }}" style="float: right" class="btn btn-rounded btn-success mb-5">Add Fee Amount</a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Fee Category</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($feeAmounts as $key=>$amount )
                                                <tr>
                                                    <td width="5%">{{ ++$key}}</td>
                                                    <td>{{$amount->fee_category->name}}</td>
                                                    <td width="25%">
                                                        <div class="row">
                                                            <a href="{{ route('feeAmount.edit',$amount->fee_category_id) }}" class="btn btn-info ml-2">Edit</a>
                                                            <a href="{{ route('feeAmount.details',$amount->fee_category_id)}}" class="btn btn-primary ml-2">Details</a>
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



