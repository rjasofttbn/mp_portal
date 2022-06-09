<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th>@lang('Serial')</th>
        {{-- <th>@lang('Rule Number')</th>
        <th>@lang('Rule Name')</th> --}}
        <th>@lang('Role Name')</th>
        <th>@lang('Stage Number')</th>
        <th>@lang('Status')</th>
        <th width="15%" class="text-center">@lang('Action')</th>
    </tr>
    </thead>
    <tbody>

    @foreach($stage_list as $list)

        <tr>
            <td>{{ $loop->iteration }}</td>
            {{-- <td>{{digitDateLang($list->rule_number)}}</td>
            <td>{{$list->rule_name}}</td> --}}
            <td>{{$list->user_role_name}}</td>
            <td>{{digitDateLang($list->stage)}}</td>
            <td>{!! activeStatus($list->status) !!} </td>
            <td class="text-center">
                <a class="btn btn-sm btn-success" href="{{route('admin.petition_management.petitionstage.edit', $list->id)}}">
                    <i class="fa fa-edit"></i>
                </a>
                <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.petition_management.petitionstage.destroy', $list->id)}}">
                    <i class="fa fa-trash"></i>
                </a>

            </td>
        </tr>
    @endforeach

    </tbody>
</table>
