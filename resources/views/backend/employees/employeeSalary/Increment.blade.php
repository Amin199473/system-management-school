@extends('admin.admin_master')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Employee Salary Increment</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                {{-- start form --}}
                                <form method="POST" action="{{ route('employee.Increment.salary.update',$employee->id) }}" enctype="multipart/form-data" novalidate="">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <h5>Inrement Salary <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="increment_salary" id="name" class="form-control">
                                                </div>
                                                @error('increment_salary')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <h5>Effected Salary <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="effected_salary" id="name" class="form-control">
                                                </div>
                                                @error('effected_salary')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info mb-5" value="Increment">
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
