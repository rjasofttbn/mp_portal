@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Flat')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Flat')</li>
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
                    <h5>@lang('Flat Type Setup')</h5>
                </div>
                <!-- Form Start-->
                <form  id="submitForm">
                    
                    @csrf

                    
                    <div class="card-body">
                        <div class="row">


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="area_id">@lang('Area')<span
                                            style="color: red;"> *</span></label>
                                    <select id="area_id" name="area_id" class="form-control area_id @error('area_id') is-invalid @enderror">
                                        {!! areaDropdown() !!}
                                    </select>

                                    @error('area_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="building_id">@lang('Building')<span
                                            style="color: red;"> *</span></label>
                                    <select id="building_id" name="building_id" class="form-control building_id @error('building_id') is-invalid @enderror">
                                        <option value="">@lang('Select Building Name')</option>

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
                                    <label class="control-label" for="flat_type_id">@lang('Flat Type')<span
                                            style="color: #ff0000;"> *</span></label>
                                    <select id="flat_type_id" name="flat_type_id" class="form-control flat_type_id @error('flat_type_id') is-invalid @enderror">
                                        <option value="">@lang('Select Flat Type')</option>
                                        @foreach ($flatTypeList as $value)
                                            
                                                <option  value="{{$value['id']}}">{{$value['name']}}</option>
                                         
                                        @endforeach

                                    </select>

                                    @error('flat_type_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                  
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="select_flat">@lang('Select Flat')<span
                                            style="color: red;"> *</span></label>
                                    <select id="select_flat" multiple='multiple' name="select_flat[]" class="form-control select_flat @error('select_flat') is-invalid @enderror select2">
                                       

                                    </select>
                                    
                                   
                                </div>
                                @error('select_flat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>




                    
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group text-right">
                                
                               
                                    <button type="submit" class="btn btn-success btn-sm">@lang('Save')</button>
                                    <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                    <a href="{{route('admin.accommodation-management.setup.flats.index') }}" class="btn btn-default btn-sm ion-android-arrow-back text-blue"> @lang('Back')</a>


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

            $('select[name="area_id"]').on('change', function () {
                var area_id = $(this).val();

                $('select[name="building_id"]').empty();
                $('#select_flat').empty();
                $('select[name="building_id"]').append('<option value="">Select Building</option>');              
            
                if (area_id != '') {
                   
                    $.ajax({
                        url: '{{url("accommodationbuildingdatabyareaid")}}',
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
                if (building_id != '') {
                    $.ajax({
                        url: '{{url("flatdatabyaccommodationbuildingid")}}',
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
                    $('#select_flat').empty();
                }

            });

            $('#submitForm').validate({
            ignore:[],
            errorPlacement: function(error, element){
                error.insertAfter(element);
            },
            errorClass:'text-danger',
            validClass:'text-success',

            submitHandler: function (form) {
                event.preventDefault();
                $('[type="submit"]').attr('disabled','disabled').css('cursor','not-allowed');
                var formInfo = new FormData($("#submitForm")[0]);
                $.ajax({
                    url : "{{route('admin.accommodation-management.setup.flats.type-store')}}",
                    data : formInfo,
                    type : "POST",
                    processData: false,
                    contentType: false,
                    beforeSend : function(){
                        $('.preload').show();
                    },
                    success:function(data){
                        if(data.status == 'success'){
                            toastr.success("",data.message);
                            $('.preload').hide();
                            setTimeout(function(){
                               location.replace("{{route('admin.accommodation-management.setup.flats.index')}}");
                           }, 1450);
                        }else if(data.status == 'error'){
                            toastr.error("",data.message);
                            $('[type="submit"]').removeAttr('disabled').css('cursor','pointer');
                            $('.preload').hide();
                        }
                        else{
                            toastr.error('দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য সংরক্ষন করা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান ', {globalPosition: 'top right',className: 'error',autoHideDelay:10000});
                            $('[type="submit"]').removeAttr('disabled').css('cursor','pointer');
                            $('.preload').hide();
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        toastr.error('দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য সংরক্ষন করা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান ', {globalPosition: 'top right',className: 'error',autoHideDelay:10000});
                        $('[type="submit"]').removeAttr('disabled').css('cursor','pointer');
                        $('.preload').hide();
                    }
                });
            }
        });   


        jQuery.validator.addClassRules({
            'area_id' : {
                required: true,             
            
            },
            'building_id' : {
                required : true,        

            },
            'flat_type_id' : {
                required : true,
             
            }
                       
      
        });
        
      

        });
    </script>

@endsection
