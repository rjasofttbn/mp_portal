<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
    <tr>
        <th width="5%">@lang('Serial')</th>
        <th width="20%">@lang('Date & Time')</th>
        <th width="20%">@lang('With')</th>
        <th width="30%">@lang('Purpose of Appointment')</th>
        <th width="10%">@lang('Status')</th>
        <th width="15%" class="text-center">@lang('Action')</th>
    </tr>
    </thead>
    <tbody>

    @php
        $i=1;
    @endphp

    @foreach($data as $list)
        @if($list->created_by == Auth::user()->id || $list->created_by !== $list->requested_to)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$list->date}}<br/>{{$list->time_from}} to {{$list->time_to}}</td>
            <td>@if(session()->get('language') =='bn')
                {{$list->profile->name_bn}}
                @else
                {{$list->profile->name_eng}}
                @endif
            </td>
            <td>{{$list->topics}}</td>
            <td>@if($list->status==0)
                    @lang('Pending')
                @elseif($list->status==1)
                    @lang('Approved')
                @elseif($list->status==2)
                    @lang('Declined')
                @endif
            </td>
            <td class="text-center">
                @if($list->status == 0 && $list->created_by !== Auth::user()->id)
                    <a class="btn btn-sm btn-success" href="{{url('admin/profile_activities/appointments/approved')}}/{{ $list->id }}">
                        <i class="fa fa-check"></i>
                    </a>
                    <a class="btn btn-sm btn-danger" href="{{url('admin/profile_activities/appointments/declined')}}/{{ $list->id }}">
                        <i class="fa fa-times"></i>
                    </a>

                @elseif($list->status == 0 && $list->created_by == Auth::user()->id)
                    <a class="btn btn-sm btn-success" href="{{route('admin.profile_activities.appointments.edit',$list->id)}}">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.profile_activities.appointments.destroy', $list->id)}}">
                        <i class="fa fa-trash"></i>
                    </a>
                @endif
            </td>
        </tr>
        @endif
    @endforeach

    </tbody>
</table>
