@extends('admin.admin_master')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="box bb-3 border-warning">
                            <div class="box-header">
                                <h4 class="box-title"><strong> Student Result Report</strong></h4>
                            </div>
                            <div class="box-body">
                                <form action="{{ route('getResultReportStudent') }}" method="GET" target="_blank">
                                    @csrf
                                    @method("POST")
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Year</h5>
                                                <div class=controls>
                                                    <select name="year_id" id="year_id" required="" class="form-control">
                                                        <option value=""> -Select year-</option>
                                                        @foreach ($years as $year)
                                                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Class</h5>
                                                <div class=controls>
                                                    <select name="class_id" id="class_id" required="" class="form-control">
                                                        <option value=""> -Select Class-</option>
                                                        @foreach ($classes as $class)
                                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5>Exam Type</h5>
                                                <div class=controls>
                                                    <select name="exam_type_id" id="exam_type_id" required="" class="form-control">
                                                        <option value=""> -Select Exam Type-</option>
                                                        @foreach ($examTypes as $exam)
                                                            <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="padding-top: 25px">
                                            <input type="submit" class="btn btn-rounded btn-primary" value="Search">
                                        </div>
                                    </div>

                                </form>
                            </div>
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
