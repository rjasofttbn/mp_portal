@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Appointment Management')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Appointment Management')</li>
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
                    @if($data->id)
                    <h4 class='card-title'>@lang('Update Appointment')</h4>
                    @else
                    <h4 class='card-title'>@lang('Create Appointment')</h4>
                    @endif
                </div>
                <!-- Form Start-->
                <form id="parliamentForm" name="parliamentForm" method="POST"
                      @if($data->id)
                      action="{{ route('admin.profile_activities.appointments.update', $data->id) }}">
                    <input name="_method" type="hidden" value="PUT">
                    @else
                        action="{{ route('admin.profile_activities.appointments.store') }}">
                    @endif
                    @csrf

                    <input type="hidden" id="id" name="id" value="{{$data->id}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="date">@lang('Date')<span
                                            style="color: red;"> *</span></label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input @error('date') is-invalid @enderror"
                                               name="date"
                                               value="{{old('date', $data->date)}}"
                                               placeholder="@lang('Select Date')" autocomplete="off" maxlength="30"
                                               data-target="#reservationdate"/>
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>

                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="time_from">@lang('Time From')<span
                                            style="color: red;"> *</span></label>
                                    <div class="input-group date" id="reservationtimefrom" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input @error('time_from') is-invalid @enderror"
                                               name="time_from"
                                               value="{{old('time_from', $data->time_from)}}"
                                               placeholder="@lang('Select Time')" autocomplete="off" maxlength="30"
                                               data-target="#reservationtimefrom"/>
                                        <div class="input-group-append" data-target="#reservationtimefrom" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                        </div>
                                    </div>

                                    @error('time_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="time_to">@lang('Time To')<span
                                            style="color: red;"> *</span></label>
                                    <div class="input-group date" id="reservationtimeto" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input @error('time_to') is-invalid @enderror"
                                               name="time_to"
                                               value="{{old('time_to', $data->time_to)}}"
                                               placeholder="@lang('Select Time')" autocomplete="off" maxlength="30"
                                               data-target="#reservationtimeto"/>
                                        <div class="input-group-append" data-target="#reservationtimeto" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                        </div>
                                    </div>

                                    @error('time_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="requested_to">@lang('Request To')<span
                                            style="color: red;"> *</span></label>
                                    <select id="requested_to" name="requested_to" class="form-control @error('requested_to') is-invalid @enderror">
                                        <option value="">@lang('Select MP')</option>
                                        @foreach ($profileList as $list)
                                            @if($list['id']==$data->requested_to or $list['id']==old('requested_to'))
                                                <option selected
                                                        value="{{$list['id']}}">{{$list['name_eng']}}</option>
                                            @else
                                                <option  value="{{$list['id']}}">{{$list['name_eng']}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('requested_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label" for="topics">@lang('Purpose of Appointment')<span
                                            style="color: red;"> *</span></label>
                                    <textarea id="topics" name="topics"
                                           class="textareaWithoutImgVideo form-control @error('topics') is-invalid @enderror">
                                        {{old('topics', $data->topics)}}
                                    </textarea>

                                    @error('topics')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <input type="hidden" name="status" id="status" value="0">

                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                        <a href="{{route('admin.profile_activities.appointments.index') }}">@lang('Back')</a>
                                    </button>
                                    @if($data->id)
                                        <button type="submit" class="btn btn-success btn-sm">@lang('Update')</button>
                                    @else
                                        <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                        <button type="submit" class="btn btn-success btn-sm">@lang('Save')</button> 
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--Form End-->
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(function () {
            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'DD MMMM, YYYY'
            });
            $('#reservationtimefrom').datetimepicker({
                format: 'hh:mm A'
            });
            $('#reservationtimeto').datetimepicker({
                format: 'hh:mm A'
            });
        })
    </script>
@endsection

