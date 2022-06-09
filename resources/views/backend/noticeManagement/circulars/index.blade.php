@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Circulars')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Circulars')</li>
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
                                <a class="nav-link active" data-toggle="tab" href="#load_circular">@lang('Add Circular')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#list_circular">@lang('List Circulars')</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane container active" id="load_circular">

                                <div class="form-group row">
                                    <label class="control-label col-2" for="load_parliament_session_id">@lang('Parliament Session')<span style="color: red;"> *</span></label>
                                    <div class="col-4">
                                        <select id="load_parliament_session_id" name="load_parliament_session_id" class="form-control select2 @error('load_parliament_session_id') is-invalid @enderror">
                                            <option value="">@lang('Select Parliament Session')</option>
                                            @foreach($session_list as $list)
                                            <option value="{{$list->id}}">@php echo Lang::get($list->session_no) @endphp </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <button type="button" class="btn btn-info" onClick="load_data('api_call')">@lang('Load Circulars')</button>
                                    </div>
                                </div>
                                <div id="load_container">

                                </div>

                            </div>
                            <div class="tab-pane container" id="list_circular">
                                <div class="form-group row">
                                    <label class="control-label col-2" for="list_parliament_session_id">@lang('Parliament Session')<span style="color: red;"> *</span></label>
                                    <div class="col-4">
                                        <select id="list_parliament_session_id" name="list_parliament_session_id" class="form-control select2 @error('llist_parliament_session_id') is-invalid @enderror">
                                            <option value="">@lang('Select Parliament Session')</option>
                                            @foreach($session_list as $list)
                                            <option value="{{$list->id}}">@php echo Lang::get($list->session_no) @endphp </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <button type="button" class="btn btn-info" onClick="load_data('list')">@lang('Show Circulars')</button>
                                    </div>
                                </div>
                                <div id="list_container">
                                    <table id="list_circular_table" class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>@lang('Date')</th>
                                                <th>@lang('Ministry')</th>
                                                <th>@lang('Ministry Wings')</th>
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
    function load_data(type) {
        var request_data = {};
        if (type == 'api_call') {
            request_data = {
                _token: "{{csrf_token()}}",
                parliament_session_id: $("#load_parliament_session_id").val(),
                call_type: type
            };
            $('#load_container').html('<center><img src="{{asset("public/images/lottery.gif")}}"></center>');
        } else if (type == 'list') {
            request_data = {
                _token: "{{csrf_token()}}",
                parliament_session_id: $("#list_parliament_session_id").val(),
                call_type: type
            };
            $('#list_container').html('<center><img src="{{asset("public/images/lottery.gif")}}"></center>');
        }
        $.ajax({
            url: "{{url('admin/notice-management/circulars_list')}}",
            type: "POST",
            data: request_data,
            success: function(response) {
                response = JSON.parse(response);
                if (response.status == true) {
                    if (type == 'api_call') {
                        $('#load_container').html(response.data);
                        $("#load_circular_table").DataTable({

                        });
                    }
                    if (type == 'list') {
                        $('#list_container').html(response.data);
                        $("#list_circular_table").DataTable({

                        });
                    }
                    //location.reload();
                } else {
                    Swal.fire('@lang("No Data Found")', '', 'error');
                    if (type == 'api_call') {
                        $('#load_container').html('');
                    }
                    if (type == 'list') {
                        $('#list_container').html('');
                    }
                }
            }
        });

    }
</script>
@endsection