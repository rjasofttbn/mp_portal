<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th>@lang('Serial')</th>
        <th>@lang('Name (Bangla)')</th>
        <th>@lang('Name (English)')</th>
        <th>@lang('Total Floor')</th>
        <th>@lang('Status')</th>
        <th width="80" class="text-center">@lang('Action')</th>
    </tr>
    </thead>
    <tbody>

    @php
        $i=1;
    @endphp

    @foreach($data as $list)
    {{-- {{ dd($list) }} --}}
        <tr>
            <td>{{ Lang::get($loop->iteration) }}</td>
            <td>{{$list->name_bn}}</td>
            <td>{{$list->name}}</td>
            <td>{{$list->total_floor}}</td>
            <td>{!! activeStatus($list->status) !!} </td>
            <td class="text-center">
                <a class="btn btn-sm btn-success" href="{{route('admin.accommodation-management.setup.hostel_buildings.edit',$list->id)}}">
                    <i class="fa fa-edit"></i>
                </a>
                <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.accommodation-management.setup.hostel_buildings.destroy', $list->id)}}">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
