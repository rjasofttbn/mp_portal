@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Manage Office Room Type')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.accommodation-management.setup.office_room_types.index') }}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Manage Office Room Type')</li>
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
                    {{-- <h5>@lang(' Type')</h5> --}}
                </div>
                <div class="card-body">
                    <form id="submitForm">
                        @if(@$editData)
                            <input name="_method" type="hidden" value="PUT">
                        @endif
                        @csrf 
                    {{-- <form id="assessmentCommitteeForm" class="form-horizontal" action="{{route('admin.accommodation-management.setup.office_room_types.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf --}}
                        <div class="card-body">
                            <div class="row">   
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label" for="name">@lang('Name (English)')<span
                                                style="color: red;"> *</span></label>
                                        <input type="text" id="name" name="name" value="{{old('name', $data->name)}}"
                                               class="form-control @error('name') is-invalid @enderror"
                                               placeholder="@lang('Enter Name in English')" autocomplete="off" maxlength="30">
    
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>  

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label" for="name_bn">@lang('Name (Bangla)')<span
                                                style="color: red;"> *</span></label>
                                        <input type="text" id="name_bn" name="name_bn"  value="{{ old('name_bn') ?? $data->name_bn ?? '' }}"
                                               class="form-control @error('name_bn') is-invalid @enderror"
                                               placeholder="@lang('Enter Name in Bangla')" autocomplete="off" maxlength="30">
                                        @error('name_bn')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">        
                                        <label class="control-label" for="service_charge">@lang('Service Charge')<span style="color: red;"> *</span></label>
                                         <input type="text" id="service_charge" name="service_charge" value="{{old('service_charge', $data->service_charge)}}"
                                               class="form-control @error('service_charge') is-invalid @enderror"
                                               placeholder="@lang('Enter Service Charge')" autocomplete="off" maxlength="30">
    
                                        @error('service_charge')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                    </div>
                                </div>                    

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group text-right">
                                    
                                       <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                        <a href="{{ route('admin.accommodation-management.setup.office_room_types.index') }}">@lang('Back')</a>
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
                        url : "{{(@$editData)?route('admin.accommodation-management.setup.office_room_types.update',@$editData->id):route('admin.accommodation-management.setup.office_room_types.store') }}",
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
                                   location.replace("{{route('admin.accommodation-management.setup.office_room_types.index')}}");
                               }, 2000);
                            }else if(data.status == 'error'){
                                toastr.error("",data.message);
                                $('[type="submit"]').removeAttr('disabled').css('cursor','pointer');
                                $('.preload').hide();
                            }else{
                                toastr.error('?????????????????? !!?????????????????????????????? ????????????????????????????????? ????????????????????? ??????????????? ???????????? ????????????????????? ????????? ?????????????????? ????????? ???????????? ??????????????? ?????? ???????????? ????????????????????? ????????????????????? ???????????????????????????????????? ??????????????? ', {globalPosition: 'top right',className: 'error',autoHideDelay:10000});
                                $('[type="submit"]').removeAttr('disabled').css('cursor','pointer');
                                $('.preload').hide();
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            toastr.error('?????????????????? !!?????????????????????????????? ????????????????????????????????? ????????????????????? ??????????????? ???????????? ????????????????????? ????????? ?????????????????? ????????? ???????????? ??????????????? ?????? ???????????? ????????????????????? ????????????????????? ???????????????????????????????????? ??????????????? ', {globalPosition: 'top right',className: 'error',autoHideDelay:10000});
                            $('[type="submit"]').removeAttr('disabled').css('cursor','pointer');
                            $('.preload').hide();
                        }
                    });
                }
            });
        });
    </script>
@endsection
