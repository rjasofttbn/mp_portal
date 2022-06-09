@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Notice Management')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Notice Management')</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


@if (isset($notices) && count($notices) > 0)

<div class="content">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4>@lang('All Notice')</h4>
			</div>

			<div class="card-body">
				<table id="dataTable" class="table table-sm table-bordered table-striped">
					<thead>
					<tr>
						<th width="5%">@lang('Serial')</th>
						<th width="30%">@lang('Subject')</th>
						<th width="15%">@lang('From')</th>
						<th width="15%">@lang('To')</th>
						<th width="13%">@lang('Date')</th>
						<th width="7%">@lang('Status')</th>
						<th width="15%" class="text-center">@lang('Action')</th>
					</tr>
					</thead>
					<tbody>

						@foreach ($notices as $data)
                            
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->rule_name }}</td>
                                <td>{{ $data->from_user_name ?? '' }}</td>
                                <td>{{ $data->to_user_name ?? '' }}</td>
                                <td>{{ date('d F, Y', strtotime($data->created_at)) }}</td>
                                <td>{!! approvedStatus($data->status) !!}</td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-success" href="{{route('admin.notice_management.notices.show', $data->id)}}">
                                        <i class="fa fa-eye"> </i>
                                    </a>
                                    @if (auth()->user()->usertype == 'mp' and $data->notice_from==auth()->user()->id and $data->status==0)
                                    <a class="btn btn-sm btn-info" href="{{route('admin.notice_management.notices.edit', $data->id)}}">
                                        <i class="fa fa-edit"> </i>
                                    </a>
                                    <a class="btn btn-sm btn-danger destroy"
                                       data-route="{{route('admin.notice_management.notices.destroy' , $data->id)}}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                                
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    @else
    <div class="content">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Notice</h4>
                </div>
                <div class="card-body">
                    <table id="dataTable" class="table table-sm table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>@lang('Serial')</th>
                            <th>@lang('Subject')</th>
                            <th>@lang('From')</th>
                            <th>@lang('To')</th>
                            <th>@lang('Date')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr> <td colspan="7" class="text-center">@lang('Notice is not available !')</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif



    @endsection


