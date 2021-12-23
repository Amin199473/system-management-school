@extends('admin.admin_master')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Employee Leave Edit</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                {{-- start form --}}
                                <form method="POST" action="{{ route('employeeLeave.update',$employeeLeave->id) }}" enctype="multipart/form-data" novalidate="">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <h5>Employee Name<span class="text-danger">*</span></h5>
                                                <div class=controls>
                                                    <select name="employee_id" id="employee_id" required="" class="form-control">
                                                        <option value="">-Select Employee Name-</option>
                                                        @foreach ($employees as $employee)
                                                            <option value="{{ $employee->id }}"{{$employee->id == $employeeLeave->employee_id ?'selected':'' }}>{{ $employee->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <h5>Start Date <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" value="{{ $employeeLeave->start_date }}" name="start_date" id="name" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <h5>Leave Purpose<span class="text-danger">*</span></h5>
                                                <div class=controls>
                                                    <select name="leave_purpose_id" id="leave_purpose_id" required="" class="form-control">
                                                        <option value=""> -Select Leave Purpose-</option>
                                                        @foreach ($leavePurposes as $purpose)
                                                            <option value="{{ $purpose->id }}" {{$purpose->id == $employeeLeave->leave_purpose_id ?'selected':'' }}>{{ $purpose->name }}</option>
                                                        @endforeach
                                                        <option value="0">New Purpose</option>
                                                    </select>
                                                    <div class="pt-4">
                                                        <input type="text" name="name" id="add_another" placeholder="Write Purpose"
                                                            class="form-control" style="display: none">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <h5>End Date <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" value="{{ $employeeLeave->end_date }}" name="end_date" id="name" class="form-control">
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change', '#leave_purpose_id', function() {
                var leave_purpose_id = $(this).val()
                if(leave_purpose_id == '0'){
                    $('#add_another').show();
                }else{
                    $('#add_another').hide();
                }
            });
        });
    </script>
@endsection
