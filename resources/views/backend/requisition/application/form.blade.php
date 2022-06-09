@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Telephone / PABX application')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Telephone / PABX application')</li>
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
                @if ($data->id)
                <h4 class="card-title">@lang('Update Telephone / PABX application')</h4>
                @else
                <h4 class="card-title">@lang('Create Telephone / PABX application')</h4>
                @endif
            </div>
            <!-- Form Start-->
            <form id="ministryForm" name="ministryForm" method="POST" @if($data->id)
                action="{{ route('admin.requisition.telephone_pabx_application.update', $data->id) }}">
                <input name="_method" type="hidden" value="PUT">
                @else
                action="{{ route('admin.requisition.telephone_pabx_application.store') }}">
                @endif
                @csrf

                <input type="hidden" id="id" name="id" value="{{$data->id}}">
                <div class="card-body">
                    <div class="row">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="connection_type">@lang('Connection Type')<span style="color: red;"> *</span></label>
                                <select id="connection_type" name="connection_type" onchange="option()" class="form-control @error('connection_type') is-invalid @enderror">
                                    <option value="">@lang('Select Connection Type')</option>
                                    <option value="1">@lang('Telephone')</option>
                                    <option value="2">@lang('Pabx')</option>
                                </select>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="connection_place">@lang('Connection Place')<span style="color: red;"> *</span></label>
                                <select id="connection_place" onchange="option()" name="connection_place" class="form-control @error('connection_place') is-invalid @enderror">
                                    <option value="">@lang('Select Connection Place')</option>
                                    <option value="1">@lang('Official')</option>
                                    <option value="2">@lang('Residential')</option>
                                </select>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row hides" id="require_connection_place_portion">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="require_connection_place">@lang('Connection Place Require')<span style="color: red;"> *</span></label>
                                <select id="require_connection_place" name="require_connection_place" class="form-control @error('require_connection_place') is-invalid @enderror select2">
                                    <option value="">@lang('Select Connection Place')</option>
                                    <option value="1">@lang('In the allotted flat in the Parliament building')</option>
                                    <option value="2">@lang('At residence')</option>
                                </select>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>



                    </div>
                    <div class="row hides" id="building_type_portion">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="building_type">@lang('Select the building name')<span style="color: red;"> *</span></label>
                                <select id="building_type" name="building_type" class="form-control @error('building_type') is-invalid @enderror select2">
                                    @php
                                    $building_type = $data->building_type;
                                    @endphp
                                    @if($building_type==0)
                                    <option selected value="0">@lang('Hostel Building')</option>
                                    @else
                                    <option value="0">@lang('Hostel Building')</option>
                                    @endif
                                    @if($building_type==1)
                                    <option selected value="1">@lang('SongShod Bhaban')</option>
                                    @else
                                    <option value="1">@lang('SongShod Bhaban')</option>
                                    @endif
                                </select>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4 hides" id="hostel_portion">
                            <div class="form-group">
                                <label class="control-label" for="block_id">@lang('Block No')<span style="color: red;"> *</span></label>
                                <select id="block_id" name="hblock_id" class="form-control @error('block_id') is-invalid @enderror select2">
                                    <option value="">@lang('Select Block Number')</option>
                                    @foreach ($hostelFloor as $list)
                                    @if($list->id==$data->block_id)
                                    <option selected value="{{$list->id}}">{{(session()->get('language') =='bn')?$list->name_bn:$list->name}}</option>
                                    @else
                                    <option value="{{$list->id}}">{{(session()->get('language') =='bn')?$list->name_bn:$list->name}}</option>
                                    @endif
                                    @endforeach
                                </select>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div id="songshod_portion" class="row hides">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="block_id">@lang('Block No')<span style="color: red;"> *</span></label>
                                <select id="sblock_id" name="block_id" class="form-control @error('block_id') is-invalid @enderror select2">
                                    <option value="">@lang('Select Block Number')</option>
                                    @foreach ($songshodBlock as $list)
                                    @if($list->id==$data->block_id)
                                    <option selected value="{{$list->id}}">{{(session()->get('language') =='bn')?$list->name_bn:$list->name}}</option>
                                    @else
                                    <option value="{{$list->id}}">{{(session()->get('language') =='bn')?$list->name_bn:$list->name}}</option>
                                    @endif
                                    @endforeach
                                </select>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="floor_id">@lang('floor No')<span style="color: red;"> *</span></label>
                                <select id="floor_id" name="floor_id" class="form-control @error('floor_id') is-invalid @enderror select2">
                                    <option value="">@lang('Select Floor Number')</option>
                                    @foreach ($songshodFloor as $list)
                                    @if($list->id==$data->floor_id)
                                    <option selected value="{{$list->id}}">{{(session()->get('language') =='bn')?$list->name_bn:$list->name}}</option>
                                    @else
                                    <option value="{{$list->id}}">{{(session()->get('language') =='bn')?$list->name_bn:$list->name}}</option>
                                    @endif
                                    @endforeach
                                </select>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="room_id" class="control-label" for="room_id">@lang('Room No')<span style="color: red;"> *</span></label>
                                <select id="room_id" name="room_id" class="form-control @error('room_id') is-invalid @enderror select2">
                                    <option value="">@lang('Select Room Number')</option>
                                    @foreach ($songshodRoom as $list)
                                    @if($list->id==$data->room_id)
                                    <option selected value="{{$list->id}}">{{(session()->get('language') =='bn')?$list->name_bn:$list->name}}</option>
                                    @endif
                                    @endforeach
                                </select>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row hides" id="own_address_portion">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label class="control-label" for="telphone_expenses">@lang('Address to provide the connection')<span style="color: red;"> *</span></label>
                                <input type="text" id="own_address" name="own_address" onkeydown="removeSpecials(event)" value="{{old('own_address', $data->own_address)}}" class="form-control @error('own_address') is-invalid @enderror" placeholder="@lang('Enter the address to provide the connection')" autocomplete="off" maxlength="30">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="telphone_expenses">@lang('Would you like to cash the telephone allowance')<span style="color: red;"> *</span></label>
                                <select name="want_renew" id="want_renew" class="form-control">
                                    <option value="1">@lang('Yes')</option>
                                    <option value="2">@lang('No')</option>
                                </select>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        @if($data->id)
                        <div class="form-group col-sm-4 mt-auto">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="status" {{ $data->status == 1 ? 'checked' : '' }} value="1" class="custom-control-input" id="active-status">
                                <label class="custom-control-label" for="active-status">
                                    @if($data->status == 0)
                                    @lang('Make it active ?')
                                    @else
                                    @lang('Make it inactive ?')
                                    @endif
                                </label>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group text-right">
                            @if($data->id)
                            <button type="submit" class="btn btn-success btn-sm">@lang('Update')</button>
                            @else
                            <button type="submit" class="btn btn-success btn-sm">@lang('Save')</button>
                            <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                            @endif
                            <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                <a href="{{route('admin.master_setup.songshodRoom.index') }}">@lang('Back')</a>
                            </button>
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
    // function removeSpecials(evt) {
    //     var input = document.getElementById("room_bn");
    //     var patt = /[^\u0000-\u007F ]+/;
    //     setTimeout(function() {
    //         var value = input.value;
    //         if (patt.test(value) == false) {
    //             input.value = "";
    //         }
    //     }, 100);
    // }
    $('#building_type').change(function() {
        let building_type = $(this).val();
        if (building_type == 1) {
            $('#songshod_portion').css('visibility', 'visible');
            $('#hostel_portion').hide();
        } else {
            $('#songshod_portion').css('visibility', 'hidden');
            $('#hostel_portion').show();
        }
    })
    $('#floor_id').change(function() {
        let floor_id = $(this).val();
        let block_id = $('#sblock_id').val();
        $.ajax({
            url: "{{url('/requisition/getRoom')}}",
            method: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                floor_id: floor_id,
                block_id: block_id
            },
            success: function(res) {
                if (res == 0) {
                    alert('No Room Found')
                } else {
                    $('#room_id').html(res);
                }

            }

        })
    })
    function option(){
        let connection_type = $('#connection_type').val();
        let connection_place = $('#connection_place').val();
        console.log(connection_place,connection_type)
        if(connection_place == 2 && connection_type == 1){
            $('#require_connection_place_portion').addClass('displays');
            $('#require_connection_place_portion').removeClass('hides');
            $('#building_type_portion').removeClass('displays');
            $('#building_type_portion').addClass('hides');
            $('#hostel_portion').removeClass('displays');
            $('#hostel_portion').addClass('hides');
            $('#songshod_portion').removeClass('displays');
            $('#songshod_portion').addClass('hides');
        }else if(connection_place == 1 && connection_type == 1){
            $('#require_connection_place_portion').removeClass('displays');
            $('#require_connection_place_portion').addClass('hides');            
            $('#building_type_portion').addClass('displays');
            $('#building_type_portion').removeClass('hides');
            $('#hostel_portion').addClass('displays');
            $('#hostel_portion').removeClass('hides');
        }else if(connection_place == 1 && connection_type == 1){
            $('#require_connection_place_portion').removeClass('displays');
            $('#require_connection_place_portion').addClass('hides');            
            $('#building_type_portion').removeClass('displays');
            $('#building_type_portion').addClass('hides');
            $('#hostel_portion').removeClass('displays');
            $('#hostel_portion').addClass('hides');
        }else if(connection_place == 2 && connection_type == 2){
            $('#require_connection_place_portion').removeClass('displays');
            $('#require_connection_place_portion').addClass('hides'); 
            $('#building_type_portion').addClass('displays');
            $('#building_type_portion').removeClass('hides');
            $('#hostel_portion').addClass('displays');
            $('#hostel_portion').removeClass('hides');
        }
        else{
            $('#require_connection_place_portion').removeClass('displays');
            $('#require_connection_place_portion').addClass('hides');
        }
    }
    $('#require_connection_place').change(function() {
        let require_connection_place = $(this).val();
        if(require_connection_place == 2){
            $('#own_address_portion').addClass('displays');
            $('#own_address_portion').removeClass('hides');
        }else{
            $('#own_address_portion').removeClass('displays');
            $('#own_address_portion').addClass('hides');
        }
    })
</script>
<style>
    .hides {
        visibility: hidden
    }

    .displays {
        visibility: visible
    }
</style>

@endsection