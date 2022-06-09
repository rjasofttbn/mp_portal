@extends('backend.layouts.app')
@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h4 class="m-0 text-dark">@lang('User Role')</h4>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
					<li class="breadcrumb-item active">@lang('User Role')</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header text-right">
						<a href="{{route('admin.user-management.role-info.add') }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> @lang('Add User Role')</a>
					</div>
					<div class="card-body">
						<table id="dataTable" class="table table-sm table-bordered table-striped">
							<thead>
								<tr>
									<th width="5%">@lang('Serial')</th>
									<th>@lang('Name (Bangla)')</th>
									<th>@lang('Name (English)')</th>
									<th width="30%">@lang('Functionalities of this Role')</th>
									<th>@lang('OTP Status')</th>
									<th>@lang('Status')</th>
									<th width="10%" class="text-center">@lang('Action')</th>
								</tr>
							</thead>
							<tbody id="sortable" class="sortable">
								@foreach($roles as $list)
								<tr data-id="{{$list->id}}">
									<td>{{ digitDateLang($loop->iteration)}}</td>
									<td>{{ $list->name_bn }}</td>
									<td>{{ $list->name }}</td>
									<td class="text-center">{{ $list->description ?? 'N/A'}}</td>
									<td>{!! OTPStatus($list->mail_status) !!}</td>
									<td>{!! activeStatus($list->status) !!}</td>
									<td class="text-center">
										<a class="btn btn-sm btn-success" href="{{route('admin.user-management.role-info.edit',$list)}}">
											<i class="fa fa-edit"></i>
										</a>
										<a class="btn btn-sm btn-danger destroy" data-route="#">
											<i class="fa fa-trash"></i>
										</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(function(){
		$("#sortable").sortable({
			update:function(event, ui){
				var jsonSortable = [];
				jsonSortable.length = 0;
				$("#sortable tr").each(function (index, value){
					let item = {};
					item.id = $(this).data("id");
					jsonSortable.push(item);
				});

				var jsondata = JSON.stringify(jsonSortable);
				$.ajax({
					url: "{{route('admin.user-management.role-info.sorting')}}",
					type: "get",
					data: {jsondata:jsondata},
					dataType: 'json',
					success: function (data) {
						console.log(data);
					}
				});
			}
		}).disableSelection();
	})
</script>
@endsection