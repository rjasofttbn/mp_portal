@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Application Type Management')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.accommodation-management.setup.hostel_application_types.index') }}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Application Type Management')
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title w-100">
                        <a href="{{ route('admin.accommodation-management.setup.hostel_application_types.index') }}"
                            class="btn btn-info float-right"><i class="fa fa-list mr-2"></i> @lang('Application Type List')</a>
                    </h4>
                </div>
                <div class="card-body">
                    {{-- <form method="POST" action="{{ route('admin.accommodation-management.setup.hostel_application_types.update', $editData->id) }}">
                        @csrf
                        @if (isset($editData))
                            @method('PUT')
                        @endif --}}

                        <form id="submitForm">
                            @if(@$editData)
                                <input name="_method" type="hidden" value="PUT">
                            @endif
                            @csrf 

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="subject">@lang('Subject of Application') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-7 col-lg-7">
                                    <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror subject"
                                    value="{{ old('subject') ?? $editData->subject ?? '' }}" placeholder="Enter Application Subject">
                                    @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="type_name">@lang('Hostel Type') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-7 col-lg-7">
                                <input type="text" name="type_name" id="type_name" class="form-control @error('type_name') is-invalid @enderror type_name"
                                    value="{{ old('type_name') ?? $editData->type_name ?? '' }}" placeholder="Enter Application Type">
                                    @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="type_name"> <span class="text-danger"> *</span></label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="status" {{ $editData->status == 1 ? 'checked' : '' }} value="1" class="custom-control-input status" id="active-status">
                                    @if ($editData->status == 1)
                                              <label class="custom-control-label" for="active-status">@lang('Make it inactive ?')</label>  
                                            @else
                                                 <label class="custom-control-label" for="active-status">@lang('Make it active ?')</label> 
                                            @endif
                                  
                                </div>
                                </div>
                            </div>
                                                 
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                        <a href="{{ url()->previous() }}">@lang('Back')</a>
                                    </button>
                                    {{-- <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button> --}}
                                    <button type="submit" class="btn btn-success btn-sm">@lang('Update')</button>
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
                        url : "{{(@$editData)?route('admin.accommodation-management.setup.hostel_application_types.update',@$editData['id']):route('admin.accommodation-management.setup.hostel_application_types.store') }}",
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
                                   location.replace("{{route('admin.accommodation-management.setup.hostel_application_types.index')}}");
                               }, 2000);
                            }else if(data.status == 'error'){
                                toastr.error("",data.message);
                                $('[type="submit"]').removeAttr('disabled').css('cursor','pointer');
                                $('.preload').hide();
                            }else{
                                toastr.error('দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য সংরক্ষন করা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান', {globalPosition: 'top right',className: 'error',autoHideDelay:10000});
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
