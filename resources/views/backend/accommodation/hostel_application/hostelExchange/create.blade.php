@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Application Management')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.accommodation.hostel_application.index') }}">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Application Management')</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            <h4><u>@lang('Current Hostel Information')</u></h4>
            <p  >
                <Ul style=" line-height: 40px; font-size: 15px; list-style-type: square;">
                    @foreach($mp_apps as $mp_app)
                   
                    <b>@lang('Building Name') : </b> {{ $mp_app->hostel_bu_bn }};
                     <b>@lang('Floor No') : </b>{{ $mp_app->hostel_fl_bn }};
                     <b>@lang('Office Room No') : </b>{{ $mp_app->hostel_ofr_bn }};
                      <b>@lang('Approval Date') : </b>
                         {{ date('d-m-Y', strtotime($mp_app->whips_ar_date)) }};
                        
                         <br>
                         <hr>
                         @endforeach  
                </Ul>
            </p>

                </div>
                </div>
        <div class="card">
            <div class="card-body">
               <form id="submitForm">
              
                @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <label class="control-label" for="subject">@lang('Application Type') <span class="text-danger"> *</span></label>
                            </div>
                            <div class="col-sm-12 col-md-7 col-lg-7">
                                <input type="text" id="subject" name="subject" value="{{$applicationTypesubject}}"
                                    class="form-control @error('subject') is-invalid @enderror subject"
                                    placeholder="@lang('Enter Subject ')" autocomplete="off"  readonly>
                                @error('subject')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" name="applicationType" id="applicationType" value="{{$data['applicationType'][0]->id }}">
                    <div class="form-group">                           
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <label class="control-label" for="Building">@lang('Selected The Building Name') <span
                                        class="text-danger"> *</span></label>                                          
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-5">
                                        <select id="hostel_building_id" name="hostel_building_id"
                                                class="@error('hostel_building_id') is-invalid @enderror form-control form-control-sm select2 hostel_building_id">
                                            <option value="">@lang('Selected The Building Name')</option>                                    
                                            @foreach ($hostelBuildingList as $list)
                                            <option value="{{$list->id}}">{{$list->name_bn}}</option>
                                    @endforeach 
                                        </select>
                                        @error('hostel_building_id')
                                        <span class="text-danger"></span>
                                        @enderror
                                    </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md- col-lg-3">
                                <label class="control-label" for="date"> @lang('Change Date') <span class="text-danger"> *</span></label>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" 
                                    class="form-control datetimepicker-input @error('date') is-invalid @enderror date" name="date" 
                                    id="datepicker" 
                                    value="{{old('date')}}" placeholder="@lang('Select Date')" data-target="#reservationdate" />
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                @error('date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <label class="control-label" for="office_room_id">@lang('Approved Office Room')<span
                                    style="color: red;"> *</span></label>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <select id="office_room_id" name="office_room_id" class="form-control @error('office_room_id') is-invalid @enderror office_room_id">
                                    <option value="">@lang('Select Office Room')</option>
                                    @foreach ($building_to_floor as $lista)
                                   
                                    @if($lista->office_room_id== $building_to_floor[0]->office_room_id) or $lista->office_room_id==old(office_room_id))
                                    <option selected
                                            value="{{$lista->office_room_id}}">{{$lista->hostel_ofr_bn}}</option>
                                     @else
                                    <option  value="{{$lista->office_room_id}}">{{$lista->hostel_ofr_bn}}</option>
                                     @endif
                                    @endforeach
                                </select>
    
                                @error('office_room_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                    </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <label class="control-label" for="change_reason">@lang('Change Reason') <span class="text-danger"> *</span></label>
                            </div>
                            <div class="col-sm-12 col-md-7 col-lg-7">
                                <input type="text" id="description" name="description" value=""
                                class="form-control @error('description') is-invalid @enderror description description"
                                placeholder="@lang('Enter Exchange Reason')" autocomplete="off">
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-secondary btn-sm white-text">
                                    <a href="{{ route('admin.accommodation.applications.index') }}">@lang('Back')</a>
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                @if (auth()->user()->usertype != 'ps')
                                    <input type="submit" name="draft" value="@lang('Save as Draft')" class="btn btn-info btn-sm">
                                    <input type="submit" name="submit" value="@lang('Submit')" class="btn btn-success btn-sm">
                                @else
                                    <input type="submit" name="submit" value="@lang('Submit')" class="btn btn-success btn-sm">
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </form>
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
                            url : "{{(@$editData)?route('admin.accommodation-management.setup.areas.update',@$editData->id):route('admin.accommodation.hostel_application.store') }}",
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
                                       location.replace("{{route('admin.accommodation.applications.hostel_application.hostel_application_list_mp')}}");
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
    @section('script')
    <script>
        $(function() {
            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'YYYY-MM-DD',
            });
        })
    </script>
    @endsection

