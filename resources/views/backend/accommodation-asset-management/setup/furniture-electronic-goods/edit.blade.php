@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Furniture/Electrical Goods Managment')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.accommodation-asset-management.setup.furniture_electronic_goods.index') }}">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Furniture/Electrical Goods Update')</li>
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
                {{-- <h6>@lang('Update Office Room Type')</h6> --}}
            </div>
            {{-- {{ dd($data['editData']['id']) }} --}}
            <div class="card-body">
                <form id="submitForm">
                    @if(@$data)
                        <input name="_method" type="hidden" value="PUT">
                    @endif
                    @csrf 
                {{-- <form method="POST" action="{{ route('admin.accommodation-asset-management.setup.furniture_electronic_goods.update', $data->id) }}" enctype="multipart/form-data">
                    @csrf
                    @if (isset($data['editData']))
                    @method('PUT')
                    @endif --}}
                    <div class="card-body">
                      
                              
 {{-- {{ dd($data) }} --}}
                           
                            <div class="form-group">                           
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label class="control-label" for="service_charge">@lang('Select Area')<span style="color: red;"> *</span></label>                                      
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <select id="area_id" name="area_id" class="form-control @error('area_id') is-invalid @enderror area_id">
                                            <option value="">@lang('Select Area')</option>
                                            @foreach ($area_list as $list) 
                                            @if($list['id']==$data->area_id or $list['id']==old('area_id'))
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
                                    @error('area_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                           
                            <div class="form-group">                           
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label class="control-label" for="service_charge">@lang('Select Accommodation Type')<span style="color: red;"> *</span></label>                                      
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
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
                        </div>
                    
                           <div class="form-group">                           
                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <label class="control-label" for="service_charge">@lang('Select Building/High Accommodation')<span style="color: red;"> *</span></label>                                      
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <select id="accommodation_building_id" name="accommodation_building_id" class="form-control @error('accommodation_building_id') is-invalid @enderror accommodation_building_id">
                                        <option value="">@lang('Select Building/High Accommodation')</option>

                                        @foreach ($acc_buil_list as $list) 
                                        @if($list['id']==$data->accommodation_building_id or $list['id']==old('accommodation_building_id'))
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
                                @error('accommodation_building_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                        </div>
                            </div>
                        </div>

                        <div class="form-group">                           
                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <label class="control-label" for="service_charge">@lang('Select Furniture/Electrical Goods Type')<span style="color: red;"> *</span></label>                                      
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">
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
                        </div>

                        <div class="form-group">                           
                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <label class="control-label" for="accommodation_asset_id">@lang('Select Furniture/Electrical Goods Name')<span style="color: red;"> *</span></label>                                      
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <select id="accommodation_asset_id" name="accommodation_asset_id" class="form-control @error('accommodation_asset_id') is-invalid @enderror accommodation_asset_id">
                                        <option value="">@lang('Select Furniture/Electrical Goods Name')</option>
                                       
                                        @foreach ($acc_ass as $list) 
                                        @if($list['id']==$data->accommodation_asset_id or $list['id']==old('accommodation_asset_id'))
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
                            @error('accommodation_asset_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                                        </div>
                            </div>
                        </div>

                        <div class="form-group">                           
                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <label class="control-label" for="total_no">@lang('Total No.')<span style="color: red;"> *</span></label>                                      
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <input type="text" id="total_no" name="total_no" value="{{ $data->total_no }}"
                                    class="form-control @error('total_no') is-invalid @enderror total_no"
                                    placeholder="@lang('Total No.')" autocomplete="off" maxlength="30">
                                            @error('total_no')
                                            <span class="text-danger"></span>
                                            @enderror
                                        </div>
                            </div>
                        </div>
                        </div>   

                            {{-- <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="name_bn">@lang('Name (Bangla)')<span
                                            style="color: red;"> *</span></label>
                                    <input type="text" id="name_bn" name="name_bn"  value="{{ old('name_bn') ?? $data->name_bn ?? '' }}"
                                           class="form-control @error('name_bn') is-invalid @enderror name_bn"
                                           placeholder="@lang('Enter Name in Bangla')" autocomplete="off" maxlength="30">
                                    @error('name_bn')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> --}}
                          
                                </div>
                              
                            </div> 

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                    <a href="{{ route('admin.accommodation-asset-management.setup.furniture_electronic_goods.index') }}">@lang('Back')</a>
                                <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                    <button type="submit" class="btn btn-success btn-sm">@lang('Update')</button>
                                </button>
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
                    url : "{{(@$data)?route('admin.accommodation-asset-management.setup.furniture_electronic_goods.update',@$data['id']):route('admin.accommodation-asset-management.setup.furniture_electronic_goods.store') }}",
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
                               location.replace("{{route('admin.accommodation-asset-management.setup.furniture_electronic_goods.index')}}");
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
