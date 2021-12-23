@extends('admin.admin_master')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Employee Leave</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                {{-- start form --}}
                                <form method="POST" action="{{ route('employeeLeave.store') }}" enctype="multipart/form-data" novalidate="">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <h5>Employee Name<span class="text-danger">*</span></h5>
                                                <div class=controls>
                                                    <select name="employee_id" id="employee_id" required="" class="form-control">
                                                        <option value="">-Select Employee Name-</option>
                                                        @foreach ($employees as $employee)
                                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('employee_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <h5>Start Date <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="start_date" id="name" class="form-control">
                                                </div>
                                                @error('start_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
                                                            <option value="{{ $purpose->id }}">{{ $purpose->name }}</option>
                                                        @endforeach
                                                        <option value="0">New Purpose</option>
                                                    </select>
                                                    @error('leave_purpose_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="pt-4">
                                                        <input type="text" name="name" id="add_another" placeholder="Write Purpose" class="form-control"
                                                            style="display: none">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <h5>End Date <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="end_date" id="name" class="form-control">
                                                </div>
                                                @error('end_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change', '#leave_purpose_id', function() {
                var leave_purpose_id = $(this).val()
                if (leave_purpose_id == '0') {
                    $('#add_another').show();
                } else {
                    $('#add_another').hide();
                }
            });
        });
    </script>
@endsection
