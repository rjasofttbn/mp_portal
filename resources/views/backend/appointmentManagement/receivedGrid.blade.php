<div class="row">
    <h4 class="col-md-12">
        @lang('Appointment Received List')
    </h4>
</div>
<div class="row">
    <div class="col-md-4">

        <div class="form-group">
            <label>@lang('Select Date'):</label>
            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                <input type="text" id="search_date" class="form-control datetimepicker-input" name="search_date"
                    value="{{ $date }}" placeholder="@lang('Select Date')" autocomplete="off" maxlength="30"
                    data-target="#reservationdate" />
                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2" style="
    bottom: -30px;
">
        <button class="btn btn-success" onclick="searchByDate({{ $listType }})">@lang('Search')</button>
    </div>
    <div class="col-md-6">

    </div>
</div>
<ul class="nav nav-tabs" style="margin:10px">
    <li class="nav-item">
        <a class="nav-link default_tab {{ $listType == 1 ? 'active' : '' }} " data-toggle="tab" href="#pending"
            onClick="load_data('pending')">@lang('New Request')</a>
    </li>
    <li class="nav-item">
        <a class="nav-link default_tab {{ $listType == 2 ? 'active' : '' }}" data-toggle="tab" href="#approved"
            onClick="load_data('approved')">@lang('Approved')</a>
    </li>
    <li class="nav-item">
        <a class="nav-link default_tab {{ $listType == 3 ? 'active' : '' }}" data-toggle="tab" href="#rejected"
            onClick="load_data('rejected')">@lang('Rejected')</a>
    </li>

</ul>
<table id="dataTable" class="table table-sm table-bordered table-striped">
    <thead>
        <tr>
            <th width="5%">@lang('Serial')</th>
            <th width="12%">@lang('Appointment Date')</th>
            <th width="18%">@lang('Appointment With')</th>
            <th width="20%">@lang('Appointment Time')</th>
            @if ($listType == 2)
                <th width="20%">@lang('Given Time')- @lang('Place')</th>
            @endif
            @if ($listType == 1)
                <th width="20%">@lang('Purpose of Appointment') - @lang('Place')</th>
            @endif
            <th width="10%">@lang('Status')</th>
            @if ($listType != 3)
                <th width="15%" class="text-center">@lang('Action')</th>
            @endif
        </tr>
    </thead>
    <tbody>

        @php
            $i = 1;
        @endphp

        @foreach ($data as $list)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $list->date }}</td>
                <td>
                    @if (session()->get('language') == 'bn')
                        {{ userIdToProfileInfo($list->created_by)->name_bn }}
                    @else
                        {{ userIdToProfileInfo($list->created_by)->name_eng }}
                    @endif
                </td>
                <td>{{ $list->time_from }} to {{ $list->time_to }}</td>
                @if ($listType == 2)
                    <td>{{ $list->new_date }}<br />{{ $list->new_time_from }} to {{ $list->new_time_to }}
                        <br /> {{ $list->new_place }}
                    </td>
                @endif
                @if ($listType == 1)
                    <td>{{ $list->topics }} - {{ $list->place }}</td>
                @endif
                <td>
                    @if ($list->status == 0)
                        @lang('Pending')
                    @elseif($list->status==1)
                        @lang('Approved')
                    @elseif($list->status==2)
                        @lang('Declined')
                    @endif
                </td>
                @if ($listType != 3)
                    <td class="text-center">
                        @if ($list->status == 1 && $list->updated_by != null && $list->updated_by == $list->created_by)
                            <span>@lang('Accepted')</span>
                        @elseif ($list->status == 0 && $list->requested_to === userIdToProfileId())
                            <a class="btn btn-sm btn-success" onClick="acceptModal({{ $list->id }})"
                                href="javascript:void(0)">
                                <i class="fa fa-check"></i>
                            </a>
                            {{-- <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#appointmentAccept">
                                <i class="fa fa-check"></i>
                            </button> --}}
                            <a class="btn btn-sm btn-danger"
                                href="{{ url('appointment-management/appointment-received/declined') }}/{{ $list->id }}">
                                <i class="fa fa-times"></i>
                            </a>

                        @elseif($list->status == 1 && $list->requested_to === userIdToProfileId())
                            <a class="btn btn-sm btn-success" onClick="changeModal({{ $list->id }})"
                                href="javascript:void(0)">
                                @lang('New Time')
                            </a>
                            {{-- <a class="btn btn-sm btn-danger destroy"
                                data-route="{{ route('appointment-management.appointment-received.destroy', $list->id) }}">
                                <i class="fa fa-trash"></i>
                            </a> --}}
                            <a class="btn btn-sm btn-danger"
                                href="{{ url('appointment-management/appointment-received/declined') }}/{{ $list->id }}">
                                <i class="fa fa-times"></i>
                            </a>
                        @endif
                    </td>
                @endif
            </tr>
        @endforeach

    </tbody>
</table>
<script>
    $(function() {
        $('#reservationdate').datetimepicker({
            format: 'DD MMMM, YYYY'
        });
    })

    function searchByDate(type) {
        var search_date = $('#search_date').val();
        if (type == 2) {
            window.location.href = "{{ route('admin.appointment-management.appointment-received.acceptedList') }}/" +
                search_date;
        } else if (type == 3) {
            window.location.href = "{{ route('admin.appointment-management.appointment-received.rejectedList') }}/" +
                search_date;

        } else if (type == 1) {
            window.location.href = "{{ route('admin.appointment-management.appointment-received.index') }}/" +
                search_date;

        }
    }

</script>
