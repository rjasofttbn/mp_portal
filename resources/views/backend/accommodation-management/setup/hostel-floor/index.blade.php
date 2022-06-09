@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Block Management')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.accommodation-management.setup.hostel_floors.index')}}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Block Management')</li>
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
                            <a href="{{route('admin.accommodation-management.setup.hostel_floors.create')}}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> @lang('Add Block')</a>
                        </div>
                        <div class="card-body">
                             <table id="dataTable" class="table table-sm table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="8%">@lang('Serial')</th>
                                    <th>@lang('Block Name (Bangla)')</th>
                                    <th>@lang('Block Name (English)')</th>
                                    <th>@lang('Building Name')</th>
                                    <th width="10%">@lang('Status')</th>
                                    <th width="10%" class="text-center">@lang('Action')</th>
                                </tr>
                                </thead>
                                <tbody>
                            
                                @php
                                    $i=1;
                                    $j=0;
                                @endphp
                            
                                @foreach($data as $list)
                            
                                    <tr>
                                        <td>{{ Lang::get($loop->iteration) }}</td>
                                        <td>{{$list->hf_name_bn}}</td>
                                        <td>{{$list->hf_name_en}}</td>
                                        <td>{{$list->name_bn}}</td>
                                        <td>
                                            {!! activeStatus($list->status) !!}
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-success" href="{{route('admin.accommodation-management.setup.hostel_floors.edit',$list->id)}}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.accommodation-management.setup.hostel_floors.destroy', $list->id)}}">
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


