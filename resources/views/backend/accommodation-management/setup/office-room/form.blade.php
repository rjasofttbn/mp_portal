@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Block Or Office Room SetUp')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.accommodation-management.setup.office_rooms.index') }}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Block Or Office Room SetUp')</li>
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
                      @if($data->id)
                      action="{{ route('admin.accommodation-management.setup.office_rooms.update', ['id' => $data->id]) }}">
                    <input name="_method" type="hidden" value="PUT">
                    @else
                        action="{{ route('admin.accommodation-management.setup.office_rooms.store') }}">
                    @endif
                    @csrf

                    <input type="hidden" id="id" name="id" value="{{$data->id}}">
                    <div class="card-body">
                        <div id="divtoadd">
                        <div id="childdivtoadd" class="row">

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="building_id">@lang('Select Building Name')<span
                                            style="color: red;"> *</span></label>
                                    <select id="building_id" name="building_id" class="form-control @error('building_id') is-invalid @enderror">
                                        <option value="">@lang('Select Building Name')</option>
                                        @foreach ($BuildingList as $list)
                                            @if($list['id']==$data->building_id or $list['id']==old('building_id'))
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
                                        {{-- @foreach ($FloorList as $list)
                                            @if($list['id']==$data->floor_id or $list['id']==old('floor_id'))
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
                                        @endforeach --}}
                                    </select>

                                    @error('floor_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label" for="name">@lang('Total Office Room')<span
                                            style="color: red;"> *</span></label>
                                    <input type="number" id="total_office_room" name="total_office_room[]" value="{{old('name', $data->name)}}"
                                           class="form-control @error('name') is-invalid @enderror"
                                           autocomplete="off" maxlength="30">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label" for="name">@lang('Office Start Number')<span
                                            style="color: red;"> *</span></label>
                                    <input type="number" id="startno" name="startno[]" value="{{old('name', $data->name)}}"
                                           class="form-control @error('name') is-invalid @enderror"
                                           autocomplete="off" maxlength="30">

                                    @error('name')
                                   <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                </div>
                              
                            </div>
                            <i id="add" name="add" class="fas fa-plus-circle fa-2x"></i>
                        </div>
                    </div>
                            <input type="hidden" name="status" id="status" value="1">
                            @if($data->id)
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label" for="status">Status <span style="color: red;"> *</span></label>

                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" value="1" id="status_1"
                                                   name="status" @if($data->status==1) {{"checked"}} @endif checked>
                                            <label for="status_1" class="custom-control-label">Active</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" value="0" id="status_0"
                                                   name="status" @if($data->status==0) {{"checked"}} @endif>
                                            <label for="status_0" class="custom-control-label">Inactive</label>
                                        </div>
                                        <div>
                                            @error('status')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror

                                        </div>

                                    </div>
                                </div>
                            @endif
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                        <a href="{{route('admin.accommodation-management.setup.office_rooms.index') }}">@lang('Back')</a>
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
        $(document).ready(function () {

            // Author M. Atoar Rahman: Ceated date: 24-01-2021
            // Get District List By Division Id:

            $('select[name="building_id"]').on('change', function () {
                var building_id = $(this).val();

                $('select[name="floor_id[]"]').empty();
                $('select[name="floor_id[]"]').append('<option value="">@lang('Select Block Number')</option>');


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
                }
            });
            $(document).on('click', '#minus', function(e) {
                $(this).parent('div').remove();
            });
            $(document).on('click', '#add', function(e) {
            var clone = $('#childdivtoadd2').clone();
            clone.find("input").val("");
            clone.appendTo('#divtoadd:last');
            clone.append('<i id="minus" name="minus" class="fas fa-minus-circle fa-2x"></i>');
            });

        });
    </script>

@endsection
