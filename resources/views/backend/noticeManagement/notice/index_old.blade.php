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

@if(auth()->user()->usertype !== 'staff')
<div class="content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form id="noticeSearchForm" class="form-horizontal" action="{{route('admin.notice_management.notices.create')}}" method="get">
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label class="control-label" for="rule_id">@lang('For Create Notice Select the Rule')<span
                                    class="required text-danger">*</span></label>
                            <select id="rule_id" name="rule_id"
                                    class="form-control form-control-sm select2" required>
                                <option value="">@lang('Select Rule')</option>
                                @if(isset($parliamentSession))
                                    @if (isset($allRules) && count($allRules) > 0)
                                        @foreach ($allRules as $data)
                                            @if( $data->id ==old('rule_id'))
                                                <option selected
                                                        value="{{ $data->id }}">{{ $data->name }}</option>
                                            @else
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                            </select>
                        </div>

                        <div class="col-sm-3 mt-1">
                            <button type="submit" class="p-2 btn btn-info btn-sm seachNotice"
                                    style="margin-top:28px">
                                @lang('GO')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

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


                            @if(auth()->user()->usertype == 'staff'
                                and auth()->user()->department_id == $data->parliamentRule->department_id)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->parliamentRule->name }}</td>
                                <td>{{ $data->profileForNoticeFrom->name_bn }}</td>
                                <td>{{ $data->profileForNoticeTo->name_bn ?? '' }}</td>
                                <td>{{ date('d F, Y', strtotime($data->created_at)) }}</td>
                                <td>{!! approvedStatus($data->status) !!}</td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-success" href="{{route('admin.notice_management.notices.show', $data->id)}}">
                                        <i class="fa fa-eye"> View</i>
                                    </a>
                                    @if ((auth()->user()->usertype != 'ps') and (auth()->user()->usertype != 'staff'))
                                    <a class="btn btn-sm btn-info" href="{{route('admin.notice_management.notices.edit', $data->id)}}">
                                        <i class="fa fa-edit"> Edit</i>
                                    </a>
                                    <a class="btn btn-sm btn-danger destroy"
                                       data-route="{{route('admin.notice_management.notices.destroy' , $data->id)}}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                                @elseif(auth()->user()->usertype !== 'staff')
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->parliamentRule->name }}</td>
                                <td>{{ $data->profileForNoticeFrom->name_bn }}</td>
                                <td>{{ $data->profileForNoticeTo->name_bn ?? '' }}</td>
                                <td>{{ date('d F, Y', strtotime($data->created_at)) }}</td>
                                <td>{!! approvedStatus($data->status) !!}</td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-success" href="{{route('admin.notice_management.notices.show', $data->id)}}">
                                        <i class="fa fa-eye"> @lang('View')</i>
                                    </a>
                                    @if ((auth()->user()->usertype != 'ps') and (auth()->user()->usertype != 'staff'))
                                        <a class="btn btn-sm btn-info" href="{{route('admin.notice_management.notices.edit', $data->id)}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger destroy"
                                           data-route="{{route('admin.notice_management.notices.destroy' , $data->id)}}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endif
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


