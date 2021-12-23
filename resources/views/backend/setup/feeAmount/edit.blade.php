@extends('admin.admin_master')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit Fee Amount</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                {{-- start form --}}
                                <form method="post" action="{{ route('feeAmount.update',$feeAmounts[0]->fee_category_id) }}" enctype="multipart/form-data" novalidate="">
                                    @csrf
                                    @method('PUT')
                                    <div class="add_item">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <h5>Fee Category <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="fee_category_id" class="form-control">
                                                            <option value="">-select Fee Category-</option>
                                                            @foreach ($feeCategories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ $category->id == $feeAmounts[0]->fee_category_id ? 'selected' : '' }}>
                                                                    {{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @foreach ($feeAmounts as $amount)
                                        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <h5>Student Class <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select name="class_id[]" class="form-control">
                                                                <option value="">-Student class-</option>
                                                                @foreach ($classes as $class)
                                                                    <option value="{{ $class->id }}"{{$class->id == $amount->class_id ? 'selected':''}}>{{ $class->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <h5>Fee Amount<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="amount[]" value="{{ $amount->amount }}" id="name" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="padding-top: 25px;">
                                                    <span class="btn btn-success addEventMore">
                                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                    </span>
                                                    <span class="btn btn-danger removeEventMore">
                                                        <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
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

    <div style="visibility: hidden;">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <h5>Student Class <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="class_id[]" class="form-control">
                                    <option value="">-Student class-</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <h5>Fee Amount<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="amount[]" id="name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" style="padding-top: 25px;">
                        <span class="btn btn-success addEventMore">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </span>

                        <span class="btn btn-danger removeEventMore">
                            <i class="fa fa-minus-circle" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 0;
            $(document).on('click', '.addEventMore', function() {
                var whole_extra_item_add = $('#whole_extra_item_add').html();
                $(this).closest('.add_item').append(whole_extra_item_add);
                counter++;
            });

            $(document).on('click', '.removeEventMore', function(event) {
                $(this).closest('.delete_whole_extra_item_add').remove();
                counter =-1;
            });
        });
    </script>
@endsection
