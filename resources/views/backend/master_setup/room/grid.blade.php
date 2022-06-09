<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th width="8%">@lang('Serial')</th>
        <th>@lang('Room (Bangla)')</th>
        <th>@lang('Room (English)')</th>
        <th>@lang('Block No')</th>
        <th>@lang('Floor No')</th>
        <th>@lang('Status')</th>
        <th width="10%" class="text-center">@lang('Action')</th>
    </tr>
    </thead>
    <tbody>

    @foreach($data as $list)
        <tr>
            <td>{{en2bn($loop->iteration)}}</td>
            <td>{{ $list->room_bn }}</td>
            <td>{{ $list->room }}</td>
            <td>{{ (session()->get('language') =='bn')?$list->name_bn:$list->name }}</td>
            <td>{{ (session()->get('language') =='bn')?$list->floor_name_bn:$list->floor_name }}</td>
            <td>{!! activeStatus($list->status) !!}</td>
            <td class="text-center">
                <a class="btn btn-sm btn-success" href="{{route('admin.master_setup.songshodRoom.edit',$list->id)}}">
                    <i class="fa fa-edit"></i>
                </a>
                <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.master_setup.songshodRoom.destroy', $list->id)}}">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
