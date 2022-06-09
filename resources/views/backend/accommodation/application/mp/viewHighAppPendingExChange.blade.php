@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('High Official Application Management')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.accommodation.applications.index') }}">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('High Official Application Management')</li>
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
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                        </div>
                        </div>
                        </div>
                        <div class="col-md-12"> 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                    {{-- <h4><u>@lang('Accommodation Allotments Information')</u></h4>
                    <p>
                      <ul style=" line-height: 40px; font-size: 15px; list-style-type:circle;">
                       <li><b>@lang('Area') :</b> {{$data['ap'][0]->area_bn}} </li> 
                       <li><b>@lang('Building') :</b> {{$data['ap'][0]->ac_building_bn}} </li> 
                       <li><b>@lang('Floor Name') :</b> {{$data['ap'][0]->floor_bn}} </li> 
                       <li><b>@lang('Flat No') :</b> {{$data['ap'][0]->flat_no_bn}} </li> 
                       <li><b>@lang('Flat Size') :</b> {{$data['ap'][0]->size_bn}} </li> 
                       <li><b>@lang('Approval Date') :</b> {{ date('d-m-Y', strtotime($data['ap'][0]->whips_ar_date))}}  </li> 
                    </ul>  
                    </p> --}}
                </div>
                     <div class="col-sm-12 col-md-6 col-lg-6">
                    <h4><u>@lang('Current Application Information')</u></h4>
                    <p>
                      <ul style=" line-height: 40px; font-size: 15px; list-style-type:circle;">
                       <li><b>@lang('Selected Date') :</b> {{ date('d-m-Y', strtotime($data['na'][0]->date))}}  </li> 
                       <li><b>@lang('Description') :</b> {{$data['na'][0]->description}} </li> 
                    </ul>  
                    </p>
                </div>
            </div>
            </div>
        </div>
        </div>
        </div>
              
    </div>
    </div>
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