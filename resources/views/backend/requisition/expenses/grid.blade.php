<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
        <tr>
            <th width="8%">@lang('Serial')</th>
            <th>@lang('Designation')</th>
            <th>@lang('Monthly Telephone Expenses Including Internet (Taka)')</th>
            <th>@lang('Monthly Telephone Cashing Allowance with Internet (Taka)')</th>
            <!-- <th>@lang('Number of Mobile')</th> -->
            <th>@lang('Status')</th>
            <th width="10%" class="text-center">@lang('Action')</th>
        </tr>
    </thead>
    <tbody>


        @foreach($data as $list)
        <tr>
            <td>{{en2bn($loop->iteration)}}</td>
            <td>
                @foreach(json_decode($list->designition_id) as $desg)
                {{(session()->get('language') =='bn')?App\Model\Designation::find($desg)->name_bn.',':
                    App\Model\Designation::find($desg)->name}}
                @endforeach
            </td>
            <!-- <td>@if($list->building_type == 0)
                @lang('Hostel Building')
                @else
                @lang('SongShod Bhaban')
                @endif
            </td> -->
            <td>{{en2bn($list->telphone_expenses)}}</td>
            <td>{{en2bn($list->cashing_allowance)}}</td>
            <td>{!! activeStatus($list->status) !!}</td>
            <td class="text-center">
                <a class="btn btn-sm btn-success" href="{{route('admin.requisition.telephoneExpensesCashAllowance.edit',$list->id)}}">
                    <i class="fa fa-edit"></i>
                </a>
                <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.requisition.telephoneExpensesCashAllowance.destroy', $list->id)}}">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>