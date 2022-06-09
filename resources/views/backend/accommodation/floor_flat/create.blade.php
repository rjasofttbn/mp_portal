@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Floor and Flat Management')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Floor and Flat Management')</li>
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
                    <h5>@lang('Floor and Flat Setup')</h5>
                </div>
                <!-- Form Start-->
                <form  id="submitForm">
                    
                    @csrf

                  <div class="card-body">
                        <div id="divtoadd">
                        <div id="childdivtoadd" class="row">


                            <div id="areatocopy" class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label" for="area_id">@lang('Area')<span
                                            style="color: red;"> *</span></label>
                                            <select id="area_id" name="area_id" class="form-control area_id @error('area_id') is-invalid @enderror" >
                                                {!! areaDropdown($editData->area_id ?? '') !!}
                                            </select>

                                    @error('area_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror 
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label" for="building_id">@lang('Building')<span
                                            style="color: red;"> *</span></label>
                                    <select id="building_id" name="building_id" class="form-control building_id @error('building_id') is-invalid @enderror" >
                                        <option value="">@lang('Select Building Name')</option>

                                    </select>

                                    @error('building_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div id="0" class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label" for="floor_id">@lang('Floor')
                                        <span style="color: #ff0000;"> *</span></label>
                                    <select name="floor_id[]" class="form-control floor_id @error('floor_id') is-invalid @enderror" >
                                        <option value="">Select Floor</option>

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
                                    <label class="control-label" for="name">@lang('Total Flat')<span
                                            style="color: red;"> *</span></label>
                                    <input type="number" id="totalflat" name="totalflat[]" 
                                           class="form-control total_flat @error('name') is-invalid @enderror"
                                           autocomplete="off">

                                    @error('total_flat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label" for="name">@lang('Flat Start No')@lang(':')<span
                                            style="color: red;"> *</span></label>
                                    <input type="number" id="startno" name="startno[]" 
                                           class="form-control start_no @error('start_no') is-invalid @enderror"
                                           autocomplete="off">

                                    @error('start_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                              
                            </div>
                            <i id="add" name="add" class="fas fa-plus-circle text-green fa-2x"></i>
                            <i id="minus" name="minus" class="fas fa-minus-circle text-red fa-2x"></i>

                        

                          
                        </div>

                       
                    </div>
                          



                         


                      

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-right">
                                    
                                        <button type="submit" class="btn btn-success btn-sm">@lang('Save')</button>
                                        <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                 
                                    <a href="{{route('admin.accommodation-management.setup.floorflats.index') }}" class="btn btn-default btn-sm ion-android-arrow-back text-blue"> @lang('Back')</a>

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

            $('select[name="area_id"]').on('change', function () {
                var area_id = $(this).val();

                $('select[name="building_id"]').empty();
                $('select[name="building_id"]').append('<option value="">@lang("Select Building Name")</option>');


                if (area_id != '') {

                    $.ajax({
                        url: '{{url("accommodationbuildingdatabyareaid")}}',
                        data:{area_id:area_id},
                        type: "GET",
                        dataType: "json",
                        beforeSend: function () {
                        },
                        success: function (result) {
                            $.each(result.data, function (k, val) {
                                $('select[name="building_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                            });
                        },
                        complete: function () {
                        }
                    });
                } else {
                    $('select[name="building_id"]').empty();
                    $('select[name="building_id"]').append('<option value="">@lang("Select Building Name")</option>');
                }

            });


            $('select[name="building_id"]').on('change', function () {
                var building_id = $(this).val();
                $('.floor_id').empty();
                $('.floor_id').append('<option value="">@lang("Select Floor")</option>');
                if (building_id != '') {


                    $.ajax({
                        url: '{{url("floordatabyaccommodationbuildingid")}}',
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
                    $('.floor_id').append('<option value="">@lang('Select Floor')</option>');
                }

            });


            $(document).on('click', '#minus', function(e) {
                
                $(this).parent('div').remove();
            });
          
            $(document).on('click', '#add', function(e) {               
                
               var id=$(this).parent('div').attr('id');
               
               newid=parseInt(id)+1;
              
                var clone = $('#0').clone().insertAfter('#'+id).prop('id', newid);

                 clone.find("input").val("");         

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
                    url : "{{route('admin.accommodation-management.setup.floorflats.store')}}",
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
                               location.replace("{{route('admin.accommodation-management.setup.floorflats.index')}}");
                           }, 1450);
                        }else if(data.status == 'error'){
                            toastr.error("",data.message);
                            $('[type="submit"]').removeAttr('disabled').css('cursor','pointer');
                            $('.preload').hide();
                        }else if(data.status == 'flatexist'){
                            toastr.error('Flat Number already Exists!', {globalPosition: 'top right',className: 'error',autoHideDelay:10000});
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
            'floor_id' : {
                required : true,
             
            },
            'total_flat' : {
                required : true,
             
            },
            'start_no' : {
                required : true,
            
            }
          
      
        });  

    });
</script>


@endsection



