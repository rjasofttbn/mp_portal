@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Furniture/Electrical Goods Managment')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.accommodation-asset-management.setup.accommodation_assets.index') }}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Furniture/Electrical Goods Managment')</li>
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
                        <h5>@lang('Update Accommodation Asset')</h5>
                    @else
                        <h6>@lang('Furniture/Electrical Goods Name Add')</h6>
                    @endif
                </div>
                <form id="submitForm">
                    @if(@$data->name)
                        <input name="_method" type="hidden" value="PUT">
                    @endif
                    @csrf
                <!-- Form Start-->
                {{-- <form id="equipmentForm" name="equipmentForm" method="POST"
                      @if($data->id)
                      action="{{ route('admin.accommodation-asset-management.setup.accommodation_assets.update', $data->id) }}">
                    <input name="_method" type="hidden" value="PUT">
                    @else
                        action="{{ route('admin.accommodation-asset-management.setup.accommodation_assets.store') }}">
                    @endif
                    @csrf --}}

                    <input type="hidden" id="id" name="id" value="{{$data->id}}">

                    <div class="card-body">
                        <div class="row">
                           
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="name_bn">@lang('Enter Furniture/Electrical Name in Bangla')<span
                                            style="color: red;"> *</span></label>
                                    <input type="text" id="name_bn" name="name_bn" value="{{old('name_bn', $data->name_bn)}}"
                                           class="form-control @error('name_bn') is-invalid @enderror name_bn"
                                           placeholder="@lang('Enter Furniture/Electrical Name in Bangla')" autocomplete="off" maxlength="30">

                                    @error('name_bn')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="name">@lang('Enter Furniture/Electrical Name in English')<span
                                            style="color: red;"> *</span></label>
                                    <input type="text" id="name" name="name" value="{{old('name', $data->name)}}"
                                           class="form-control @error('name') is-invalid @enderror name"
                                           placeholder="@lang('Enter Furniture/Electrical Name in English')" autocomplete="off" maxlength="30">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="accommodation_type_id">@lang('Select Accommodation Type')<span
                                        style="color: red;"> *</span></label>
                                      
                                    <select id="accommodation_type_id" name="accommodation_type_id" class="form-control @error('accommodation_type_id') is-invalid @enderror accommodation_type_id">
                                        <option value="">@lang('Select Accommodation Type')</option>
                                        @foreach ($acc_type_list as $list)
                                            @if($list['id']==$data->accommodation_type_id or $list['id']==old('accommodation_type_id'))
                                                <option selected
                                                        value="{{$list['id']}}">
                                                        @if(session()->get('language') =='bn')
                                                            {{$list['name_bn']}}
                                                        @else
                                                            {{$list['name']}}
                                                        @endif
                                                </option>
                                            @else
                                                <option  value="{{$list['id']}}">
                                                    @if(session()->get('language') =='bn')
                                                        {{$list['name_bn']}}
                                                    @else
                                                        {{$list['name']}}
                                                    @endif
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                @error('accommodation_type_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="accommodation_asset_type_id">@lang('Select Furniture/Electrical Goods Type')<span
                                        style="color: red;"> *</span></label>
                                        <select id="accommodation_asset_type_id" name="accommodation_asset_type_id" class="form-control @error('accommodation_asset_type_id') is-invalid @enderror accommodation_asset_type_id">
                                            <option value="">@lang('Select Furniture/Electrical Goods Type')</option>
                                            @foreach ($acc_ass_type_list as $list)
                                                @if($list['id']==$data->accommodation_asset_type_id or $list['id']==old('accommodation_asset_type_id'))
                                                    <option selected
                                                            value="{{$list['id']}}">
                                                            @if(session()->get('language') =='bn')
                                                                {{$list['name_bn']}}
                                                            @else
                                                                {{$list['name']}}
                                                            @endif
                                                    </option>
                                                @else
                                                    <option  value="{{$list['id']}}">
                                                        @if(session()->get('language') =='bn')
                                                            {{$list['name_bn']}}
                                                        @else
                                                            {{$list['name']}}
                                                        @endif
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                @error('accommodation_asset_type_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                </div>
                            </div>
                        @if($data->id)
                            <div class="form-group col-sm-4 mt-auto">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="status" {{ $data->status == 1 ? 'checked' : '' }} value="1" class="custom-control-input status" id="active-status">
                                    <label class="custom-control-label" for="active-status">@lang('Make it active ?')</label>
                                </div>
                            </div>
                        @endif

                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                        <a href="{{route('admin.accommodation-asset-management.setup.accommodation_assets.index') }}">@lang('Back')</a>
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
                        url : "{{(@$data->id)?route('admin.accommodation-asset-management.setup.accommodation_assets.update', $data->id):route('admin.accommodation-asset-management.setup.accommodation_assets.store') }}",
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
                                   location.replace("{{route('admin.accommodation-asset-management.setup.accommodation_assets.index')}}");
                               }, 2000);
                            }else if(data.status == 'error'){
                                toastr.error("",data.message);
                                $('[type="submit"]').removeAttr('disabled').css('cursor','pointer');
                                $('.preload').hide();
                            }else{
                                toastr.error('দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য সংরক্ষন করা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানানghj ', {globalPosition: 'top right',className: 'error',autoHideDelay:10000});
                                $('[type="submit"]').removeAttr('disabled').css('cursor','pointer');
                                $('.preload').hide();
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            toastr.error('দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য সংরক্ষন করা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান666666 ', {globalPosition: 'top right',className: 'error',autoHideDelay:10000});
                            $('[type="submit"]').removeAttr('disabled').css('cursor','pointer');
                            $('.preload').hide();
                        }
                    });
                }
            });
        });
    </script>
@endsection
