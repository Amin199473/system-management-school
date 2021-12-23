@extends('admin.admin_master')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit Grade Marks</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                {{-- start form --}}
                                <form method="POST" action="{{ route('marksGrade.update',$grade->id) }}" enctype="multipart/form-data" novalidate="">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            {{-- Row 1th --}}
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Grade Name<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" value="{{ $grade->grade_name }}" name="grade_name" id="grade_name" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Grade Point<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" value="{{ $grade->grade_point }}" name="grade_point" id="grade_point" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Start Marks<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" value="{{ $grade->start_marks }}" name="start_marks" id="start_marks" class="form-control">
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
                                                            <input type="text" value="{{ $grade->end_marks }}" name="end_marks" id="end_marks" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>Start Point<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" value="{{ $grade->start_point }}" name="start_point" id="start_point" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5>End Point<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" value="{{ $grade->end_point }}" name="end_point" id="end_point" class="form-control">
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
                                                            <input type="text" value="{{ $grade->remarks }}" name="remarks" id="remarks" class="form-control">
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
                                        <input type="submit" class="btn btn-rounded btn-info mb-5" value="Update">
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
