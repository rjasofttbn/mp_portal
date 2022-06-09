@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Block Management')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admin.accommodation-management.setup.hostel_floors.index">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Block Management')</li>
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
                    <h4 class="card-title w-100">@lang('')
                        <a href="{{ route('admin.accommodation-management.setup.hostel_floors.index') }}"
                            class="btn btn-info float-right"><i class="fa fa-list mr-2"></i> @lang('Block List')</a>
                    </h4>
                </div>
                <div class="card-body">
                    {{-- <form method="POST" action="{{ route('admin.accommodation-management.setup.hostel_floors.store') }}">
                        @csrf --}}
                        <form id="submitForm">
                            @csrf  
                        <div class="card-body">
                            <div class="form-group">                           
                                <div class="row">
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <label class="control-label" for="Building">@lang('Selected The Building Name') <span
                                                class="text-danger"> *</span></label>                                          
                                    </div>
                                    <div class="col-sm-12 col-md-5 col-lg-5">
                                                 {{-- <select id="building_id" name="building_id" --}}
                                                 <select id="building_id" name="building_id" class="form-control @error('building_id') is-invalid @enderror building_id building_id">
                                                    <option value="">@lang('Selected The Building Name')</option>
                                           
                                         
                                            @foreach ($hostelBuildingList as $list)
                                            @if($list['id']==$data->building_id or $list['id']==old('building_id'))  
                            
                                                <option selected
                                                value="{{$list['id']}}">{{$list['name']}}</option>
                                                    @else
                                                        <option  value="{{$list['id']}}">{{$list['name_bn']}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                @error('building_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                </div>
                            </div>
                           
                            <div class="form-group">                           
                                <div class="row">
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <label class="control-label" for="name_bn">@lang('Block Name (Bangla)') <span
                                                class="text-danger"> *</span></label>                                          
                                    </div>
                                    <div class="col-sm-12 col-md-5 col-lg-5">
                                        <input type="text" id="name_bn" name="name_bn"  value="{{ old('name_bn') ?? $data['editData']->name_bn ?? '' }}"
                                        class="form-control @error('name_bn') is-invalid @enderror name_bn"
                                        placeholder="@lang('Enter Name in Bangla')" autocomplete="off" maxlength="30">
                                                @error('name_bn')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                </div>
                            </div>
                            <div class="form-group">                           
                                <div class="row">
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <label class="control-label" for="name">@lang('Block Name (English)') <span
                                                class="text-danger"> *</span></label>                                          
                                    </div>
                                    <div class="col-sm-12 col-md-5 col-lg-5">
                                        <input type="text" id="name" name="name"  value="{{ old('name') ?? $data['editData']->name ?? '' }}"
                                        class="form-control @error('name') is-invalid @enderror name"
                                        placeholder="@lang('Enter Name in English')" autocomplete="off" maxlength="30">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                </div>
                            </div>
                            
                                              
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                        <a href="{{route('admin.accommodation-management.setup.hostel_floors.index') }}">@lang('Back')</a>
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                    <button type="submit" class="btn btn-success btn-sm">@if(isset($editData)) @lang('Update') @else @lang('Save') @endif</button>
                                </div>
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
                        url : "{{(@$data['editData'])?route('admin.accommodation-management.setup.hostel_floors.update',@$data['editData']->id):route('admin.accommodation-management.setup.hostel_floors.store') }}",
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
                                   location.replace("{{route('admin.accommodation-management.setup.hostel_floors.index')}}");
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
                            toastr.error('দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য সংরক্ষন করা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান ', {globalPosition: 'top right',className: 'error',autoHideDelay:10000});
                            $('[type="submit"]').removeAttr('disabled').css('cursor','pointer');
                            $('.preload').hide();
                        }
                    });
                }
            });
        });
    </script>
@endsection
