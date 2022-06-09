<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
        <tr>
            <th width="8%">@lang('Serial')</th>
            <th>@lang('Place of Telephone / PABX rights')</th>
            <th>@lang('Designation')</th>
            <th>@lang('Number of Telephone')</th>
            <th>@lang('Number of Mobile')</th>
            <th>@lang('Number of PABX')</th>
            <th>@lang('Status')</th>
            <th width="10%" class="text-center">@lang('Action')</th>
        </tr>
    </thead>
    <tbody>

        @foreach($data as $list)
        <tr>
            <td>{{en2bn($loop->iteration)}}</td>
            <td>{{ (session()->get('language') =='bn')?$list->name_bn:$list->name }}</td>
            <td>@if($list->place_type == 0)
                @lang('Official')
                @else
                @lang('Residential')
                @endif
            </td>
            <td>{{en2bn($list->num_of_telephone)}}</td>
            <td>{{en2bn($list->num_of_mobile)}}</td>
            <td>{{en2bn($list->num_of_pabx)}}</td>
            <td>{!! activeStatus($list->status) !!}</td>
            <td class="text-center">
                <a class="btn btn-sm btn-success" href="{{route('admin.requisition.telephone_pabx_rights.edit',$list->id)}}">
                    <i class="fa fa-edit"></i>
                </a>
                <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.requisition.telephone_pabx_rights.destroy', $list->id)}}">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>