@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('High Official Application Management')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.accommodation.applications.index') }}">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('High Official Application Management')</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="content">
    <div class="col-md-12">
        {{-- @if (!empty($acc_app))  --}}
        <div class="card">
            <div class="card-header">
                <h4 class='card-title'>@lang('Allotment Cancel Application')</h4>
            </div>
          {{--  <div class="card-body">
             <h4><u>@lang('Current Allotment Information')</u></h4>
            <p  >
                <Ul style=" line-height: 40px; font-size: 15px; list-style-type: square;">
                    @foreach($mp_apps as $mp_app)
                   <b>@lang('Area Name') : </b> {{ $mp_app->area_bn }};
                    <b>@lang('Accommodation Building') : </b>{{ $mp_app->ac_building_bn }};                 
                    <b>@lang('Floor No') : </b>{{ $mp_app->floor_bn }};
                    <b>@lang('Flat No') : </b>{{ $mp_app->flat_no_bn }};
                    <b>@lang('Flat Size') : </b>{{ $mp_app->size }};
                     <b>@lang('Approval Date') : </b>
                        {{ date('d-m-Y', strtotime($mp_app->created_at)) }};
                        <br>
                        <hr>
                        @endforeach 
                </Ul>
            </p> 

                </div>--}}
                </div>
        <div class="card">
            <div class="card-body">
                {{-- <form id="submitForm">
                    @csrf
                    @if (isset($editData))
                    @method('PUT')
                    @endif  --}}
                <form class="form-horizontal" action="{{route('admin.accommodation.applications.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <label class="control-label" for="subject">@lang('Application Type') <span class="text-danger"> *</span></label>
                            </div>
                            <div class="col-sm-12 col-md-7 col-lg-7">
                                <input type="text" id="subject" name="subject" value="{{$applicationTypesubject}}"
                                    class="form-control @error('subject') is-invalid @enderror subject"
                                    placeholder="@lang('Enter Subject ')" autocomplete="off" readonly>
    

                                @error('subject')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="applicationType" id="applicationType" value="{{ $applicationType }}">
                    <input type="hidden" name="approve_id" id="approve_id" value="{{ $approve_id }}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-2 col-lg-2">
                                        <label class="control-label" for="date"> @lang('Cancel Date') <span class="text-danger"> *</span></label>
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input @error('date') is-invalid @enderror date" name="date" 
                                            id="datepicker" 
                                            value="{{old('date')}}" placeholder="@lang('Select Date')" data-target="#reservationdate" />
                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>

                                        @error('date')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                        </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <label class="control-label" for="cancel_reason">@lang('Cancel Reason') <span class="text-danger"> *</span></label>
                            </div>
                            <div class="col-sm-12 col-md-7 col-lg-7">
                                <input type="text" id="description" name="description" value=""
                                class="form-control @error('description') is-invalid @enderror description"
                                placeholder="@lang('Cancel Reason')" autocomplete="off" maxlength="30" >
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                    <a href="{{ route('admin.accommodation.applications.index') }}">@lang('Back')</a>
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                @if (auth()->user()->usertype != 'ps')
                                    <input type="submit" name="draft" value="@lang('Save as Draft')" class="btn btn-info btn-sm">
                                    <input type="submit" name="submit" value="@lang('Submit')" class="btn btn-success btn-sm">
                                @else
                                    <input type="submit" name="submit" value="@lang('Submit')" class="btn btn-success btn-sm">
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>     
    </div>
    <script>
        $(document).ready(function(){
            $('#submitForm').validate({
                ignore:[],
                errorPlacement: function(error, element){
                    error.insertAfter(element);
                },
                errorClass:'text-danger',
                validClass:'text-success',
    
                submitHandler: function (form) {
                    event.preventDefault();
                    $('[type="submit"]').attr('disabled','disabled').css('cursor','not-allowed');
                    var formInfo = new FormData($("#submitForm")[0]);
                    $.ajax({
                        url : "{{(@$editData)?route('admin.accommodation.flatAll.update',@$editData['id']):route('admin.accommodation.applications.store') }}",
                        data : formInfo,
                        type : "POST",
                        processData: false,
                        contentType: false,
                        beforeSend : function(){
                            $('.preload').show();
                        },
                        
                        success:function(data){
                                    if(data.status == 'success'){
                                        toastr.success("",data.message);
                                        $('.preload').hide();
                                        setTimeout(function(){
                                         location.replace("{{route('admin.accommodation.applications.mp.appNewList')}}");
                                     }, 2000);
                                    }else if(data.status == 'error'){
                                        toastr.error("",data.message);
                                        $('[type="submit"]').removeAttr('disabled').css('cursor','pointer');
                                        $('.preload').hide();
                                    }else{
                                        toastr.error('দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য সংরক্ষন করা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান', {globalPosition: 'top right',className: 'error',autoHideDelay:10});
                                        $('[type="submit"]').removeAttr('disabled').css('cursor','pointer');
                                        $('.preload').hide();
                                    }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            toastr.error('দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য সংরক্ষন করা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান', {globalPosition: 'top right',className: 'error',autoHideDelay:10000});
                            $('[type="submit"]').removeAttr('disabled').css('cursor','pointer');
                            $('.preload').hide();
                        }
                    });
                }
            });
        });
    </script>
    @endsection
    @section('script')
    <script>
        $(function() {
            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'YYYY-MM-DD',
            });
        })
    </script>
@endsection

