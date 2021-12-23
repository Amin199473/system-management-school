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
                                <h4 class="box-title">Manage <strong>Monthly/Yearly Profit</strong></h4>
                            </div>
                            <div class="box-body">
                                <div class="row pb-4">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Start Date<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="start_date" id="start_date" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>End Date<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="end_date" id="end_date" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4" style="padding-top: 25px;">
                                        <a name="search" id="search" class="btn btn-primary" href="#" role="button">Search</a>
                                    </div>
                                </div>

                                {{-- Registration Fee Table --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div  id="DocumentResults">
                                            <script id="document-template" type="text/x-handlebars-template">
                                                <table class="table table-bordered table-striped" style="width: 100%">
                                                    <thead>
                                                        <tr>
                                                    @{{{thsource}}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>
                                                            @{{{tdsource}}}
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                {{--End Registration Fee Table --}}

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


    {{-- Start Roll Generated --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>
    <script type="text/javascript">
        $(document).on('click','#search',function(){
          var start_date = $('#start_date').val();
          var end_date = $('#end_date').val();
           $.ajax({
            url: "{{ route('getMonthlyProfit')}}",
            type: "get",
            data: {'start_date':start_date ,'end_date':end_date },
            beforeSend: function() {
            },
            success: function (data) {
              var source = $("#document-template").html();
              var template = Handlebars.compile(source);
              var html = template(data);
              $('#DocumentResults').html(html);
              $('[data-toggle="tooltip"]').tooltip();
            }
          });

        });

      </script>
@endsection
