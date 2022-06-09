

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
                        <li class="breadcrumb-item"><a href="{{ route('admin.accommodation.applications.index') }}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Manage Accommodation Application')</li>
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
                    {{-- @if (!empty($acc_app))  --}}
                    <div class="card">
                        <div class="card-header text-right">
                            <a href="{{route('admin.accommodation.applications.index') }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> @lang('Add Application')</a>
                        </div>
                       {{-- {{ dd($acc_app)}} --}}
                        <div class="card-body">
                            <table id="dataTable" class="table table-sm table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('Serial')</th>                    
                                    <th>@lang('Application Type')</th>
                                    <th>@lang('Date')</th>                   
                                    <th>@lang('Status')</th>
                                    <th class="text-center">@lang('Action')</th>
                                </tr>
                                </thead>
                                <tbody>                   
                                    @php
                                    $i=1;
                                @endphp
                                @foreach($acc_app as $list)
                                    <tr>
                                        <td>{{Lang::get($loop->iteration)}}</td>
                                        <td>{{$list->name_bn}}</td>
                                        <td>{{
                                       
                                        date('d-m-Y h:i A', strtotime($list->created_at))
                                        }}</td>
                                        <td>
                                            {{accommodation_status(@$list->status)}}
                                        </td>
                                        <td class="text-center">
                                            @if($list->status==0)
                                            <a class="btn btn-sm btn-success" href="{{route('admin.accommodation.applications.edit',$list->id)}}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @endif 
                                            @if($list->status ==0) 
                                            <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.accommodation.applications.destroy', $list->id)}}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            @endif 
                                            @if($list->application_type_id ==1) 
                                            <a class="btn btn-sm btn-info" href="{{route('admin.accommodation.applications.mp.viewAppPending',$list->id)}}">
                                                <i class="fa fa-eye"></i>
                                            </a>  
                                            @elseif($list->application_type_id ==2)
                                             <a class="btn btn-sm btn-info" href="{{route('admin.accommodation.applications.mp.viewAppPending',$list->id)}}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @elseif($list->application_type_id ==3)
                                            <a class="btn btn-sm btn-info" href="{{route('admin.accommodation.applications.mp.viewAppPending',$list->id)}}">
                                                <i class="fa fa-eye"></i>
                                            </a>   
                                            @elseif($list->application_type_id ==4)
                                            <a class="btn btn-sm btn-info" href="{{route('admin.accommodation.applications.mp.viewAppPending',$list->id)}}">
                                                <i class="fa fa-eye"></i>
                                            </a>   
                                            @elseif($list->application_type_id ==5)
                                            <a class="btn btn-sm btn-info" href="{{route('admin.accommodation.applications.mp.viewAppPending',$list->id)}}">
                                                <i class="fa fa-eye"></i>
                                            </a>   
                                            @elseif($list->application_type_id ==6)
                                            <a class="btn btn-sm btn-info" href="{{route('admin.accommodation.applications.mp.viewAppPending',$list->id)}}">
                                                <i class="fa fa-eye"></i>
                                            </a>   
                                            @endif

                                            
                                              
                                            @if($list->status ==4 )
                                            <a class="btn btn-sm btn-success" href="{{route('admin.accommodation.applications.mp.approveAppPdf',$list->id)}}">
                                                <i class="fa fa-eye"></i>
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
                    {{-- @else
                    <div class="card"style="margin-top: 171px; text-align:center;">
                      <div class="card-body">
                      <h3 style="color: red;">@lang('No application form')</h3>
                  </div>
              </div>
              @endif  --}}
                </div>
            </div>
        </div>
        <!--/. container-fluid -->
    </section>
@endsection




