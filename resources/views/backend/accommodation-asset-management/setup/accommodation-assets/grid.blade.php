<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th width="8%">@lang('Serial')</th>
        <th>@lang('Accommodation Type')</th>
        <th>@lang('Furniture/Goods Type')</th>
        <th>@lang('Furniture/Goods Name (Bangla)')</th>
        <th>@lang('Furniture/Goods Name (English)')</th>
        <th width="10%">@lang('Status')</th>
        <th width="10%" class="text-center">@lang('Action')</th>
    </tr>
    </thead>
    <tbody>

    @php
        $i=1;
    @endphp

    @foreach($data as $list)

        <tr>
            <td>{{ Lang::get($loop->iteration) }}</td>
            <td>{{$list->at_bn}}</td>
            <td>{{$list->ast_bn}}</td>
            <td>{{$list->name_bn}}</td>
            <td>{{$list->name}}</td>
            <td>
                {!! activeStatus($list->status) !!}
            </td>
            <td class="text-center">
                <a class="btn btn-sm btn-success" href="{{route('admin.accommodation-asset-management.setup.accommodation_assets.edit', $list->id)}}">
                     <i class="fa fa-edit"></i>
                </a>
                <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.accommodation-asset-management.setup.accommodation_assets.destroy', $list->id)}}">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
