<form id="parliamentForm" name="parliamentForm" method="POST"
    action="{{ route('admin.appointment-management.appointment-received.appointment_accept', $data->id) }}">
    <input name="_method" type="hidden" value="PUT">
    @csrf

    <input type="hidden" id="id" name="id" value="{{ $data->id }}">


    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <!-- Form Start-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="control-label">@lang('Appointment With') :
                                @if (session()->get('language') == 'bn')
                                    {{ $data->requested_by->name_bn }}
                                @else
                                    {{ $data->requested_by->name_eng }}
                                @endif
                            </label>
                        </div>
                        <div class="col-sm-12">
                            <label class="control-label">@lang('Appointment Date') : {{ $data->date }}</label>
                        </div>
                        <div class="col-sm-12">
                            <label class="control-label">@lang('Appointment Time') : {{ $data->time_from }} to
                                {{ $data->time_to }}</label>
                        </div>
                        <div class="col-sm-12">
                            <label class="control-label">@lang('Purpose of Appointment') : {{ $data->topics }}</label>
                        </div>
                        <div class="col-sm-12">
                            <label class="control-label">@lang('Place') : {{ $data->place }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- radio -->
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary1" value="0" name="appointment_change" checked>
                                    <label for="radioPrimary1">
                                        @lang('Appointment Time') - @lang('Place')
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2" value="1" name="appointment_change">
                                    <label for="radioPrimary2">
                                        @lang('New Time') - @lang('Place')
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="new_time">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="date">@lang('Date')<span style="color: red;">
                                        *</span></label>
                                <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                    <input type="text"
                                        class="form-control datetimepicker-input @error('date') is-invalid @enderror"
                                        name="date" value="{{ old('date', $data->date) }}"
                                        placeholder="@lang('Select Date')" autocomplete="off" maxlength="30"
                                        data-target="#reservationdate1" />
                                    <div class="input-group-append" data-target="#reservationdate1"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="time_from">@lang('Time From')<span
                                        style="color: red;"> *</span></label>
                                <div class="input-group date" id="reservationtimefrom" data-target-input="nearest">
                                    <input type="text"
                                        class="form-control datetimepicker-input @error('time_from') is-invalid @enderror"
                                        name="time_from" value="{{ old('time_from', $data->time_from) }}"
                                        placeholder="@lang('Select Time')" autocomplete="off" maxlength="30"
                                        data-target="#reservationtimefrom" />
                                    <div class="input-group-append" data-target="#reservationtimefrom"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                    </div>
                                </div>

                                @error('time_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="time_to">@lang('Time To')<span style="color: red;">
                                        *</span></label>
                                <div class="input-group date" id="reservationtimeto" data-target-input="nearest">
                                    <input type="text"
                                        class="form-control datetimepicker-input @error('time_to') is-invalid @enderror"
                                        name="time_to" value="{{ old('time_to', $data->time_to) }}"
                                        placeholder="@lang('Select Time')" autocomplete="off" maxlength="30"
                                        data-target="#reservationtimeto" />
                                    <div class="input-group-append" data-target="#reservationtimeto"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                    </div>
                                </div>

                                @error('time_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label" for="place">@lang('Place')<span style="color: red;">
                                        *</span></label>
                                <input type="text" id="place" name="place" class="form-control"
                                    value="{{ old('place', $data->place) }}" placeholder="@lang('Type Place')" />

                            </div>
                        </div>
                    </div>
                </div>

                <!--Form End-->
            </div>
        </div>
    </div>
    <div class="pull-right" style="float: right">
        <a class="btn btn-danger"
            href="{{ url('appointment-management/appointment-request/declined') }}/{{ $data->id }}">@lang('Decline')</a>

        <button type="submit" class="btn btn-success">@lang('Save')</button>
    </div>
</form>
<script>
    $(function() {
        $('.preload').show();
        setTimeout(() => {
            $('.preload').hide();
        }, 1000);
        //Date picker
        $('#reservationdate1').datetimepicker({
            format: 'DD MMMM, YYYY'
        });
        $('#reservationtimefrom').datetimepicker({
            format: 'hh:mm A'
        });
        $('#reservationtimeto').datetimepicker({
            format: 'hh:mm A'
        });
    })
    $('input[type=radio][name=appointment_change]').change(function() {
        if (this.value == '1') {
            $('#new_time').show();
        } else {
            $('#new_time').hide();
        }
    })

</script>
