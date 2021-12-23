@extends('admin.admin_master')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="container-full">
            <section class="content">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit Other Cost</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                {{-- start form --}}
                                <form method="POST" action="{{ route('otherCost.update', $otherCost) }}" enctype="multipart/form-data" novalidate="">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            {{-- Row 1th --}}
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <h5>Amount<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" value="{{ $otherCost->amount }}" name="amount" id="amount"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <h5>Date<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="date" value="{{ $otherCost->date }}" name="date" id="date"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <h5>Image<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="file" name="image" class="form-control" id="image">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <img id="showImage"
                                                                src="{{ !empty($otherCost->image) ? url('upload/cost_images/' . $otherCost->image) : url('upload/no_image.jpg') }}"
                                                                alt="" style="width: 100px; border:1px solid #000000">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Row 2th --}}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <h5>Description<span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <textarea name="description" id="description" class="form-control" required=""
                                                                placeholder="Textarea text"
                                                                aria-invalid="false">{{ $otherCost->description }}</textarea>
                                                            <div class="help-block"></div>
                                                        </div>
                                                    </div>
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
    <script>
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0'])
            });
        });
    </script>
@endsection
