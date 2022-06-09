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
<!-- Main content -->
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class='card-title'>@lang('Update Application')</h4>
            </div>
            <div class="card-body">
                <form id="submitForm">
                    @csrf
                    @if (isset($data))
                    @method('PUT')
                    @endif 
                    <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <label class="control-label" for="subject">@lang('Application Type')</label>
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-8">    
                                        <input type="text" id="subject" name="subject" value="{{$data['subject']}}"
                                        class="form-control @error('subject') is-invalid @enderror subject"
                                        placeholder="@lang('Enter Subject ')" autocomplete="off" readonly>
                            
                                        @error('subject')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="applicationType" id="applicationType" value="{{ $app_id }}">
                            <input type="hidden" name="applicationId" id="applicationId" value="{{ $a_id }}">
                            
           
                    <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <label class="control-label" for="date"> @lang('Change Date') <span class="text-danger"> *</span></label>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input @error('date') is-invalid @enderror date" name="date" value="{{$data['date']}}"
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
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <label class="control-label" for="description">@lang('Change Reason')</label>
                            </div>
                            <div class="col-sm-12 col-md-8 col-lg-8">    
                                <input type="text" id="description" name="description" value="{{$data['description']}}"
                                class="form-control @error('description') is-invalid @enderror description"
                                placeholder="@lang('Enter Change Reason')" autocomplete="off"  >                                
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                            </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                    <a href="{{ route('admin.accommodation.applications.index') }}">@lang('Back')</a>
                                </button>
                                <button type="submit" name="draft" value="@lang('Save as Draft')" class="btn btn-info btn-sm">@lang('Save as Draft')</button>
                                <button type="submit"  name="submit"  value="@lang('Submit')"  class="btn btn-success btn-sm">@lang('Submit')</button>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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
                    url : "{{(@$data)?route('admin.accommodation.applications.update',@$data['id']):route('admin.accommodation.applications.store') }}",
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
                                 }, 10);
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