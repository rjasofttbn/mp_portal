@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('office room based telephone / PABX numbers')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('office room based telephone / PABX numbers')</li>
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
                <h4 class="card-title">@lang('Update office room based telephone / PABX numbers')</h4>
                @else
                <h4 class="card-title">@lang('Create office room based telephone / PABX numbers')</h4>
                @endif
            </div>
            <!-- Form Start-->
            <form id="ministryForm" name="ministryForm" method="POST" @if($data->id)
                action="{{ route('admin.requisition.office_wise_telephone_pabx.update', $data->id) }}">
                <input name="_method" type="hidden" value="PUT">
                @else
                action="{{ route('admin.requisition.office_wise_telephone_pabx.store') }}">
                @endif
                @csrf

                <input type="hidden" id="id" name="id" value="{{$data->id}}">
                <div class="card-body">
                    <div class="row">
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
                        <div class="col-sm-4 {{$data->building_type == 0?'displays':'hides'}}" id="hostel_portion" >
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
                    <div id="songshod_portion" 
                    class="row {{$data->building_type == 1?'displays':'hides'}}">

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
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="num_of_telephone">@lang('telephone number')<span style="color: red;"> *</span></label>
                                <input type="text" id="num_of_telephone" name="num_of_telephone" value="{{old('num_of_telephone', $data->num_of_telephone)}}" class="form-control @error('num_of_telephone') is-invalid @enderror" placeholder="@lang('Enter Number of Telephone')" autocomplete="off" maxlength="30">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4 mt-4">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="status_telephone" {{ $data->status_telephone == 1 ? 'checked' : '' }} value="1" class="custom-control-input" id="status_telephone">
                                <label class="custom-control-label" for="status_telephone">
                                    @if($data->status_telephone == 0)
                                    @lang('Make it active ?')
                                    @else
                                    @lang('Make it inactive ?')
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="num_of_pabx">@lang('PABX number')<span style="color: red;"> *</span></label>
                                <input type="text" id="num_of_pabx" name="num_of_pabx" value="{{old('num_of_pabx', $data->num_of_pabx)}}" class="form-control @error('num_of_pabx') is-invalid @enderror" placeholder="@lang('Enter Number of PABX')" autocomplete="off" maxlength="30">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4 mt-4">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="status_pabx" {{ $data->status_pabx == 1 ? 'checked' : '' }} value="1" class="custom-control-input" id="status_pabx">
                                <label class="custom-control-label" for="status_pabx">
                                    @if($data->status_telephone == 0)
                                    @lang('Make it active ?')
                                    @else
                                    @lang('Make it inactive ?')
                                    @endif
                                </label>
                            </div>
                        </div>
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
                if(res == 0){
                    alert('No Room Found')
                }else{
                    $('#room_id').html(res);
                }
                
            }

        })
    })
</script>
<style>
    .hides {
        visibility: hidden
    }
    .displays{
        visibility: visible
    }
</style>

@endsection