@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Flat Type Management')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Flat Type Management')</li>
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
                    @if (isset($editData))
                   
                    <h5>@lang('Update Flat Type')</h5>
                    @else
                    <h5>@lang('Create Flat Type')</h5>
                    @endif
                </div>
                <!-- Form Start-->
                <form  id="submitForm">
                    @if(@$editData)
                    <input name="_method" type="hidden" value="PUT">
                    @endif
                    @csrf

                    <div class="card-body">
                        <div class="row">
                        
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="name_bn">@lang('Name (Bangla)')<span
                                            style="color: red;"> *</span></label>
                                    <input type="text" id="name_bn" name="name_bn"  value="{{ old('name_bn') ?? $editData->name_bn ?? '' }}"
                                           class="form-control name_bn @error('name_bn') is-invalid @enderror"
                                           placeholder="@lang('Enter Name in Bangla')" autocomplete="off">
                                    @error('name_bn')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> @lang('$message') </strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="name">@lang('Name (English)')<span
                                            style="color: red;"> *</span></label>
                                    <input type="text" id="name" name="name"  value="{{ old('name') ?? $editData->name ?? '' }}"
                                           class="form-control name @error('name') is-invalid @enderror"
                                           placeholder="@lang('Enter Name in English')" autocomplete="off">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="size">@lang('Size')<span
                                            style="color: red;"> *</span></label>
                                    <input type="number" id="size" name="size" value="{{ old('size') ?? $editData->size ?? '' }}"
                                           class="form-control size @error('size') is-invalid @enderror"
                                           placeholder="@lang('Enter Size')" autocomplete="off" >

                                    @error('size')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                           <div class="col-sm-4">
                                    <div class="form-group">        
                                        <label class="control-label" for="service_charge">@lang('Service Charge')<span style="color: red;"> *</span></label>
                                         <input type="number" id="service_charge" name="service_charge" value="{{ old('service_charge') ?? $editData->service_charge ?? '' }}"
                                               class="form-control service_charge @error('service_charge') is-invalid @enderror"
                                               placeholder="@lang('Enter Service Charge')" autocomplete="off">
    
                                        @error('service_charge')
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
                                    @if(@$editData->id)
                                    <button type="submit" class="btn btn-success btn-sm">@lang('Update')</button>
                                    @else
                                    <button type="submit" class="btn btn-success btn-sm">@lang('Save')</button>
                                    <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                    @endif
                                    <a href="{{route('admin.accommodation-management.setup.flat_types.index') }}" class="btn btn-default btn-sm ion-android-arrow-back text-blue"> @lang('Back')</a>

                             
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
        $(document).ready(function(){
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
                        url : "{{(@$editData)?route('admin.accommodation-management.setup.flat_types.update',@$editData->id):route('admin.accommodation-management.setup.flat_types.store') }}",
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
                                   location.replace("{{route('admin.accommodation-management.setup.flat_types.index')}}");
                               }, 1450);
                            }else if(data.status == 'error'){
                                toastr.error("",data.message);
                                $('[type="submit"]').removeAttr('disabled').css('cursor','pointer');
                                $('.preload').hide();
                            }else{
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
                'name' : {
                    required : true,
                    regex:"^[a-zA-Z0-9 ',\\.\\g]{1,4000}$",
                 
                    remote: {
                     
                        url: "{{route('admin.accommodation-management.setup.flat_types.duplicate-check')}}",
                        type: "GET",
                        data: {
                        
                            checkname: function(){
                                if($("#name").val()=="{{old('name', @$editData->name)}}"){
                                    return 'except';
                                }
                                else{

                                    return $("#name").val();


                                }
                                }
                        }
                    }
                
                },
                'name_bn' : {
                    required : true,
                 
                    remote: {
                     
                        url: "{{route('admin.accommodation-management.setup.flat_types.duplicate-check')}}",
                        type: "GET",
                        data: {
                        
                            checkname_bn: function(){
                                if($("#name_bn").val()=="{{old('name_bn', @$editData->name_bn)}}"){
                                    return 'except';
                                }
                                else{

                                    return $("#name_bn").val();


                                }
                                }
                        }
                    }
                
                },             
                'size' : {
                    required : true,
                 
                
                
                },
                'service_charge' : {
                    required : true,
                 
                 
                
                }
        
        
        
        
        




                
            }); 


        });
    </script>



@endsection
