@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Application for Change Hostel')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Change Hostel')</li>
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
                <h4><u>@lang('Current Allotment Information')</u></h4>
                <p  >
                    <Ul style=" line-height: 40px; font-size: 15px; list-style-type: square;">
                        @foreach($mp_apps as $mp_app)
                       <b>@lang('Hostel Building No') : </b> {{ $mp_app->hostel_bu_bn }};
                        <b>@lang('Floor No') : </b>{{ $mp_app->hostel_fl_bn }};
                        <b>@lang('Office Room No') : </b>{{ $mp_app->hostel_ofr_bn }};
                         <b>@lang('Approval Date') : </b>
                            {{ date('d-m-Y', strtotime($mp_app->whips_ar_date)) }};
                            <br>
                         
                            @endforeach   
                    </Ul>
                </p>
                   
                </div>
                </div>
        <div class="card">
            <div class="card-body">
                <form id="changeHostel" class="form-horizontal" action="{{route('admin.accommodation.hostel_application.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <label class="control-label" for="subject">@lang('Subject') <span class="text-danger"> *</span></label>
                            </div>
                            <div class="col-sm-12 col-md-10 col-lg-10">
                                <input type="text" id="subject" name="subject" value="{{$applicationTypesubject}}"
                                    class="form-control @error('subject') is-invalid @enderror"
                                    placeholder="@lang('Enter Subject ')" autocomplete="off" maxlength="30" readonly>
                                @error('subject')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @php
                        $applicationType = 3;
                    @endphp
                    </div>
                    <input type="hidden" name="applicationType" id="applicationType" value="{{ $applicationType }}">
                    <input type="hidden" name="change_application_id" id="change_application_id" value="{{$application_id }}">
                    <div class="form-group">                           
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <label class="control-label" for="Building">@lang('Selected The Building') <span
                                        class="text-danger"> *</span></label>                                          
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-5">
                                        <select id="hostel_building_id" name="hostel_building_id"
                                                class="@error('hostel_building_id') is-invalid @enderror form-control form-control-sm select2">
                                            <option value="">@lang('Select Building Number')</option>                                    
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
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input @error('date') is-invalid @enderror" name="date" 
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
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <label class="control-label" for="change_reason">@lang('Change Reason') <span class="text-danger"> *</span></label>
                            </div>
                            <div class="col-sm-12 col-md-10 col-lg-10">
                                <input type="text" id="description" name="description" value=""
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="@lang('Change Reason')" autocomplete="off" maxlength="30" >
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
    @endsection
    @section('script')
    <script>
        $(function() {
            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'DD-MM-YYYY',
            });
        })
    </script>
    @endsection

