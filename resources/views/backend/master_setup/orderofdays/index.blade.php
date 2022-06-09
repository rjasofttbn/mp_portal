@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Orders of Day Management')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Orders of Day Management')</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-right">
                        <!--  <a href="" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> @lang('Add Rule')</a> -->
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="add_order_button" data-toggle="tab" href="#load_orders">@lang('Add Orders')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="list_order_button" data-toggle="tab" href="#list_orders">@lang('List Orders')</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane container active" id="load_orders">
                                <div class="load_container">

                                </div>
                                <form method="POST" enctype="multipart/form-data" id="order_file_upload" action="javascript:void(0)">
                                    <div class="form-group row">
                                        <label class="control-label col-2" for="order_date">@lang('Order Date')<span style="color: red;"> *</span></label>
                                        <div class="col-4">
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input @error('date') is-invalid @enderror" name="order_date" id="order_date" value="{{old('order_date')}}" placeholder="@lang('Select Date')" data-target="#reservationdate" />
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group row d-none">
                                        <label class="control-label col-2" for="order_name">@lang('Order Name')<span style="color: red;"> *</span></label>
                                        <div class="col-4">
                                            <input type="text" name="order_name" placeholder="Order name" id="order_name" class="form-control" value="test">
                                            @if ($errors->has('order_name'))
                                            <span class="invalid-file" role="alert">
                                                <strong>{{ $errors->first('order_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-2" for="order_document">@lang('File')<span style="color: red;"> *</span></label>
                                        <div class="col-4">
                                            <input type="file" name="order_document" placeholder="Choose File" id="order_document">
                                            @if ($errors->has('order_document'))
                                            <span class="invalid-file" role="alert">
                                                <strong>{{ $errors->first('order_document') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-info">@lang('Add Orders')</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane container" id="list_orders">
                                <div class="form-group row">
                                    <label class="control-label col-2" for="list_parliament_session_id">@lang('Order Date')<span style="color: red;"> *</span></label>
                                    <div class="col-3">
                                       
                                        <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                            <i class="fa fa-calendar"></i>&nbsp;
                                            <span></span> <i class="fa fa-caret-down"></i>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <button type="button" class="btn btn-info" onClick="load_data()">@lang('Show Orders')</button>
                                    </div>
                                </div>
                                <div id="list_container">
                                    <table id="list_orders_table" class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>@lang('Date')</th>
                                                <!-- <th>@lang('Order Name')</th> -->
                                                <th>@lang('Order Document')</th>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!--/. container-fluid -->
</section>
<script>
    $(document).ready(function() {
        $('#reservationdate, #list_order_date').datetimepicker({
            format: 'DD-MM-YYYY'
        });
    });

    $(document).ready(function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });
        $('#order_file_upload').submit(function(e) {
            console.log('click upload');
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('order_date', $("#order_date").val());
            formData.append('order_name', $("#order_name").val());
            $('#load_container').html('<center><img src="{{asset("public/images/lottery.gif")}}"></center>');
            $.ajax({
                type: 'POST',
                url: "{{url('/admin/master-setup/orderofdays/order_action')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    if (data.success) {
                        $('#load_container').html('<center>successfully uploaded</center>');
                        setTimeout(function() {
                            $("#list_order_button").click();
                            load_data();
                        }, 1000);

                    } else {
                        $('#load_container').html('<center>something wrong</center>');

                    }
                },
                error: function(data) {
                    $('#load_container').html('<center>something wrong</center>');
                }
            });

        });
    });

    function load_data() {
        $('#list_container').html('<center><img src="{{asset("public/images/lottery.gif")}}"></center>');
        $.ajax({
            url: "{{url('/admin/master-setup/orderofdays/list_orders')}}",
            type: "POST",
            data: {
                _token: "{{csrf_token()}}",
                order_date: $('#reportrange').text().trim() //$("#search_order_date").val()
            },
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == true) {
                    $('#list_container').html(response.data);
                    $("#list_orders_table").DataTable({

                    });
                } else {
                    Swal.fire('@lang("No Data Found")', '', 'error');
                    $('#list_container').html('');
                }
            }
        });

    }
</script>

<script type="text/javascript">
    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('D-MM-YYYY') + ' ~ ' + end.format('D-MM-YYYY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

    });
</script>

@endsection