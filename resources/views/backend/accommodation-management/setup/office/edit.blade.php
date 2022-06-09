@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Office Room Management')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.accommodation-management.setup.office.index') }}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Office Room Management')</li>
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
                    {{-- <h5>Office Room Type Update</h5> --}}
                </div>
                <!-- Form Start-->
                <form method="POST" action="{{ route('admin.accommodation-management.setup.office.update', $data->id) }}" enctype="multipart/form-data">
                    @csrf
                    @if (isset($data))
                    @method('PUT')
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="building_id">@lang('Building')<span
                                            style="color: red;"> *</span></label>
                                    <select disabled id="building_id" name="building_id" class="form-control @error('building_id') is-invalid @enderror">
                                        <option value="">Select Building</option>
                                        <option selected value="{{ $data->building_id }}">{{ $data->building_name }}</option>
                                    </select>

                                    @error('building_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="floor_id">@lang('Floor')'<span
                                            style="color: red;"> *</span></label>
                                    <select disabled id="floor_id" name="floor_id" class="form-control @error('floor_id') is-invalid @enderror">
                                        <option value="">@lang('Select Block Number')</option>
                                        <option selected value="{{ $data->floor_id }}">
                                            
                                            {{ $data->floor_name }}</option>
                                    </select>

                                    @error('floor_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                              <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="area_id">@lang('Office Room')<span
                                            style="color: red;"> *</span></label>
                                            <select disabled id="floor_room_id" name="floor_room_id" class="form-control @error('floor_room_id') is-invalid @enderror">
                                                <option value="">@lang('Select Block Number')</option>
                                                <option selected value="{{ $data->id }}">{{ $data->office_number }}</option>
        
        
        
                                            </select>
                                    @error('floor_room_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="office_type_id">@lang('Room Type')<span
                                            style="color: #ff0000;"> *</span></label>
                                    <select id="office_type_id" name="office_type_id" class="form-control @error('office_type_id') is-invalid @enderror">
                                        <option value="">@lang('Select Office Room Type')</option>
                                        @foreach ($offType as $list)
                                            @if($list['id']==$data->office_room_type_id or $list['id']==old('office_type_id'))
                                                <option selected
                                                        value="{{$list['id']}}">{{$data->offType}}</option>
                                            @else
                                                <option  value="{{$list['id']}}">{{$list['name_bn']}}</option>
                                            @endif
                                        @endforeach

                                    </select>

                                    @error('office_type_id')
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
                                    <a href="{{route('admin.accommodation.flats.index') }}">@lang('Back')</a>
                                </button>
                                
                                <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                <button type="submit" class="btn btn-success btn-sm">@lang('Update')</button>
                           
                            </div>
                        </div>
                    </div>
                </form>
                <!--Form End-->
            </div>
        </div>
    </div>
    {{-- <script>
        $(document).ready(function () {
            $('select[name="area_id"]').on('change', function () {
                var area_id = $(this).val();
                $('select[name="building_id"]').empty();
                $('#select_flat').empty();
                $('select[name="building_id"]').append('<option value="">Select Building</option>');
                if (area_id > 0) {
                    $.ajax({
                        url: '{{url("buildingListByAreaId")}}',
                        data:{area_id:area_id},
                        type: "GET",
                        dataType: "json",
                        beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },
                        success: function (result) {
                            $.each(result.data, function (k, val) {
                                $('select[name="building_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                            });
                        },
                        complete: function () {
                            //$('#loader').css("visibility", "hidden");
                        }
                    });
                } else {
                    $('select[name="building_id"]').empty();
                    $('select[name="building_id"]').append('<option value="">Select Building</option>');
                    $('#select_flat').empty();
                }

            });

            $('select[name="building_id"]').on('change', function () {
                var building_id = $(this).val();
                $('#select_flat').empty();
                if (building_id > 0) {
                    $.ajax({
                        url: '{{url("flatListByBuildingId")}}',
                        data:{building_id:building_id},
                        type: "GET",
                        dataType: "json",
                        beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },
                        success: function (result) {
                            $.each(result.data, function (k, val) {
                                $('#select_flat').append('<option value="' + val.id + '">' + val.number + '</option>');
                            });
                        },
                        complete: function () {
                            //$('#loader').css("visibility", "hidden");
                        }
                    });
                } else {
                    document.getElementById("select_flat").innerHTML = "";
                }
            });
        });
    </script> --}}

@endsection
