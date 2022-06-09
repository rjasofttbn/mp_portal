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
{{-- {{  }} --}}

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{-- <h5>Building and Floor</h5> --}}
                </div>

                @if(count($total_office_room)>0)

                <!-- Form Start-->
                <form method="POST" action="{{ route('admin.accommodation-management.setup.office_rooms.update', $data->id) }}" enctype="multipart/form-data">
                    @csrf
                    @if (isset($data))
                    @method('PUT')
                    @endif

                    
                    <div class="card-body">
                        <div id="divtoadd">
                        <div id="childdivtoadd" class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label" for="building_id">@lang('Select Building Name')<span
                                            style="color: red;"> *</span></label>
                                    <select id="building_id" name="building_id" class="form-control @error('building_id') is-invalid @enderror">
                                        <option value="">{{ $data->name_bn }}</option>
                                    </select>

                                    @error('building_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @for($i=0;$i<count($total_office_room);$i++) 
                        <div id="childdivtoadd2" class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label" for="floor_id">@lang('Select Block Number')<span
                                            style="color: #ff0000;"> *</span></label>
                                  
                                  
                                            <select  name="floor_id[]" class="floor_id form-control @error('floor_id') is-invalid @enderror">
                                        <option selected value="{{ $floorId[$i] }}">{{ $floorNo[$i] }}</option>

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
                                   
                                            <input type="number" id="total_office_room" name="total_office_room[]" value="{{ $total_office_room[$i] }}"
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
                                    <input type="number" id="startno" name="startno[]" value="{{ $officeRoomStartNo[$i] }}"
                                           class="form-control @error('name') is-invalid @enderror"
                                           autocomplete="off" maxlength="30">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                              
                            </div>
                        </div>
                        @endfor
                    </div>
                    @endif
                            <input type="hidden" name="status" id="status" value="1">
                      @if(count($total_office_room)>0)

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                        <a href="{{route('admin.accommodation-management.setup.office_rooms.index') }}">@lang('Back')</a>
                                    </button>
                                    @if($data->id)
                                        <button type="submit" class="btn btn-success btn-sm">@lang('Update')</button>
                                    @else
                                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                                        <button type="reset" class="btn btn-danger btn-sm">Clear</button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @endif
                    </div>
                </form>
                <!--Form End-->
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {


            $('select[name="area_id"]').on('change', function () {
                var area_id = $(this).val();

                $('select[name="building_id"]').empty();
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
                }

            });


            $('select[name="building_id"]').on('change', function () {
                var building_id = $(this).val();


                $('.floor_id').empty();
                $('.floor_id').append('<option value="">@lang('Select Block Number')</option>');

                if (building_id > 0) {
                    $.ajax({
                        url: '{{url("floorListByAccommodationBuildingId")}}',
                        data:{building_id:building_id},
                        type: "GET",
                        dataType: "json",
                        beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },
                        success: function (result) {
                            $.each(result.data, function (k, val) {
                                $('.floor_id').append('<option value="' + val.id + '">' + val.name + '</option>');
                            });
                        },
                        complete: function () {
                            //$('#loader').css("visibility", "hidden");
                        }
                    });
                } else {
                    $('.floor_id').empty();
                    $('.floor_id').append('<option value="">@lang('Select Block Number')</option>');
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



