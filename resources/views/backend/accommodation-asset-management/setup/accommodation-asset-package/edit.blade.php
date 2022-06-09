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
                    <li class="breadcrumb-item"><a href="{{ route('admin.accommodation-asset-management.setup.accommodation-asset-package.index') }}">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Furniture/Electrical Goods Package Update')</li>
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
                <h5>@lang('Furniture/Electrical Goods Package Update')</h5>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.accommodation-asset-management.setup.accommodation-asset-package.update', $editData->id) }}" enctype="multipart/form-data">
                    @csrf
                    @if (isset($editData))
                    @method('PUT')
                    @endif
                    <div class="row">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                   
                                    <select id="accommodation_type_id" name="accommodation_type_id" class="form-control @error('accommodation_type_id') is-invalid @enderror">
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
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
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
                                </div>
                                </div>
                                </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                         
                            <div class="col-sm-12 col-md-10 col-lg-10">
                                <div id="divAdd">
                                
                                        @php  $i = 0; 
                                        $rr = $accommodation_asset_type_id ;
                                        @endphp

                                        @foreach ($rr as $key => $asspack)

                                            {{-- <div id="childDiv" class="row mb-2"> --}}
                                            <div class="childDiv row mb-2">
                                                <div class="col-sm-12 col-md-3 col-lg-3">                                                        
                                                    <select id="accommodation_asset_type_id" name="accommodation_asset_type_id[]"
                                                    class="@error('accommodation_asset_type_id') is-invalid @enderror form-control form-control-sm select2">
                                                    
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

                                                <div class="col-sm-12 col-md-3 col-lg-3">                                                        
                                                    <select id="accommodation_asset_id" name="accommodation_asset_id[]"
                                                    class="@error('accommodation_asset_id') is-invalid @enderror form-control form-control-sm select2">
                                                   
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
                                                {{-- <button type="button" id="addMore" class="btn btn-outline-info btn-sm" name="add"> <i class="fa fa-plus"> </i> </button>
                                                <i id="minus" name="minus" class="fas fa-minus-circle text-red fa-2x"></i> --}}
                                                <button type="button" class="btn {{ $i==0 ? 'btn-info addRow' : 'btn-danger removeRow' }}"> 
                                                    <i class="fa fa-{{ $i==0 ? 'plus' : 'times' }}"> </i> 
                                                </button>
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
                

                    <div class="row">
                        <div class="col-sm-12 col-md-5 col-lg-5">
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                    <a href="{{ route('admin.accommodation-asset-management.setup.accommodation-asset-package.index') }}">@lang('Back')</a>
                                </button>
                                <button type="submit" class="btn btn-success btn-sm">@lang('Update')</button>
                            </div>
                        </div>
                        
                    </div>
                </div>
                </form>
            
        </div>
    </div>
</div>


@endsection

@section('script')
<script>


    $(function() {
     
        $('.addRow').click(function(){
            var loadMp = '<div class="childDiv row mb-2"> <div class="col-sm-12 col-md-3 col-lg-3"> <select name="accommodation_asset_type_id[]" class="@error("accommodation_asset_type_id") is-invalid @enderror form-control form-control-sm select2"> <option value="">@lang("Select Furniture/Electrical Goods Type")</option> @if (isset($acc_ass_type_list) && count($acc_ass_type_list) > 0) @foreach ($acc_ass_type_list as $data) @if($data->id==old("accommodation_asset_type_id")) <option selected value="{{$data->id}}"> @if(session()->get("language")=="bn"){{$data->name_bn}}@else{{$data->name}}@endif </option> @else <option value="{{$data->id}}"> @if(session()->get("language")=="bn"){{$data->name_bn}}@else{{$data->name}}@endif </option> @endif @endforeach @endif </select> @error("accommodation_asset_type_id") <span class="text-danger">{{$message}}</span> @enderror </div><div class="col-sm-12 col-md-3 col-lg-3"> <select name="accommodation_asset_id[]" class="@error("accommodation_asset_id") is-invalid @enderror form-control form-control-sm select2"> <option value="">@lang("Select Furniture/Electrical Goods Type")</option> @if (isset($acc_ass_list) && count($acc_ass_list) > 0) @foreach ($acc_ass_list as $data) @if($data->id==old("accommodation_asset_id")) <option selected value="{{$data->id}}"> @if(session()->get("language")=="bn"){{$data->name_bn}}@else{{$data->name}}@endif </option> @else <option value="{{$data->id}}"> @if(session()->get("language")=="bn"){{$data->name_bn}}@else{{$data->name}}@endif </option> @endif @endforeach @endif </select> @error("accommodation_asset_id") <span class="text-danger">{{$message}}</span> @enderror </div><div class="col-sm-12 col-md-3 col-lg-3"> <input id="total_no" type="text" name="total_no[]" placeholder="@lang("Total No.")" class="form-control form-control-sm"> </div><button type="button" class="btn btn-danger removeRow"> <i class="fa fa-times"> </i> </button></div>';

            $('#divAdd').append(loadMp);
            $('.select2').select2();
        });
    })
    $(document).ready(function () {
    //Delete Row
    $(document).on("click", ".removeRow", function() {
        $(this).closest('.childDiv').remove();
    });
});

function showMe(selectedOption) {

if(selectedOption.value=="2"    ) {
    document.getElementById('idShowMe').style.display = 'none';
} else {
    document.getElementById('idShowMe').style.display = 'block';
}
}

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
</script>
@endsection