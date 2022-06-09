@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Hostel Building Management')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.accommodation-management.setup.hostel_buildings.index') }}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Hostel Building Management')</li>
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
                  
                {{-- </div> --}}

                {{-- @if(@$editData->id)
                <h5>@lang('Update Hostel Building')</h5>
                @else
                <h5>@lang('Create Hostel Building')</h5>
                @endif--}}
            </div>
            <!-- Form Start-->
            <form id="submitForm">
                @if(@$editData)
                    <input name="_method" type="hidden" value="PUT">
                @endif
                @csrf 
                <!-- Form Start-->
                {{-- <form method="POST" action="{{ isset($editData) ? route('admin.accommodation-management.setup.hostel_buildings.update', $editData->id) : route('admin.accommodation-management.setup.hostel_buildings.store') }}">
                    @csrf
                    @if (isset($editData))
                        @method('PUT')
                    @endif --}}

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="name">@lang('Name (English)')<span
                                            style="color: red;"> *</span></label>
                                    <input type="text" id="name" name="name"  value="{{ old('name') ?? $editData->name ?? '' }}"
                                           class="form-control @error('name') is-invalid @enderror name"
                                           placeholder="@lang('Enter Name in English')" autocomplete="off" maxlength="30">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="name_bn">@lang('Name (Bangla)')<span
                                            style="color: red;"> *</span></label>
                                    <input type="text" id="name_bn" name="name_bn"  value="{{ old('name_bn') ?? $editData->name_bn ?? '' }}"
                                           class="form-control @error('name_bn') is-invalid @enderror name_bn"
                                           placeholder="@lang('Enter Name in Bangla')" autocomplete="off" maxlength="30">
                                    @error('name_bn')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="total_floor">@lang('Total Floor')<span
                                            style="color: red;"> *</span></label>
                                     <input type="text" id="total_floor" name="total_floor"  value="{{ old('total_floor') ?? $editData->total_floor ?? '' }}"
                                        class="form-control @error('total_floor') is-invalid @enderror total_floor"
                                        placeholder="@lang('Enter Total Floor')" autocomplete="off" maxlength="30">
                                    @error('total_floor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @if (isset($editData->status))
                            <div class="form-group col-sm-4 mt-auto">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="status" {{ $editData->status == 1 ? 'checked' : '' }} value="1" class="custom-control-input status" id="active-status">
                                    @if ($editData->status == 1)
                                    <label class="custom-control-label" for="active-status">@lang('Make it inactive ?')</label>  
                                  @else
                                       <label class="custom-control-label" for="active-status">@lang('Make it active ?')</label> 
                                  @endif
                                  </div>
                            </div>
                                {{-- <div class="form-group col-sm-4 mt-auto">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="status" {{ $editData->status == 1 ? 'checked' : '' }} value="1" class="custom-control-input status" id="active-status status">
                                            @if ($editData->status == 1)
                                              <label class="custom-control-label" for="active-status">@lang('Make it inactive ?')</label>  
                                            @else
                                                 <label class="custom-control-label" for="active-status">@lang('Make it active ?')</label> 
                                            @endif
                                      </div>
                                </div> --}}
                            @endif

                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                        <a href="{{route('admin.accommodation-management.setup.hostel_buildings.index') }}">@lang('Back')</a>
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                    <button type="submit" class="btn btn-success btn-sm">@if(isset($editData)) @lang('Update') @else @lang('Save') @endif</button>
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
                        url : "{{(@$editData)?route('admin.accommodation-management.setup.hostel_buildings.update',@$editData->id):route('admin.accommodation-management.setup.hostel_buildings.store') }}",
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
                                   location.replace("{{route('admin.accommodation-management.setup.hostel_buildings.index')}}");
                               }, 2000);
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
        });
    </script>


@endsection
