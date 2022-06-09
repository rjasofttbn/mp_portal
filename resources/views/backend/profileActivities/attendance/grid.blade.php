<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th>@lang('Serial')</th>
        <th>@lang('MP Name')</th>
        <th>@lang('Parliament')</th>
        <th>@lang('Parliament Session')</th>
        <th>@lang('Date')</th>
        <th>@lang('Status')</th>
        <th width="80" class="text-center">@lang('Action')</th>
    </tr>
    </thead>
    <tbody>

    @php
        $i=0;
    @endphp

    @foreach($data as $list)

        <tr>
            <td>{{++$i}}</td>
            <td>{{$list->mp_profile->name_bn}}</td>

            <td>{{ Lang::get($list->parliament->parliament_number) }}</td>
            <td>{{ Lang::get($list->parliamentSession->session_no) }}</td>
            <td>{{ digitDateLang(date('d F, Y', strtotime($list->date))) }}</td>

            <td>{!! activeStatus($list->status) !!}</td>

            <td class="text-center">
               {{-- <a class="btn btn-sm btn-success" href="{{route('attendance.edit',$list->id)}}">
                    <i class="fa fa-edit"></i>
                </a>--}}
                <a class="btn btn-sm btn-danger delete" data-id="{{$list->id}}" data-route="{{route('admin.attendance.delete')}}">

                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
