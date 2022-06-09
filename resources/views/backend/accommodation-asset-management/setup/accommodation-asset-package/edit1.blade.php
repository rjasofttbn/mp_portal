@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Assessment Committee')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Assessment Committee')</li>
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

                <h5>@lang('Update Committee')</h5>

            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.accommodation-asset-management.setup.accommodation-asset-package.update', $editData->id) }}" enctype="multipart/form-data">
                    @csrf
                    @if (isset($editData))
                    @method('PUT')
                    @endif

                   
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-10 col-lg-10">
                                <div id="divAdd">
                                   <div id="childDiv" class="row mb-2">
                                   
                                    <div class="col-sm-12 col-md-8 col-lg-8"> 
                                    @php  $i = 0;  @endphp
                                   {{-- {{ dd($editData['accommodation_asset_type_id']) }} --}}
                                     @foreach ($accommodation_asset_type_id as $committee)

                                        
                                            <div class="col-sm-12 col-md-4 col-lg-4">                                                        
                                                <select id="accommodation_asset_type_id" name="accommodation_asset_type_id[]"
                                                class="@error('accommodation_asset_type_id') is-invalid @enderror form-control form-control-sm select2">
                                                
                                                @foreach ($acc_ass_type_list as $data)
                                                    <option {{ $committee==$data->id ? 'selected' : '' }} value="{{ $data->id }}">
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
                                            @php  $i++ ;  @endphp
                                            @endforeach
                                        </div>

                                        <div class="col-sm-12 col-md-8 col-lg-8"> 
                                            @php  $l = 0;  @endphp
                                            @foreach ($accommodation_asset_id as $committee)
                                            <div class="col-sm-12 col-md-4 col-lg-4">                                                        
                                                <select id="assessment_committee" name="accommodation_asset_id[]"
                                                class="@error('accommodation_asset_id') is-invalid @enderror form-control form-control-sm select2">
                                                @foreach ($acc_ass_list as $data)
                                                    <option {{ $committee==$data->id ? 'selected' : '' }} value="{{ $data->id }}">
                                                        @if(session()->get('language') =='bn')
                                                        {{ $data->name_bn }}
                                                        @else
                                                        {{ $data->name }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                                </select>
                                                @error('accommodation_asset_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                       
                                        @php  $l++ ;  @endphp
                                    @endforeach
                                </div>


                                <div class="col-sm-12 col-md-8 col-lg-8"> 
                                            @php  $l = 0;  @endphp
                                            @foreach ($accommodation_asset_id as $committee)
                                                <div class="col-sm-12 col-md-3 col-lg-3">
                                                    <input type="text" id="total_no" name="total_no[]" value="{{ $total_no[$l] }}"
                                                        class="form-control @error('total_no') is-invalid @enderror total_no"
                                                        placeholder="@lang('Total No.')" autocomplete="off">
                                                    @error('total_no')
                                                        <span class="text-danger"></span>
                                                    @enderror
                                                </div>


                                            
                                            @php  $l++ ;  @endphp
                                        @endforeach
                                    </div>   
                                    </div>   
                                    </div>   
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2"> </div>
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <input type="button" id="addMore" class='btn btn-outline-info btn-sm' name="add" value="+ @lang('Add More')"/>
                                </div>
                           
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-success btn-sm">@lang('Submit')</button>
                                <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                    <a href="{{ route('admin.accommodation-asset-management.setup.accommodation-asset-package.index') }}">@lang('Back')</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script>
    $(function() {
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $('#reservationdate2').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $('#addMore').click(function(){
            var loadMp = '<div id="childDiv" class="row mb-2"> <div class="col-sm-12 col-md-4 col-lg-4"> <select name="accommodation_asset_type_id[]" class="@error("accommodation_asset_type_id") is-invalid @enderror form-control form-control-sm select2"> <option value="">@lang("Select Furniture/Electrical Goods Type")</option> @if (isset($acc_ass_type_list) && count($acc_ass_type_list) > 0) @foreach ($acc_ass_type_list as $data) @if($data->id==old("accommodation_asset_type_id")) <option selected value="{{$data->id}}"> @if(session()->get("language")=="bn"){{$data->name_bn}}@else{{$data->name}}@endif </option> @else <option value="{{$data->id}}"> @if(session()->get("language")=="bn"){{$data->name_bn}}@else{{$data->name}}@endif </option> @endif @endforeach @endif </select> @error("accommodation_asset_type_id") <span class="text-danger">{{$message}}</span> @enderror </div><div class="col-sm-12 col-md-4 col-lg-4"> <select name="accommodation_asset_id[]" class="@error("accommodation_asset_id") is-invalid @enderror form-control form-control-sm select2"> <option value="">@lang("Select Furniture/Electrical Goods Type")</option> @if (isset($acc_ass_list) && count($acc_ass_list) > 0) @foreach ($acc_ass_list as $data) @if($data->id==old("accommodation_asset_id")) <option selected value="{{$data->id}}"> @if(session()->get("language")=="bn"){{$data->name_bn}}@else{{$data->name}}@endif </option> @else <option value="{{$data->id}}"> @if(session()->get("language")=="bn"){{$data->name_bn}}@else{{$data->name}}@endif </option> @endif @endforeach @endif </select> @error("accommodation_asset_id") <span class="text-danger">{{$message}}</span> @enderror </div><div class="col-sm-12 col-md-3 col-lg-3"> <input id="total_no" type="text" name="total_no[]" placeholder="@lang("Total No.")" class="form-control form-control-sm"> </div></div>';

            $('#divAdd').append(loadMp);
            $('.select2').select2();
        });
    })
</script>
@endsection