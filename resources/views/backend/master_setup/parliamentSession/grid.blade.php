<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th>@lang('Serial')</th>
        <th>@lang('Parliament No.')</th>
        <th>@lang('Session No.')</th>
        <th>@lang('Declare Date')</th>
        <th>@lang('Date From')</th>
        <th>@lang('Date To')</th>
        <th>@lang('Status')</th>
        <th>@lang('Attachments')</th>
        <th class="text-center">@lang('Action')</th>
    </tr>
    </thead>
    <tbody>

    @foreach($data as $list)

        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{ Lang::get($list->parliament->parliament_number) }}</td>
            <td>{{ Lang::get($list->session_no) }}</td>
            <td>{{ date('d F, Y', strtotime($list->declare_date)) }}</td>
            <td>{{ date('d F, Y', strtotime($list->date_from)) }}</td>
            <td>{{ date('d F, Y', strtotime($list->date_to)) }}</td>
            <td>{!! activeStatus($list->status) !!}</td>
            <td>@php $i = 1; @endphp
                @foreach($attachments as $file)
                    @if($list->id == $file->parliament_session_id)
                    <a class="badge badge-dark text-white d-inline-block float-left mt-2 mr-2" href="{{ asset('public/backend/attachment/'.$file->attachment)  }}" target="_blank"> @lang('File') {{ Lang::get($i) }}@php $i++; @endphp</a> 
                    @endif
                    
                @endforeach
            </td>
            <td class="text-center">
                <a class="btn btn-sm btn-success" href="{{route('admin.master_setup.parliament_sessions.edit',$list->id)}}">
                    <i class="fa fa-edit"></i>
                </a>
                <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.master_setup.parliament_sessions.destroy', $list->id)}}">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
