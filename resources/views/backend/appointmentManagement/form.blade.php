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
                    <div class="text-right">
                        <a href="{{route('admin.appointment-management.appointment-request.index') }}" class="btn btn-sm btn-info"><i class="fas fa-arrow-left"></i> @lang('Appointment List')</a>
                    </div>
                </div>
                <!-- Form Start-->
                <form id="parliamentForm" name="parliamentForm" method="POST"
                      @if($data->id)
                      action="{{ route('admin.appointment-management.appointment-request.update', $data->id) }}">
                    <input name="_method" type="hidden" value="PUT">
                    @else
                        action="{{ route('admin.appointment-management.appointment-request.store') }}">
                    @endif
                    @csrf

                    <input type="hidden" id="id" name="id" value="{{$data->id}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- radio -->
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary1" value="0" name="type" {{ $data->type == 0?'checked':''}}>
                                        <label for="radioPrimary1">
                                            @lang('Self')
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary2" value="1" name="type" {{ $data->type == 1?'checked':''}}>
                                        <label for="radioPrimary2">
                                            @lang('Minister')
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary3" value="2" name="type" {{ $data->type == 2?'checked':''}}>
                                        <label for="radioPrimary3">
                                            @lang('MP')
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6" id="ministry">
                                <div class="form-group">
                                    <label class="control-label" for="ministry_id">@lang('Ministry')<span style="color: red;"> *</span></label>
                                    <select id="ministry_id" name="ministry_id" class="form-control select2 @error('ministry_id') is-invalid @enderror" >
                                        <option value="">@lang('Select Ministry')</option>
                                        @foreach ($ministry_list as $list)
                                        <option value="{{$list->id}}" {{($data->ministry_id==$list->id)? 'selected':''}}>
                                            @if(session()->get('language') =='bn')
                                            {{$list['name_bn']}}
                                            @else
                                            {{$list['name']}}
                                            @endif
                                        </option>
                                    
                                        @endforeach
                                    </select>

                                    @error('ministry_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6" id="mp_list">
                                <div class="form-group">
                                    <div id="ajax_mp_list">
                                    </div>

                                    @error('requested_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
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
                            <div class="col-sm-4">
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
                            <div class="col-sm-4">
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
                            <div class="col-sm-12" id="ap_place">
                                <div class="form-group">
                                    <label class="control-label" for="place">@lang('Place')<span
                                            style="color: red;"> *</span></label>
                                    <input type="text" id="place" name="place"
                                           class="form-control" placeholder="@lang('Type Place')"/>

                                    @error('topics')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <input type="hidden" name="status" id="status" value="0">
                            <input type="hidden" name="requested_id" id="requested_id" value="{{old('requested_id', $data->requested_to)}}">

                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                        <a href="{{route('admin.appointment-management.appointment-request.index') }}">@lang('Back')</a>
                                    </button>
                                    @if($data->id)
                                        <a href="{{ url('appointment-management/appointment-request/declined') }}/{{ $data->id }}">>@lang('Back')</a>
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
            $('.preload').show();
            setTimeout(() => {
                $('.preload').hide();
            }, 1000);
            // var appointment_type = {{ $data->type }}
            // if(appointment_type == 1){
            //     $('#ap_place').hide();
            //     $('#ministry').hide();
            //     $('#mp_list').hide();
            // }
            // if(appointment_type == 2){
            //     $('#ap_place').hide();
            //     $('#ministry').hide();
            //     $('#mp_list').hide();
            // }
            //if(appointment_type == 0){
                $('#ap_place').hide();
                $('#ministry').hide();
                $('#mp_list').hide();
            //}
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
        $('#ministry_id').on('change', function() {
            var requested_to = $('#requested_id').val();
            $.ajax({
                    url : "{{url('/appointment-management/appointment-request/get_ministry_list')}}",
                    data : {requested_to:requested_to, ministry_id: this.value},
                    type : "get",
                    beforeSend : function(){
                        $('.preload').show();
                    },
                    success:function(data){
                        $('.preload').hide();
                        $('#ajax_mp_list').html(data);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        toastr.error('দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য দেখা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান ', {globalPosition: 'top right',className: 'error',autoHideDelay:10000});
                        $('.preload').hide();
                    }
                });
        });
        $('input[type=radio][name=type]').change(function() {
            var requested_to = $('#requested_id').val();
            //alert(requested_to)
           
            if (this.value == '0') {
                $('#ajax_mp_list').hide();
                $('#ap_place').hide();
                $('#ministry').hide();
            }
            else if (this.value == '1') {
                //$('#ajax_mp_list').show();
                $('#ap_place').show();
                $('#ministry').show();
                $('#mp_list').show();
                $.ajax({
                    url : "{{url('/appointment-management/appointment-request/get_ministry_list')}}",
                    data : {requested_to:requested_to, ministry_id: $('#ministry_id').val()},
                    type : "get",
                    beforeSend : function(){
                        $('.preload').show();
                    },
                    success:function(data){
                        $('.preload').hide();
                        $('#ajax_mp_list').html(data);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        toastr.error('দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য দেখা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান ', {globalPosition: 'top right',className: 'error',autoHideDelay:10000});
                        $('.preload').hide();
                    }
                });
            }
            else if (this.value == '2') {
                $('#ajax_mp_list').show();
                $('#ap_place').show();
                $('#ministry').hide();
                $('#mp_list').show();
                $.ajax({
                    url : "{{url('/appointment-management/appointment-request/get_mp_list')}}",
                    data : {requested_to:requested_to},
                    type : "get",
                    beforeSend : function(){
                        $('.preload').show();
                    },
                    success:function(data){
                        $('.preload').hide();
                        $('#ajax_mp_list').html(data);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        toastr.error('দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য দেখা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান ', {globalPosition: 'top right',className: 'error',autoHideDelay:10000});
                        $('.preload').hide();
                    }
                });
            }
        });
    </script>
@endsection

