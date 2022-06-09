<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
        <tr>
            <th width="8%">@lang('Serial')</th>
            <th>@lang('Connection Type')</th>
            <th>@lang('Connection Place')</th>
            <!-- <th>@lang('Number of Mobile')</th> -->
            <th>@lang('Status')</th>
            <!-- <th width="10%" class="text-center">@lang('Action')</th> -->
        </tr>
    </thead>
    <tbody>


        @foreach($data as $list)
        <tr>
            <td>{{en2bn($loop->iteration)}}</td>
            <td>@if($list->connection_type == 1)
                @lang('Telephone')
                @else
                @lang('Pabx')
                @endif
            </td>
            <td>@if($list->connection_place == 1)
                @lang('Official')
                @else
                @lang('Residential')
                @endif
            </td>
            <td>@if($list->status == 0)
                @lang('Pending')
                @else
                @lang('Approved')
                @endif
            </td>
            <!-- <td>{{en2bn($list->telphone_expenses)}}</td>
            <td>{{en2bn($list->cashing_allowance)}}</td>
            <td>{!! activeStatus($list->status) !!}</td>
            <td class="text-center">
                <a class="btn btn-sm btn-success" href="{{route('admin.requisition.telephoneExpensesCashAllowance.edit',$list->id)}}">
                    <i class="fa fa-edit"></i>
                </a>
                <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.requisition.telephoneExpensesCashAllowance.destroy', $list->id)}}">
                    <i class="fa fa-trash"></i>
                </a>
            </td> -->
        </tr>
        @endforeach

    </tbody>
</table>