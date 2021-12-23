@extends('admin.admin_master')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Grade Marks</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                {{-- start form --}}
                                <form method="POST" action="{{ route('marksGrade.store') }}" enctype="multipart/form-data" novalidate="">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-12">
                                            {{-- Row 1th --}}
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Grade Name<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="grade_name" id="grade_name" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Grade Point<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="grade_point" id="grade_point" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Start Marks<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="start_marks" id="start_marks" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Row 2th --}}
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>End Marks<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="end_marks" id="end_marks" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Start Point<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="start_point" id="start_point" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>End Point<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="end_point" id="end_point" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Row 3th --}}
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Remarks<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="remarks" id="remarks" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">

                                                </div>

                                                <div class="col-md-4">

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info mb-5" value="Submit">
                                    </div>
                                </form>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </section>

        </div>
    </div>
    <!-- /.content-wrapper -->
@endsection
