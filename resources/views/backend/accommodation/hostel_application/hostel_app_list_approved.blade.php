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
                        <li class="breadcrumb-item"><a href="{{route('admin.accommodation.hostel_application.index') }}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Application Management')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                
                    <div class="card">
                        <div class="card-header text-right">
                            <a href="{{route('admin.accommodation.hostel_application.index') }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> @lang('Add Application')</a>
                        </div>
                        <div class="card-body">
                            <table id="dataTable" class="table table-sm table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('Serial')</th>                    
                                    <th>@lang('Application Type')</th>
                                    <th>@lang('Hostel Building No')</th>
                                    <th>@lang('Floor No')</th>
                                    <th>@lang('Office Room No')</th>
                                    <th>@lang('Date')</th>                   
                                    <th>@lang('Status')</th>
                                    <th class="text-center">@lang('Action')</th>
                                </tr>
                                </thead>
                                <tbody>                   
                                    @php
                                    $i=1;
                                    $ca = 2;
                                @endphp
                               
                                @foreach($mp_apps as $list)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$list->subject}}</td>
                                        <td>{{$list->hostel_bu_bn}}</td>
                                        <td>{{$list->hostel_fl_bn}}</td>
                                        <td>{{$list->hostel_ofr_bn}}</td>
                                        <td>{{
                                          date('d-m-Y h:i A', strtotime($list->created_at))
                                        }}</td>
                                        <td>@if($list->status==5)
                                            Approved                        
                                            @endif
                                        </td>
                                        <td class="text-center">   
                                            @if ($type =='hostelCancel' )
                                                <a class="btn btn-sm btn-danger" valu href="{{url('admin/accommodation/hostel_application/hostelCancel/createCancel',$list->application_id)}}">
                                                <i class="fa fa-ban"></i>
                                            </a> 
                                            @endif                                         
                                            @if ($type =='hostelExchange' )
                                                <a class="btn btn-sm btn-danger" valu href="{{url('admin/accommodation/hostel_application/hostelChange/createChange',$list->application_id)}}">
                                                <i class="fa fa-ban"></i>
                                            </a> 
                                            @endif                                         
                                                                                    
                                                             
                                    </td>
                                    </tr>
                                @endforeach   
                                </tbody>
                                </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                
                </div>
            </div>
        </div>
        <!--/. container-fluid -->
    </section>
@endsection




