<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th width="8%">@lang('Serial')</th>
        <th>@lang('Parliament No.')</th>
        <th>@lang('Date From')</th>
        <th>@lang('Date To')</th>
        <th>@lang('Status')</th>
        <th width="10%" class="text-center">@lang('Action')</th>
    </tr>
    </thead>
    <tbody>

    @foreach($data as $list)

        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ Lang::get($list->parliament_number) }}</td>
            <td>{{ date('d F, Y', strtotime($list->date_from)) }}</td>
            <td>{{ date('d F, Y', strtotime($list->date_to)) }}</td>
            <td>{!! activeStatus($list->status) !!}</td>
            <td class="text-center">
                <a class="btn btn-sm btn-success" href="{{route('admin.master_setup.parliaments.edit',$list->id)}}">
                    <i class="fa fa-edit"></i>
                </a>
                <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.master_setup.parliaments.destroy', $list->id)}}">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
