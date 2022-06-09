@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Application Type Management')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    {{-- <li class="breadcrumb-item"><a href="{{ route('admin.master_setup.applicationtypes.show') }}">Application</a></li> --}}
                    <li class="breadcrumb-item active">@lang('Application Type Management')</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{-- <h4 class="card-title d-block float-left">@lang('Application Type List') </h4> --}}
                <a href="{{route('admin.accommodation-management.setup.hostel_application_types.create') }}" class="btn btn-sm btn-info d-block float-right"><i class="fas fa-plus"></i> @lang('Add Application Type')</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="10%">@lang('Serial')</th>
                                <th>@lang('Subject of Application')</th>
                                <th>@lang('Application Type')</th>
                                <th width="10%">@lang('Status')</th>
                                <th width="10%" class="text-center">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($allData) && count($allData) > 0)                                
                                @foreach ($allData as $data )                                                                            
                                <tr>
                                    <td>{{ Lang::get($loop->iteration) }}</td>
                                    <td>{{$data->subject}}</td>
                                    <td>
                                        {{$data->type_name}}
                                        
                                        {{-- @if ($data->type_name=='hostelAllotment')
                                        Hostel Allotment
                                        @elseif ($data->type_name=='hostelCancel')
                                        Hostel Cancel
                                        @elseif ($data->type_name=='hostelExchange')
                                        Hostel Exchange
                                        @endif     --}}
                                    </td>
                                    <td>{!! activeStatus($data->status) !!}</td>
                                    <td class="text-center"  >
                                        <a class="btn btn-sm btn-success" href="{{route('admin.accommodation-management.setup.hostel_application_types.edit',$data->id)}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.accommodation-management.setup.hostel_application_types.destroy', $data->id)}}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
