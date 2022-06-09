@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Attendance Management')</h1>
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

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if ($data->id)
                        <h4 class="card-title">@lang('Update Attendance')</h4>
                    @else
                        <h4 class="card-title">@lang('Create Attendance')</h4>
                    @endif
                    
                </div>
                <!-- Form Start-->
                <form id="attendanceForm" name="attendanceForm" method="POST"
                      @if($data->id)
                      action="{{ route('admin.attendance.update', ['id' => $data->id]) }}">
                    <input name="_method" type="hidden" value="PUT">
                    @else
                        action="{{ route('admin.attendance.store') }}">
                    @endif
                    @csrf

                    <input type="hidden" id="id" name="id" value="{{$data->id}}">
                    <div class="card-body">
                        <div class="row">


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="user_id">@lang('MP Name')<span
                                            style="color: red;"> *</span></label>
                                    <select id="user_id" name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                        <option value="">@lang('Select MP Name')</option>
                                        @foreach ($profileList as $list)
                                            @if($list['user_id']==$data->user_id or $list['user_id']==old('user_id'))
                                                <option selected
                                                        value="{{$list['user_id']}}">{{$list['name_bn']}}</option>
                                            @else
                                                <option  value="{{$list['user_id']}}">{{$list['name_bn']}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="parliament_id">@lang('Parliament')<span
                                            style="color: red;"> *</span></label>
                                    <select id="parliament_id" name="parliament_id" class="form-control @error('parliament_id') is-invalid @enderror">
                                        <option value="">@lang('Select Parliament')</option>
                                        @foreach ($parliamentList as $list)
                                            @if($list['id']==$data->parliament_id or $list['id']==old('parliament_id'))
                                                <option selected
                                                        value="{{$list['id']}}">{{$list['parliament_number']}}</option>
                                            @else
                                                <option  value="{{$list['id']}}">{{$list['parliament_number']}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('parliament_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="session_id">@lang('Parliament Session')<span
                                            style="color: red;"> *</span></label>
                                    <select id="session_id" name="session_id" class="form-control @error('session_id') is-invalid @enderror">
                                        <option value="">@lang('Select Parliament Session')</option>
                                        @foreach ($sessionList as $list)
                                            @if($list['id']==$data->session_id or $list['id']==old('session_id'))
                                                <option selected
                                                        value="{{$list['id']}}">{{$list['session_no']}}</option>
                                            @else
                                                <option  value="{{$list['id']}}">{{$list['session_no']}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('session_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="hidden" name="date" id="date" value="">
                                    <label class="control-label" for="date">Date<span
                                            style="color: red;"> *</span></label>
                                    <input type="text" id="date_text" name="date_text" value=""
                                           class="form-control"
                                           placeholder="Enter date" autocomplete="off" maxlength="30" disabled>
                                </div>
                            </div> --}}



                             {{--Javascript Calander Load--}}

                         {{--   <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="date">Date<span
                                            style="color: red;"> *</span></label>
                                    <input type="text" id="date" name="date" value="{{old('date', $data->date)}}"
                                           class="form-control datepicker @error('date') is-invalid @enderror"
                                           placeholder="Enter date" autocomplete="off" maxlength="30">

                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>--}}
                            
                                <div class="col-sm-4">
                                        <div class="form-group">
                                        <label class="control-label" for="date">@lang('Date') <span class="text-danger"> *</span></label>

                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" 
                                            class="form-control datetimepicker-input @error('date') is-invalid @enderror" 
                                            name="date" 
                                            id="datepicker" 
                                           
                                            value="{{old('date')}}" 
                                            placeholder="@lang('Select Date')" data-target="#reservationdate" />

                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                    
                                        @error('date')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                            <input type="hidden" name="status" id="status" value="1">
                        @if($data->id)
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="status">Status <span style="color: red;"> *</span></label>

                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" value="1" id="status_1"
                                               name="status" @if($data->status==1) {{"checked"}} @endif checked>
                                        <label for="status_1" class="custom-control-label">Active</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" value="0" id="status_0"
                                               name="status" @if($data->status==0) {{"checked"}} @endif>
                                        <label for="status_0" class="custom-control-label">Inactive</label>
                                    </div>
                                    <div>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>

                                </div>
                            </div>
                        @endif

                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-right">
                                    @if($data->id)
                                        <button type="submit" class="btn btn-success btn-sm">@lang('Update')</button>
                                    @else
                                        <button type="submit" class="btn btn-success btn-sm">@lang('Save')</button>
                                        <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                    @endif
                                    <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                        <a href="{{route('admin.attendance.index') }}">@lang('Back')</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--Form End-->
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            // Author Rajan Bhatta: create date: 01-02-2021
            // Get Session List By parliament Id:

            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'DD-MM-YYYY',
            });

            $('select[name="parliament_id"]').on('change', function () {
                var parliament_id = $(this).val();


                $('select[name="session_id"]').empty();
                $('select[name="session_id"]').append('<option value="">Select Session</option>');


                if (parliament_id > 0) {
                    $.ajax({
                        url: '{{url("sessionListByParliamentId")}}',
                        data:{parliament_id:parliament_id},
                        type: "GET",
                        dataType: "json",
                        beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },
                        success: function (result) {
                            $.each(result.data, function (k, val) {
                                $('select[name="session_id"]').append('<option value="' + val.id + '">' + val.session_no + '</option>');
                            });
                        },
                        complete: function () {
                            //$('#loader').css("visibility", "hidden");
                        }
                    });
                } else {

                    $('select[name="session_id"]').empty();
                    $('select[name="session_id"]').append('<option value="">Select Session</option>');

                }

            });




            // Author Rajan Bhatta: create date: 02-02-2021
            // Get Session Date By Session Id:

            $('select[name="session_id"]').on('change', function () {
                var session_id = $(this).val();



                $("#date_text").val("");
                $("#date").val("");


                if (session_id > 0) {
                    $.ajax({
                        url: '{{url("sessionDateBySessionId")}}',
                        data:{session_id:session_id},
                        type: "GET",
                        dataType: "json",
                        beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },
                        success: function (result) {
                            $("#date_text").val(result.data.date);
                            $("#date").val(result.data.date);
                        },
                        complete: function () {
                            //$('#loader').css("visibility", "hidden");
                        }
                    });
                } else {
                    $("#date_text").val("");
                    $("#date").val("");

                }

            });

        });
    </script>

@endsection
