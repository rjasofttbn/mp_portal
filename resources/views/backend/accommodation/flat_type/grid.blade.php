<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th width="5%">@lang('Serial')</th>
        <th>@lang('Name (Bangla)')</th>
        <th>@lang('Name (English)')</th>
        <th>@lang('Size')</th>
        <th>@lang('Service Charge')</th>
        <th width="15%" class="text-center">@lang('Action')</th>
    </tr>
    </thead>
    <tbody>           
        @foreach ($data as $value)                                       
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $value->name_bn }} </td>
                <td>{{ $value->name }} </td>
                <td>{{ $value->size }} </td>
                <td>{{  $value->service_charge }}</td>
                <td class="text-center">
                    <a class="btn btn-sm btn-info" href="{{route('admin.accommodation-management.setup.flat_types.edit', $value->id)}}">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a class="btn btn-sm btn-danger destroy"
                    data-route="{{route('admin.accommodation-management.setup.flat_types.destroy' , $value->id)}}">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
</table>
