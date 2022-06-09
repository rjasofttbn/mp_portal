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
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.accommodation-asset-management.setup.furniture_electronic_goods.index') }}">@lang('Home')</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('Furniture/Electrical Goods Add')</li>
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
                {{-- <div class="card-body"> --}}
                    {{-- <form id="submitForm">
                        @if (@$editData)
                            <input name="_method" type="hidden" value="PUT">
                        @endif
                        @csrf --}}
                    <form id="areaForm" name="areaForm" method="POST"
                        action="{{ route('admin.accommodation-asset-management.setup.furniture_electronic_goods.store') }}">

                        @csrf
                        <div class="card-body">
                            <div id="divtoadd">
                                {{-- <div id="childdivtoadd" class="row"> --}}
                                <div id="childdivtoadd" >
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        {{-- <div class="row"> --}}
                                            <div class=" col-md-12 col-lg-12">
                                                <select id="area_id" name="area_id"
                                                    class="form-control @error('area_id') is-invalid @enderror area_id">
                                                    <option value="">@lang('Select Area')</option>
                                                    @foreach ($area_list as $list)
                                                        <option value="{{ $list['id'] }}">
                                                            @if (session()->get('language') == 'bn')
                                                                {{ $list['name_bn'] }}
                                                            @else
                                                                {{ $list['name'] }}
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('area_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div><br>
                                            <div class="col-md-12 col-lg-12">
                                                <select id="accommodation_type_id"   onchange="showMe(this)"  name="accommodation_type_id"
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
                                                <select id="accommodation_building_id" name="accommodation_building_id"
                                                    class="form-control @error('accommodation_building_id') is-invalid @enderror accommodation_building_id">
                                                    <option value="">@lang('Select Building/High Accommodation')</option>
                                                    @foreach ($acc_buil_list as $list)

                                                        <option value="{{ $list['id'] }}">
                                                            @if (session()->get('language') == 'bn')
                                                                {{ $list['name_bn'] }}
                                                            @else
                                                                {{ $list['name'] }}
                                                            @endif
                                                        </option>

                                                    @endforeach
                                                </select>
                                                @error('accommodation_building_id')
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
                                    {{-- <i id="add" name="add" class="fas fa-plus-circle fa-2x"></i> --}}
                                    
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                        <a
                                            href="{{ route('admin.accommodation-asset-management.setup.furniture_electronic_goods.index') }}">@lang('Back')</a>
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                    <button type="submit" class="btn btn-success btn-sm">@lang('Submit')</button>

                                </div>
                            </div>
                        </div>
                    </form>
                {{-- </div> --}}
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
                        url: "{{ @$editData ? route('admin.accommodation-management.setup.office_room_types.update', @$editData->id) : route('admin.accommodation-asset-management.setup.furniture_electronic_goods.store') }}",
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
                                        "{{ route('admin.accommodation-asset-management.setup.furniture_electronic_goods.index') }}"
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
                            $(btnThis).parents('.add_more_div').find('.accommodation_asset_id').append('<option value="' + val.id + '">' + val.name_bn + '</option>');
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
