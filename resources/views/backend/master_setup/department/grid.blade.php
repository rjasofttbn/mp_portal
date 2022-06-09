<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th width="8%">@lang('Serial')</th>
        <th>@lang('Name (Bangla)')</th>
        <th>@lang('Name (English)')</th>
        <th width="10%">@lang('Status')</th>
        <th width="10%" class="text-center">@lang('Action')</th>
    </tr>
    </thead>
    <tbody>

    @foreach($departments as $data)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$data->name_bn}}</td>
            <td>{{$data->name}}</td>
            <td>
                {!! activeStatus($data->status) !!}
            </td>
            <td class="text-center">
                <a class="btn btn-sm btn-success" href="{{route('admin.master_setup.departments.edit',$data->id)}}">
                    <i class="fa fa-edit"></i>
                </a>
                <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.master_setup.departments.destroy', $data->id)}}">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
