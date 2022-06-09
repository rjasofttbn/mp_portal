@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Furniture/Electrical Goods Package Managment')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Furniture/Electrical Goods Package Managment')</li>
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
                    @if (isset($editData))
                    <h5>@lang('Furniture/Electrical Goods Package Update')</h5>
                    @else
                    <h5>@lang('Furniture/Electrical Goods Package Add')</h5>
                    @endif
                </div>
                <!-- Form Start-->
                <form method="POST" action="{{ isset($editData) ? route('admin.accommodation-asset-management.setup.accommodation-asset-package.update', $editData->id) : route('admin.accommodation-asset-management.setup.accommodation-asset-package.store') }}">
                    @csrf
                    @if (isset($editData))
                        @method('PUT')
                    @endif

                
@if (isset($editData))
<div class="row" >
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="card-body">
               <div id="divtoadd">
                <div id="childdivtoadd" >
                    <div class="col-sm-12 col-md-4 col-lg-4">
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                            <div class="col-md-12 col-lg-12">
                                <select id="accommodation_type_id"  onchange="showMe(this)" name="accommodation_type_id" class="form-control @error('accommodation_type_id') is-invalid @enderror">
                                    <option value="">@lang('Select Accommodation Type')</option>
                                    @foreach ($acc_type_list as $list)
                                        @if($list['id']==$editData->accommodation_type_id or $list['id']==old('accommodation_type_id'))
                                            <option selected
                                                    value="{{$list['id']}}"> {{ $list['name_bn'] }}</option>
                                        @else
                                            <option  value="{{$list['id']}}"> {{ $list['name'] }}</option>
                                        @endif
                                    @endforeach

                                </select>
                                @error('accommodation_type_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><br>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <select id="flat_type_id" name="flat_type_id" class="form-control @error('flat_type_id') is-invalid @enderror">
                                    <option value="">@lang('Select Accommodation Size')</option>
                                    @foreach ($flat_type_list as $list)
                                        @if($list['id']==$editData->flat_type_id or $list['id']==old('flat_type_id'))
                                            <option selected
                                                    value="{{$list['id']}}"> {{ $list['name_bn'] }}</option>
                                        @else
                                            <option  value="{{$list['id']}}"> {{ $list['name'] }}</option>
                                        @endif
                                    @endforeach

                                </select>
                                @error('flat_type_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><br>
{{-- 
                        </div> --}}
                    
                </div>


                {{-- New div start--}}
                <div id="childdivtoadd2" class="row">
                    <div class="form-group add_more_div">
                        <div class="row">

                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <select id="accommodation_asset_type_id"
                                    name="accommodation_asset_type_id[]"
                                    class="form-control @error('accommodation_asset_type_id') is-invalid @enderror accommodation_asset_type_id">
                                    <option value="">@lang('Select Furniture/Electrical Goods Type')
                                    </option>
                                    @foreach ($acc_ass_type_list as $list)

                                        <option value="{{ $list['id'] }}">
                                            @if (session()->get('language') == 'bn')
                                                {{ $list['name_bn'] }}
                                            @else
                                                {{ $list['name'] }}
                                            @endif
                                        </option>

                                    @endforeach
                                </select>
                                @error('accommodation_asset_type_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <select id="accommodation_asset_id" name="accommodation_asset_id[]"
                                    class="form-control @error('accommodation_asset_id') is-invalid @enderror accommodation_asset_id">
                                    <option value="">@lang('Select Furniture/Electrical Goods Name')
                                    </option>
                                    @foreach ($acc_ass as $list)
                                        <option value="{{ $list['id'] }}">
                                            @if (session()->get('language') == 'bn')
                                                {{ $list['name_bn'] }}
                                            @else
                                                {{ $list['name'] }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('accommodation_asset_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <input type="text" id="total_no" name="total_no[]" value=""
                                    class="form-control @error('total_no') is-invalid @enderror total_no"
                                    placeholder="@lang('Total No.')" autocomplete="off">
                                @error('total_no')
                                    <span class="text-danger"></span>
                                @enderror
                            </div>
                    <i id="add" name="add" class="fas fa-plus-circle text-green fa-2x"></i>
                        </div>
                    </div>
                    
                </div>
                </div>
                {{-- New div end--}}
                <div class="col-sm-12 col-md-4 col-lg-4">
                </div>
                </div>
                    @php  $i = 0; 
                    $rr = $accommodation_asset_type_id ;
                    @endphp

                    @foreach ($rr as $key => $asspack)

                        {{-- <div id="childDiv" class="row mb-2"> --}}
                        {{-- <div class="childDiv row mb-2"> --}}
                            <div id="childdivtoadd2" class="row">
                                <div class="form-group add_more_div">
                                    <div class="row" >
                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                            <select id="accommodation_asset_type_id"
                                                name="accommodation_asset_type_id[]"
                                                class="form-control @error('accommodation_asset_type_id') is-invalid @enderror accommodation_asset_type_id">
                                                @foreach ($acc_ass_type_list as $data)
                                                    <option {{ $asspack==$data->id ? 'selected' : '' }} value="{{ $data->id }}">
                                                        @if(session()->get('language') =='bn')
                                                        {{ $data->name_bn }}
                                                        @else
                                                        {{ $data->name}}
                                                        @endif
                                                    </option>
                                                @endforeach
                                                </select>
                                @error('accommodation_asset_type_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <select id="accommodation_asset_id" name="accommodation_asset_id[]"
                                    class="form-control @error('accommodation_asset_id') is-invalid @enderror accommodation_asset_id">
                                    <option value="">@lang('Select Furniture/Electrical Goods Name')
                                    </option>
                                @foreach ($acc_ass as $data)
                                    <option {{ $accommodation_asset_id[$key]==$data->id ? 'selected' : '' }} value="{{ $data->id }}">
                                        @if(session()->get('language') =='bn')
                                       {{ $data->name_bn }}
                                        @else
                                        {{ $data->name}}
                                        @endif
                                    </option>
                                @endforeach
                                </select>
                                @error('accommodation_asset_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <input type="text" id="total_no" name="total_no[]" value="{{ $total_no[$i] }}"
                                class="form-control @error('total_no') is-invalid @enderror total_no"
                                placeholder="@lang('Total No.')" autocomplete="off">
                            @error('total_no')
                                <span class="text-danger"></span>
                            @enderror
                            </div>
                           
                            {{-- <i id="add" name="add" class="fas fa-plus-circle text-green fa-2x"></i>&nbsp;&nbsp; --}}
                            <i id="minus" name="minus" class="fas fa-minus-circle text-red fa-2x"></i>
                        </div>
                        </div>
                        </div>

                        @php  $i++ ;  @endphp

                    @endforeach
                </div>   
               
            </div>
        </div>
        <div class="row">
            {{-- <div class="col-sm-12 col-md-2 col-lg-2"> </div> --}}
            {{-- <div class="col-sm-12 col-md-2 col-lg-2">
                <input type="button" id="addMore" class='btn btn-outline-info btn-sm' name="add" value="+ @lang('Add More')"/>
            </div> --}}
        </div>
    </div>
</div>
@else
       <div class="card-body">
                        
                            <div id="divtoadd">
                                <div id="childdivtoadd" >
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                            <div class="col-md-12 col-lg-12">
                                                <select id="accommodation_type_id"  onchange="showMe(this)" name="accommodation_type_id"
                                                    class="form-control @error('accommodation_type_id') is-invalid @enderror accommodation_type_id">
                                                    <option value="">@lang('Select Accommodation Type')</option>
                                                    @foreach ($acc_type_list as $list)
                                                        <option value="{{ $list['id'] }}">
                                                            @if (session()->get('language') == 'bn')
                                                                {{ $list['name_bn'] }}
                                                            @else
                                                                {{ $list['name'] }}
                                                            @endif
                                                        </option>

                                                    @endforeach
                                                </select>
                                                @error('accommodation_type_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div><br>

                                            <div class="col-sm-12 col-md-12 col-lg-12" id="idShowMe" style="display: none">
                                                <select id="flat_type_id" name="flat_type_id"
                                                    class="form-control @error('flat_type_id') is-invalid @enderror flat_type_id">
                                                    <option value="">@lang('Select Accommodation Size')</option>
                                                    @foreach ($flat_type_list as $list)

                                                        <option value="{{ $list['id'] }}">
                                                            @if (session()->get('language') == 'bn')
                                                                {{ $list['name_bn'] }}
                                                            @else
                                                                {{ $list['name'] }}
                                                            @endif
                                                        </option>

                                                    @endforeach
                                                </select>
                                                @error('flat_type_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div><br>
{{-- 
                                        </div> --}}
                                    
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                </div>
                                </div>

                                <div id="childdivtoadd2" class="row">
                                    <div class="form-group add_more_div">
                                        <div class="row" >

                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <select id="accommodation_asset_type_id"
                                                    name="accommodation_asset_type_id[]"
                                                    class="form-control @error('accommodation_asset_type_id') is-invalid @enderror accommodation_asset_type_id">
                                                    <option value="">@lang('Select Furniture/Electrical Goods Type')
                                                    </option>
                                                    @foreach ($acc_ass_type_list as $list)

                                                        <option value="{{ $list['id'] }}">
                                                            @if (session()->get('language') == 'bn')
                                                                {{ $list['name_bn'] }}
                                                            @else
                                                                {{ $list['name'] }}
                                                            @endif
                                                        </option>

                                                    @endforeach
                                                </select>
                                                @error('accommodation_asset_type_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <select id="accommodation_asset_id" name="accommodation_asset_id[]"
                                                    class="form-control @error('accommodation_asset_id') is-invalid @enderror accommodation_asset_id">
                                                    <option value="">@lang('Select Furniture/Electrical Goods Name')
                                                    </option>
                                                    @foreach ($acc_ass as $list)
                                                        <option value="{{ $list['id'] }}">
                                                            @if (session()->get('language') == 'bn')
                                                                {{ $list['name_bn'] }}
                                                            @else
                                                                {{ $list['name'] }}
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('accommodation_asset_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12 col-md-3 col-lg-3">
                                                <input type="text" id="total_no" name="total_no[]" value=""
                                                    class="form-control @error('total_no') is-invalid @enderror total_no"
                                                    placeholder="@lang('Total No.')" autocomplete="off">
                                                @error('total_no')
                                                    <span class="text-danger"></span>
                                                @enderror
                                            </div>
                                    <button type="button" id="add" class="btn btn-outline-info btn-sm" name="add"> <i class="fa fa-plus"> </i> </button>

                                        </div>
                                    </div>

                        </div>
                        </div> 
                  @endif
        @if (isset($editData))
                  @endif
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                        <a href="{{route('admin.accommodation-asset-management.setup.accommodation-asset-package.index') }}">@lang('Back')</a>
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                    <button type="submit" class="btn btn-success btn-sm">@if(isset($editData)) @lang('Update') @else @lang('Save') @endif</button>
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
        $(document).ready(function() {
            $('#submitForm').validate({
                ignore: [],
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                errorClass: 'text-danger',
                validClass: 'text-success',

                submitHandler: function(form) {
                    event.preventDefault();
                    $('[type="submit"]').attr('disabled', 'disabled').css('cursor', 'not-allowed');
                    var formInfo = new FormData($("#submitForm")[0]);
                    $.ajax({
                        url: "{{ @$editData ? route('admin.accommodation-asset-management.setup.accommodation-asset-package.update', @$editData->id) : route('admin.accommodation-asset-management.setup.accommodation-asset-package.store') }}",
                        data: formInfo,
                        type: "POST",
                        processData: false,
                        contentType: false,
                        beforeSend: function() {
                            $('.preload').show();
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                toastr.success("", data.message);
                                $('.preload').hide();
                                setTimeout(function() {
                                    location.replace(
                                        "{{ route('admin.accommodation-asset-management.setup.accommodation-asset-package.index') }}"
                                    );
                                }, 2000);
                            } else if (data.status == 'error') {
                                toastr.error("", data.message);
                                $('[type="submit"]').removeAttr('disabled').css('cursor',
                                    'pointer');
                                $('.preload').hide();
                            } else {
                                toastr.error(
                                    'দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য সংরক্ষন করা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান ', {
                                        globalPosition: 'top right',
                                        className: 'error',
                                        autoHideDelay: 10000
                                    });
                                $('[type="submit"]').removeAttr('disabled').css('cursor',
                                    'pointer');
                                $('.preload').hide();
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            toastr.error(
                                'দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য সংরক্ষন করা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান ', {
                                    globalPosition: 'top right',
                                    className: 'error',
                                    autoHideDelay: 10000
                                });
                            $('[type="submit"]').removeAttr('disabled').css('cursor',
                                'pointer');
                            $('.preload').hide();
                        }
                    });
                }
            });
/*============*/
        $(document).ready(function () {

        $(document).on('change','.accommodation_asset_type_id',function () {
            var btnThis = $(this);
            var accommodation_asset_type_id = $(this).val();

            $(btnThis).parents('.add_more_div').find('.accommodation_asset_id').empty();
            $(btnThis).parents('.add_more_div').find('.accommodation_asset_id').append('<option value="">@lang('Select Furniture/Electrical Goods Name')</option>');

            if (accommodation_asset_type_id > 0) {
                $.ajax({
                    url: '{{url("assListByAccAssTypeId")}}',
                    data:{accommodation_asset_type_id:accommodation_asset_type_id},
                    type: "GET",
                    dataType: "json",
                    beforeSend: function () {
                        //$('#loader').css("visibility", "visible");
                    },
                    success: function (result) {
                        $.each(result.data, function (k, val) {
                            '<?php if(session()->get('language') =='bn'){ ?>'
                            $(btnThis).parents('.add_more_div').find('.accommodation_asset_id').append('<option value="' + val.id + '">' + val.name_bn + '</option>');
                            '<?php }else{ ?>'
                            $(btnThis).parents('.add_more_div').find('.accommodation_asset_id').append('<option value="' + val.id + '">' + val.name + '</option>');
                            '<?php } ?>'
                        });
                    },
                    complete: function () {
                        //$('#loader').css("visibility", "hidden");
                    }
                });
            } else {
                $(btnThis).parents('.add_more_div').find('.accommodation_asset_id').empty();
                $(btnThis).parents('.add_more_div').find('.accommodation_asset_id').append('<option value="">@lang('Select Furniture/Electrical Goods Name')</option>');
            }
        });

        });

/* =====*/
            $(document).on('click', '#minus', function(e) {
                $(this).parent('div').remove();
            });
            
            $(document).on('click', '#add', function(e) {
                var clone = $('#childdivtoadd2').clone();
                clone.find("input").val("");
                clone.appendTo('#divtoadd:last');
                clone.append(
                    // '<i id="minus" name="minus" class="fas fa-minus-circle fa-2x"></i>'

                    '<i id="minus" name="minus" class="fas fa-minus-circle text-red fa-2x"></i>'
                    
                    );
            });
        });

        function showMe(selectedOption) {

            if(selectedOption.value=="2") {
                document.getElementById('idShowMe').style.display = 'none';
            } else {
                document.getElementById('idShowMe').style.display = 'block';
            }
        }

    </script>
   
@endsection
