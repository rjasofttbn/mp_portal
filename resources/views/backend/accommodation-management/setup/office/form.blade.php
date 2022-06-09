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
                    {{-- @if ($data->id)
                    <h4 class="card-title">@lang('Update Office Room')</h4>
                    @else
                    <h4 class="card-title">@lang('Create Office Room')</h4>
                    @endif --}}
                </div>
                 <!-- Form Start-->
                <form id="areaForm" name="areaForm" method="POST"
                      {{-- @if($data->id)
                      action="{{ route('admin.accommodation-management.setup.office_rooms.update', ['id' => $data->id]) }}">
                    <input name="_method" type="hidden" value="PUT">
                    @else --}}
                        action="{{ route('admin.accommodation-management.setup.office.store') }}">
                    {{-- @endif --}}
                    @csrf
                   
                    <div class="card-body">
                        <div id="childdivtoadd" class="row">

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="building_id">@lang('Select Building Name')<span
                                            style="color: red;"> *</span></label>
                                    <select id="building_id" name="building_id" class="form-control @error('building_id') is-invalid @enderror">
                                        <option value="">@lang('Select Building Name')</option>
                                        @foreach ($BuildingList as $list)
                                                <option  value="{{$list['id']}}">
                                                    @if(session()->get('language') =='bn')
                                                        {{$list['name_bn']}}
                                                    @else
                                                        {{$list['name']}}
                                                    @endif
                                                </option>
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
                        <div id="childdivtoadd2" class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="floor_id">@lang('Select Block Number')<span
                                            style="color: #ff0000;"> *</span></label>
                                    <select id="floor_id" name="floor_id[]" class="form-control @error('floor_id') is-invalid @enderror">
                                        <option value="">@lang('Select Block Number')</option>
                                        @foreach ($FloorList as $list)
                                        
                                                <option  value="{{$list['id']}}">
                                                    @if(session()->get('language') =='bn')
                                                        {{$list['name_bn']}}
                                                    @else
                                                        {{$list['name_bn']}}
                                                    @endif
                                                </option>
                                        @endforeach
                                    </select>
                                    @error('floor_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="building_id">@lang('Select Office Room')<span
                                            style="color: red;"> *</span></label>
                                            
                                   <select id="select_office" multiple='multiple' name="select_office[]" class="form-control @error('building_id') is-invalid @enderror select2"
                                
                                   >   <option value="">@lang('Select Office Room')</option>                                          
                                    </select>
                                    @error('select_office')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="office_room_type_id">@lang('Select Office Room Type')<span
                                            style="color: #ff0000;"> *</span></label>
                                    <select id="office_room_type_id" name="office_room_type_id[]" class="form-control @error('office_room_type_id') is-invalid @enderror">
                                        <option value="">@lang('Select Office Room Type')</option>
                                        @foreach ($offType as $list)
                                                <option  value="{{$list['id']}}">
                                                    @if(session()->get('language') =='bn')
                                                        {{$list['name_bn']}}
                                                    @else
                                                        {{$list['name']}}
                                                    @endif
                                                </option>
                                        @endforeach
                                    </select>
                                    @error('office_room_type_id')
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
                                        <a href="{{route('admin.accommodation-management.setup.office.index') }}">@lang('Back')</a>
                                    </button>
                               
                                    <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                    <button type="submit" class="btn btn-success btn-sm">@lang('Save')</button>
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
        $(document).ready(function () {
            $('select[name="building_id"]').on('change', function () {
                var building_id = $(this).val();
                $('select[name="floor_id[]"]').empty();
                $('select[name="floor_id[]"]').append('<option value="">@lang('Select Block Number')</option>');
                $('#select_office').empty();

                if (building_id > 0) {
                    $.ajax({
                        url: '{{url("floorListByBuildingId")}}',
                        data:{building_id:building_id},
                        type: "GET",
                        dataType: "json",
                        beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },
                        success: function (result) {
                            $.each(result.data, function (k, val) {
                                '<?php if(session()->get('language') =='bn'){ ?>'
                                $('select[name="floor_id[]"]').append('<option value="' + val.id + '">' + val.name_bn + '</option>');
                                '<?php }else{ ?>'
                                $('select[name="floor_id[]"]').append('<option value="' + val.id + '">' + val.name_bn + '</option>');
                                '<?php } ?>'
                            });
                        },
                        complete: function () {
                            //$('#loader').css("visibility", "hidden");
                        }
                    });
                } else {
                    $('select[name="floor_id[]"]').empty();
                    $('select[name="floor_id[]"]').append('<option value="">@lang('Select Building')</option>');
                    $('#select_office').empty();
                }
            });

            $('select[name="floor_id[]"]').on('change', function () {
                var floor_id = $(this).val();
                $('#select_office').empty();
                if (floor_id > 0) {
                    $.ajax({
                        url: '{{url("officeRoomListByFloorId")}}',
                        data:{floor_id:floor_id},
                        type: "GET",
                        dataType: "json",
                        beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },
                        success: function (result) {
                            $.each(result.data, function (k, val) {

                            if (val.office_room_type_id) {
                                
                                $('#select_office').append('<option disabled value="' + val.id + '">' + val.number_bn + '</option>'); 
                        
                        } else {
                            $('#select_office').append('<option value="' + val.id + '">' + val.number_bn + '</option>');   
                            
                            }

                            });
                        },
                        complete: function () {
                            //$('#loader').css("visibility", "hidden");
                        }
                    });
                } else {
                    document.getElementById("select_office").innerHTML = "";
                }
            });
        });
    </script>

@endsection
