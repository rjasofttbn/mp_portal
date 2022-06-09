@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Profile Management')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Profile Management')</li>
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
                    <h4 class="card-title w-100">@lang('Parliament Member List')
                        <a href="{{ route('admin.profile_activities.profiles.create') }}" class="btn btn-info float-right"><i class="fa fa-plus mr-2"></i> @lang('Add Parliament Member')</a>
                    </h4>
                    <h4 class="card-title w-100">
                        <a href="#" class="btn btn-success float-right mt-2">@lang('Update Information')</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>@lang('Serial')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Constituency')</th>
                                    <th>@lang('Bangladesh No.')</th>
                                    <th>@lang('Ministry')</th>
                                    <th>@lang('Parliament No.')</th>
                                    <th>@lang('Status')</th>
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
                                            {{ $data->name_eng }}
                                            @endif  
                                        </td>
                                        <td>{{ $data['constituency']->name }}</td>
                                        <td>{{ $data['constituency']->number }}</td>
                                        <td>{{ $data['ministryInfo']->name_bn }}</td>
                                        <td>{{ Lang::get($data['parliamentInfo']->parliament_number) }}</td>
                                        <td>{!! activeStatus($data->status) !!}</td>
                                        <td>
                                            <a href="{{ route('admin.profile_activities.profiles.edit',$data->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
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
