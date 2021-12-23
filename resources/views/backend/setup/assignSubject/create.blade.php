@extends('admin.admin_master')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Add Assign Subject</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                {{-- start form --}}
                                <form method="post" action="{{ route('assignSubject.store') }}" enctype="multipart/form-data" novalidate="">
                                    @csrf
                                    @method('POST')
                                    <div class="add_item">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <h5>Student Class<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="class_id" required class="form-control">
                                                            <option value="">-select class-</option>
                                                            @foreach ($classes as $class)
                                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('class_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>School Subject <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="subject_id[]" required class="form-control">
                                                            <option value="">-Select Subject-</option>
                                                            @foreach ($schoolSubjects as $subject)
                                                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('subject_id[]')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h5>Full Mark<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="full_mark[]" id="name" class="form-control">
                                                    </div>
                                                    @error('full_mark[]')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h5>Pass Mark<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="pass_mark[]" id="name" class="form-control">
                                                    </div>
                                                    @error('pass_mark[]')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <h5>Subjective Mark<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="subjective_mark[]" id="name" class="form-control">
                                                    </div>
                                                    @error('subjective_mark[]')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-2" style="padding-top: 25px;">
                                                <span class="btn btn-success addEventMore">
                                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                </span>
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

    <div style="visibility: hidden;">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Student Subject <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="subject_id[]" class="form-control">
                                    <option value="">-Select Subject-</option>
                                    @foreach ($schoolSubjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <h5>Full Mark<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="full_mark[]" id="name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <h5>Pass Mark<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="pass_mark[]" id="name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <h5>Subjective Mark<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="subjective_mark[]" id="name" class="form-control">
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
                counter = -1;
            });
        });
    </script>
@endsection
