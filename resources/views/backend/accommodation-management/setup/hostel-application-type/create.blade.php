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
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Application Type Management')</li>
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
                    {{-- <form method="POST" action="{{ route('admin.accommodation-management.setup.hostel_application_types.store') }}">
                        @csrf --}}
                        <form id="submitForm">
                            @if(@$data)
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
                                value="{{ old('subject')}}" placeholder="@lang('Enter Subject of Application')">
                                    @error('subject')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="type_name">@lang('Application Type') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-7 col-lg-7">
                                    <input type="text" name="type_name" id="type_name" class="form-control @error('type_name') is-invalid @enderror type_name"
                             value="{{ old('type_name')}}" placeholder="@lang('Enter Application Type')">
                                    @error('type_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <label class="control-label">@lang('1'). @lang('Subject of Application')<span class="text-danger"> *</span></label>
                            <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror"
                                value="{{ old('subject')}}" placeholder="@lang('Enter Subject of Application')">
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div> --}}
                        <div class="row">
                            {{-- <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="control-label" for="accommodation_type">@lang('2'). @lang('Accommodation Type') <span class="text-danger"> *</span></label>
                                    
                                    <select id="accommodationType" name="accommodation_type" class="@error('accommodation_type') is-invalid @enderror form-control form-control-sm select2">
                                        <option selected value="">@lang('Select Accommodation Type')</option>
                                        @foreach($accommodationTypes as $data)
										<option value="{{$data->id}}">{{ Lang::get($data->name) }}</option>
                                        @endforeach
                                    </select>

                                    <div>
                                        @error('accommodation_type')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}

                            <div class="col-sm-12 col-md-6 col-lg-6">
                               
                                <div id="typeFlat" class="form-group d-none">
                                    <label class="control-label" for="type_name">@lang('3'). @lang('Application Type') <span class="text-danger"> *</span></label>
                                    <select name="" class="@error('type_name') is-invalid @enderror form-control form-control-sm select2 type_name">
                                        <option selected value="">@lang('Select Application Type')</option>
										<option value="flatAllotment" {{ old('type_name') == 'flatAllotment' ? 'selected' : '' }}>@lang('Flat Allotment')</option>
                                        <option value="flatCancel" {{ old('type_name') == 'flatCancel' ? 'selected' : '' }}>@lang('Flat Cancel')</option>
                                        <option value="flatExchange" {{ old('type_name') == 'flatExchange' ? 'selected' : '' }}>@lang('Flat Exchange')</option>
								   </select>

                                    <div>
                                        @error('type_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
								<div id="typeHouse" class="form-group d-none">
                                    <label class="control-label" for="type_name">@lang('3'). @lang('Application Type') <span class="text-danger"> *</span></label>
                                    <select name="" class="@error('type_name') is-invalid @enderror form-control form-control-sm select2 type_name">
                                        <option selected value="">@lang('Select Application Type')</option>
										<option value="houseAllotment" {{ old('type_name') == 'houseAllotment' ? 'selected' : '' }}>@lang('House Allotment')</option>
                                        <option value="houseCancel" {{ old('type_name') == 'houseCancel' ? 'selected' : '' }}>@lang('House Cancel')</option>
                                        <option value="houseExchange" {{ old('type_name') == 'houseExchange' ? 'selected' : '' }}>@lang('House Exchange')</option>  
								   </select>

                                    <div>
                                        @error('type_name')
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
                                        <a href="{{ url()->previous() }}">@lang('Back')</a>
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                    <button type="submit" class="btn btn-success btn-sm">@lang('Submit')</button>
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
                        url : "{{(@$data)?route('admin.accommodation-management.setup.hostel_application_types.update',@$data['id']):route('admin.accommodation-management.setup.hostel_application_types.store') }}",
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
                                toastr.error('দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য সংরক্ষন করা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান ', {globalPosition: 'top right',className: 'error',autoHideDelay:10000});
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
