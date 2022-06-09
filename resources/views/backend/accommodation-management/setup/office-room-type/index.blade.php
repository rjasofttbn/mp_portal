@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Manage Office Room Type')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.accommodation-management.setup.office_room_types.index') }}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Manage Office Room Type')</li>
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
                            <a href="{{route('admin.accommodation-management.setup.office_room_types.create') }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> @lang('Add Office Room Type')</a>
                        </div>
                        <div class="card-body">
                            <table id="dataTable" class="table table-sm table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('Serial')</th>
                                    <th>@lang('Name (Bangla)')</th>
                                    <th>@lang('Name (English)')</th>
                                    <th>@lang('Service Charge')</th>
                                    <th width="7%">@lang('Status')</th>
                                    <th width="15%" class="text-center">@lang('Action')</th>
                                </tr>
                                </thead>
                                <tbody>           
                                    @foreach (                                         
                                        $datas as $data)                                       
                                        <tr>
                                            <td>{{ Lang::get($loop->iteration) }}</td>
                                            <td>{{ $data->name_bn }} </td>
                                            <td>{{ $data->name }} </td>
                                            <td>{!!  $data->service_charge !!}</td>
                                            <td>{!! activeStatus($data->status) !!}</td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-info" href="{{route('admin.accommodation-management.setup.office_room_types.edit', $data->id)}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-sm btn-danger destroy"
                                                data-route="{{route('admin.accommodation-management.setup.office_room_types.destroy' , $data->id)}}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
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