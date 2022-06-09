<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th>@lang('Serial')</th>
        <th>@lang('Rule Number')</th>
        <th>@lang('Department')</th>
        <th>@lang('Name')</th>
        <th>@lang('Status')</th>
        <th width="15%" class="text-center">@lang('Action')</th>
    </tr>
    </thead>
    <tbody>

    @foreach($data as $list)

        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$list->rule_number}}</td>
            <td>
                @if(session()->get('language') =='bn')
                    {{$list->department->name_bn}}
                @else
                    {{$list->department->name}}
                @endif
            </td>
            <td>{{$list->name}}</td>
            <td>{!! activeStatus($list->status) !!} </td>
            <td class="text-center">
                <a class="btn btn-sm btn-info" href="{{route('admin.notice_management.parliament_rules.show',$list->id)}}">
                    <i class="fa fa-eye"></i> @lang('View')
                </a>
                <a class="btn btn-sm btn-success" href="{{route('admin.notice_management.parliament_rules.edit', $list->id)}}">
                    <i class="fa fa-edit"></i>
                </a>
                <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.notice_management.parliament_rules.destroy', $list->id)}}">
                    <i class="fa fa-trash"></i>
                </a>

            </td>
        </tr>
    @endforeach

    </tbody>
</table>
