<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
        <tr>
            <th width="8%">@lang('Serial')</th>
            <th>@lang('Select the building name')</th>
            <!-- <th>@lang('Designation')</th> -->
            <th>@lang('Number of Telephone')</th>
            <th>@lang('telephone status')</th>
            <!-- <th>@lang('Number of Mobile')</th> -->
            <th>@lang('Number of PABX')</th>
            <th>@lang('pabx status')</th>
            <!-- <th>@lang('Status')</th> -->
            <th width="10%" class="text-center">@lang('Action')</th>
        </tr>
    </thead>
    <tbody>

        @foreach($data as $list)
        <tr>
            <td>{{en2bn($loop->iteration)}}</td>

            <td>@if($list->building_type == 0)
                @lang('Hostel Building')
                @else
                @lang('SongShod Bhaban')
                @endif
            </td>
            <td>{{en2bn($list->num_of_telephone)}}</td>
            <td>{!! activeStatus($list->status_telephone) !!}</td>
            <!-- <td>{{en2bn($list->num_of_mobile)}}</td> -->
            <td>{{en2bn($list->num_of_pabx)}}</td>
            <td>{!! activeStatus($list->status_pabx) !!}</td>
            <!-- <td>{!! activeStatus($list->status) !!}</td> -->
            <td class="text-center">
                <a class="btn btn-sm btn-success" href="{{route('admin.requisition.office_wise_telephone_pabx.edit',$list->id)}}">
                    <i class="fa fa-edit"></i>
                </a>
                <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.requisition.office_wise_telephone_pabx.destroy', $list->id)}}">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>