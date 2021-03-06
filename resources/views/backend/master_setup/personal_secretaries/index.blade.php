@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Personal Secretary Management')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Personal Secretary Management')</li>
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
                    <h4 class="card-title w-100">@lang('Personal Secretary List')
                        <a href="{{ route('admin.master_setup.personal_secretaries.create') }}" class="btn btn-info float-right"><i class="fa fa-plus mr-2"></i> @lang('Add Secretary')</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>@lang('Serial')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Email')</th>
                                    <th>@lang('MP')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($allData) && count($allData) > 0)
                                    @foreach ($allData as $data)                                        
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>@if(session()->get('language') =='bn')
                                            {{ $data->name_bn }}
                                            @else
                                            {{ $data->name }}
                                            @endif
                                        </td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->ps_of_mp }}</td>
                                        <td>
                                            <a href="{{ route('admin.master_setup.personal_secretaries.edit',$data->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
