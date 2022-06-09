@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Furniture/Electrical Goods Managment')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.accommodation-asset-management.setup.furniture_electronic_goods.index') }}">@lang('Home')</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('Furniture/Electrical Goods Add')</li>
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
                        <div class="card-header text-left">
                            <h5>@lang('Furniture/Electrical Goods List')</h5>
                        </div>
                        {{-- {{ dd($data) }} --}}
                        <div class="card-body">
                            <table id="dataTable" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="8%">@lang('Serial')</th>
                                        <th>@lang('Area Name')</th>
                                        <th>@lang('Accommodation Type')</th>
                                        <th>@lang('Building Name')</th>
                                        <th>@lang('Furniture/Goods Type')</th>
                                        <th>@lang('Furniture/Goods Name')</th>
                                        <th width="10%">@lang('Total No.')</th>
                                        <th width="10%" class="text-center">@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($furniture_electronic_goods as $list)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ @$list['area']['name_bn'] }}</td>
                                            <td>{{ @$list['accommodation_type']['name_bn'] }}</td>
                                            <td>{{ @$list['accommodation_building']['name_bn'] }}</td>
                                            <td>{{ @$list['accommodation_asset_type']['name_bn'] }}</td>
                                            <td>{{ @$list['accommodation_asset']['name_bn'] }}</td>
                                            <td>
                                                {{ @$list->total_no }}
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-success"
                                                    href="{{ route('admin.accommodation-asset-management.setup.furniture_electronic_goods.edit', $list->id) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-sm btn-danger destroy"
                                                    data-route="{{ route('admin.accommodation-asset-management.setup.furniture_electronic_goods.destroy', $list->id) }}">
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
