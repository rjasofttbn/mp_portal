@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Floor and Flat update')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Floor and Flat update')</li>
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
                    <h5>@lang('Floor and Flat update')</h5>
                </div>

                @if(count($totalFlat)>0)

                <!-- Form Start-->
                <form  id="submitForm">
                    @if($data->id)
                    <input name="_method" type="hidden" value="PUT">
                @endif
                @csrf

                    
                    <div class="card-body">
                        <div id="divtoadd">
                        <div id="childdivtoadd" class="row">


                            <div id="areatocopy" class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label" for="area_id">@lang('Area')<span
                                            style="color: red;"> *</span></label>
                                    <select id="area_id" name="area_id" class="form-control @error('area_id') is-invalid @enderror">
                                        <option selected value="{{ $data->area_id }}">{{ $areaName }}</option>
                                        
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
                                    <select id="building_id" name="building_id" class="form-control @error('building_id') is-invalid @enderror">
                                        <option value="">{{ $data->name }}</option>

                                    </select>

                                    @error('building_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>



                        @for($i=0;$i<count($totalFlat);$i++) 
                            
                     

                        <div id="0" class="row">


                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label" for="floor_id">@lang('Floor')<span
                                            style="color: #ff0000;"> *</span></label>
                                    <select id="floor_id" name="floor_id[]" class="floor_id form-control @error('floor_id') is-invalid @enderror">
                                      @foreach($floorData as $value)
                                      <option @if($floorId[$i]==$value['id'])
                                      selected
                                      @endif
                                      
                                      value="{{$value['id']}}">{{ $value['name'] }}</option>
                                        @endforeach
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
                                    <label class="control-label" for="totalflat">@lang('Total Flat')<span
                                            style="color: red;"> *</span></label>
                                    <input type="number" id="totalflat" name="totalflat[]" value="{{ $totalFlat[$i] }}"
                                           class="form-control @error('total_flat') is-invalid @enderror"
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
                                    <label class="control-label" for="startno">@lang('Flat Start No')@lang(':')<span
                                            style="color: red;"> *</span></label>
                                    <input type="number" id="startno" name="startno[]" value="{{ $flatStartNo[$i] }}"
                                           class="form-control @error('startno') is-invalid @enderror"
                                           autocomplete="off">

                                    @error('startno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                              
                            </div>
                        
                            <i id="add" name="add" class="fas fa-plus-circle text-green fa-2x"></i>

                        <i id="minus" name="minus" class="fas fa-minus-circle text-red fa-2x"></i>

                        </div>

                        @endfor

                    </div>
                          
                    @endif
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-right">
                                    @if($data->id)

                                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                                   
                                    @endif
                                    <a href="{{route('admin.accommodation-management.setup.floorflats.index') }}" class="btn btn-default btn-sm ion-android-arrow-back text-blue"> @lang('Back')</a>

                                </div>
                            </div>
                        </div>
                   
                        
                      
                    </div>
                </form>
                
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {

            $(document).on('click', '#minus', function(e) {
                
                $(this).parent('div').remove();



            });

            
          var countdiv={{ count($totalFlat) }};
          
            $(document).on('click', '#add', function(e) {
               
                
                var id=$(this).parent('div').attr('id');
                
                newid=parseInt(id)+countdiv+1;
               
               
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
                    url : "{{route('admin.accommodation-management.setup.floorflats.update',$data->id)}}",

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



