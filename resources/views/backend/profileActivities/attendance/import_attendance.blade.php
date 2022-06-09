@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Attendance Management')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Attendance Management')</li>
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
                        <a href="{{route('admin.attendance.create') }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> @lang('Add Attendance')</a>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="add_order_button" data-toggle="tab" href="#load_manual">@lang('Manual Attendance')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="import_tab_button" data-toggle="tab" href="#import_entry">@lang('Import Attendance')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="list_order_button" data-toggle="tab" href="#list_import">@lang('List Attendance')</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane container active" id="load_manual">
                                <div class="load_container">

                                </div>
                                <form method="POST" enctype="multipart/form-data" id="maunal_entry" action="javascript:void(0)">
                                    <div class="form-group row">
                                        <label class="control-label col-2" for="date">@lang('Date')<span style="color: red;"> *</span></label>
                                        <div class="col-4">
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input @error('date') is-invalid @enderror" name="date" id="date" value="{{old('date')}}" placeholder="@lang('Select Date')" data-target="#reservationdate" />
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-2" for="mp_id">@lang('MP')<span style="color: red;"> *</span></label>
                                        <div class="col-4">
                                            <select name="mp_id" id="mp_id" readonly class="form-control select2">
                                                <option value="">@lang('Select MP')</option>
                                                @foreach($mp_list as $m)
                                                <option value="{{$m->user_id}}">{{$m->name_bn}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-2" for="order_name">@lang('Check Type')<span style="color: red;"> *</span></label>
                                        <div class="col-6">
                                            <div class="custom-control custom-switch">
                                                <!-- Group of material radios - option 1 -->
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="materialGroupExample1" name="isPresent">
                                                    <label class="form-check-label" for="materialGroupExample1">@lang('Present')</label>
                                                </div>

                                                <!-- Group of material radios - option 2 -->
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="materialGroupExample2" name="isPresent" checked>
                                                    <label class="form-check-label" for="materialGroupExample2">@lang('Not Present')</label>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-2" for="mp_id">@lang('Check In')<span style="color: red;"> *</span></label>
                                        <div class="col-2">
                                            <div class="input-group date" id="checkin_timepicker" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" name="checkin_time" id="checkin_time" data-target="#checkin_timepicker">
                                                <div class="input-group-append" data-target="#checkin_timepicker" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-2" for="mp_id">@lang('Check Out')<span style="color: red;"> *</span></label>
                                        <div class="col-2">
                                            <div class="input-group date" id="checkout_timepicker" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" name="checkout_time" id="checkout_time" data-target="#checkout_timepicker">
                                                <div class="input-group-append" data-target="#checkout_timepicker" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-info">@lang('Add Attendance')</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane container" id="import_entry">
                                <div class="import_container">

                                </div>
                                <form method="POST" enctype="multipart/form-data" id="import_file_upload" action="javascript:void(0)">
                                    <div class="form-group row">
                                        <label class="control-label col-2" for="import_date">@lang('Date')<span style="color: red;"> *</span></label>
                                        <div class="col-4">
                                            <div class="input-group date" id="importDate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input @error('date') is-invalid @enderror" name="import_date" value="{{old('import_date')}}" placeholder="@lang('Select Date')" data-target="#importDate" />
                                                <div class="input-group-append" data-target="#importDate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-2" for="import_file">@lang('File')(.csv)<span style="color: red;"> *</span> <br>
                                            <a href="{{ asset('public/backend/attachment/mpattendance.csv') }}">Sample File</a>
                                        </label>
                                        <div class="col-4">
                                            <input type="file" name="import_file" placeholder="Choose File" id="import_file">
                                            @if ($errors->has('import_file'))
                                            <span class="invalid-file" role="alert">
                                                <strong>{{ $errors->first('import_file') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-info">@lang('Import Attendance')</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane container" id="list_import">
                                <div class="form-group row">
                                    <label class="control-label col-1" for="list_parliament_session_id">@lang('Date')<span style="color: red;"></span></label>
                                    <div class="col-3">

                                        <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                            <i class="fa fa-calendar"></i>&nbsp;
                                            <span></span> <i class="fa fa-caret-down"></i>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <select name="list_mp_id" id="list_mp_id" readonly class="form-control select2" style="width:100%">
                                            <option value="">@lang('Select MP')</option>
                                            @foreach($mp_list as $m)
                                            <option value="{{$m->user_id}}">{{$m->name_bn}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <select name="parliament_session_id" id="parliament_session_id" readonly class="form-control select2" style="width:100%">
                                            <option value="">@lang('Parliament Session')</option>
                                            @foreach($session_list as $s)
                                            <option value="{{$s->id}}">{{$s->session_no}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-info" onClick="load_data()">@lang('Show Attendances')</button>
                                    </div>
                                </div>
                                <div id="list_container">
                                    <table id="list_import_table" class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>@lang('Date')</th>
                                                <th>@lang('MP')</th>
                                                <th>@lang('Check Type')</th>
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
        $('#importDate').datetimepicker({
            format: 'DD-MM-YYYY'
        });
        $('#checkin_timepicker, #checkout_timepicker').datetimepicker({
        format: 'LT'
        })
    });

    $(document).ready(function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });
        $('#import_file_upload').submit(function(e) {
            console.log('click upload');
            e.preventDefault();
            var formData = new FormData(this);
            //formData.append('import_date', $("#import_date").val());
            $('#load_container').html('<center><img src="{{asset("public/images/lottery.gif")}}"></center>');
            $.ajax({
                type: 'POST',
                url: "{{url('/admin/attendance/import-attendance')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    if (data.success) {
                        Swal.fire('@lang("Data Imported Successfully")', '', 'success');
                    } else {
                        Swal.fire('@lang("something wrong")', '', 'warning');
                    }
                },
                error: function(data) {
                    $('#import_container').html('<center>something wrong</center>');
                }
            });

        });

        $('#maunal_entry').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            //formData.append('import_date', $("#import_date").val());
            $('#load_container').html('<center><img src="{{asset("public/images/lottery.gif")}}"></center>');
            $.ajax({
                type: 'POST',
                url: "{{url('/admin/attendance/save-attendance')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    if (data.success) {
                        Swal.fire('@lang("Data Saved Successfully")', '', 'success');
                    } else {
                        Swal.fire('@lang("something wrong")', '', 'warning');
                    }
                },
                error: function(data) {
                    $('#import_container').html('<center>something wrong</center>');
                }
            });

        });
    });

    function load_data() {
        $('#list_container').html('<center><img src="{{asset("public/images/lottery.gif")}}"></center>');
        $.ajax({
            url: "{{url('/admin/attendance/list-attendance')}}",
            type: "POST",
            data: {
                _token: "{{csrf_token()}}",
                date: $('#reportrange').text().trim(),
                mp_id: $("#list_mp_id").val(),
                parliament_session_id: $("#parliament_session_id").val()
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