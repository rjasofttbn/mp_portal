<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th width="8%">@lang('Serial')</th>
        <th>@lang('Building Name')</th>
        <th>@lang('Floor Name')</th>
        <th>@lang('Office Number')</th>
        <th>@lang('Office Type')</th>
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
            <td>{{$list->hb_b_name}}</td> 
            <td>{{$list->hf_b_name}}</td> 
            <td>{{$list->ofr_number_bn}}</td>
            <td>{{$list->oft_name_bn}}</td>

            <td>
                {!! activeStatus($list->ofr_status) !!}
            </td>
            <td class="text-center">
                <a class="btn btn-sm btn-success" href="{{route('admin.accommodation-management.setup.office.edit', $list->id)}}">
                     <i class="fa fa-edit"></i>
                </a>
                {{-- <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.accommodation-management.setup.office.destroy', $list->id)}}">
                    <i class="fa fa-trash"></i>
                </a> --}}
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
