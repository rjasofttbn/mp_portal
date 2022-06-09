@extends('backend.petitionManagement.layouts.app')
<style>
    .focusedInput {
        border-color: rgb(247 60 60) !important;
        outline: 0;
        outline: thin dotted \9;
        -moz-box-shadow: 0 0 3px rgba(255, 0, 0);
        box-shadow: 0 0 3px rgba(255, 0, 0) !important;
    }

</style>
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container text-center">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h4 class="my-3 text-dark">@lang('Apply for Appointment')</h4>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <div class="container">
        <div class="col-md-12">
            <div class="card p-5">

                <form method="POST" enctype="multipart/form-data" id="appointmentCreateForm" class="form-horizontal mt-3"
                    action="javascript:void(0)">
                    <div id="1st_step">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- radio -->
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary2" value="1" name="type" checked>
                                        <label for="radioPrimary2">
                                            @lang('Minister')
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary3" value="2" name="type"
                                            {{ $data->type == 2 ? 'checked' : '' }}>
                                        <label for="radioPrimary3">
                                            @lang('MP')
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6" id="ministry">
                                <div class="form-group">
                                    <label class="control-label" for="ministry_id">@lang('Ministry')<span
                                            style="color: red;"> *</span></label>
                                    <select id="ministry_id" required name="ministry_id"
                                        class="form-control select2 @error('ministry_id') is-invalid @enderror">
                                        <option value="">@lang('Select Ministry')</option>
                                        @foreach ($ministry_list as $list)
                                            <option value="{{ $list->id }}"
                                                {{ $data->ministry_id == $list->id ? 'selected' : '' }}>
                                                @if (session()->get('language') == 'bn')
                                                    {{ $list['name_bn'] }}
                                                @else
                                                    {{ $list['name'] }}
                                                @endif
                                            </option>

                                        @endforeach
                                    </select>

                                    @error('ministry_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6" id="mp_list">
                                <div class="form-group">
                                    <div id="ajax_mp_list">
                                    </div>

                                    @error('requested_to')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="date">@lang('Date')<span style="color: red;">
                                            *</span></label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" required
                                            class="form-control datetimepicker-input @error('date') is-invalid @enderror"
                                            name="date" value="{{ old('date', $data->date) }}"
                                            placeholder="@lang('Select Date')" id="date" autocomplete="off" maxlength="30"
                                            data-target="#reservationdate" />
                                        <div class="input-group-append" data-target="#reservationdate"
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
                                        <input type="text" required
                                            class="form-control datetimepicker-input @error('time_from') is-invalid @enderror"
                                            name="time_from" id="time_from" value="{{ old('time_from', $data->time_from) }}"
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
                                        <input type="text" required
                                            class="form-control datetimepicker-input @error('time_to') is-invalid @enderror"
                                            name="time_to" id="time_to" value="{{ old('time_to', $data->time_to) }}"
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
                                    <label class="control-label" for="topics">@lang('Purpose of Appointment')<span
                                            style="color: red;"> *</span></label>
                                    <textarea id="topics" required name="topics"
                                        class="textareaWithoutImgVideo form-control @error('topics') is-invalid @enderror">
                                                    {{ old('topics', $data->topics) }}
                                                </textarea>

                                    @error('topics')
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
                                    <input type="text" required id="place" name="place" class="form-control"
                                        placeholder="@lang('Type Place')" />

                                    @error('topics')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label" for="place">@lang('Attachment (if any)')<span
                                            style="color: red;"> *</span></label>
                                    <input type="file" name="files" class="form-control" />

                                    @error('files')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <input type="hidden" name="status" id="status" value="0">
                            <input type="hidden" name="requested_id" id="requested_id"
                                value="{{ old('requested_id', $data->requested_to) }}">

                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                        <a href="{{ route('login') }}">@lang('Back')</a>
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                    <button onclick="first_step_submit()"
                                        class="btn btn-success btn-sm">@lang('Submit')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="2nd_step">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label class="control-label" for="applicant_name">@lang('আপনার নাম') <span
                                            class="text-danger"> *</span></label>

                                    <div class="input-group">
                                        <input type="text" required
                                            class="form-control formOnInput @error('applicant_name') is-invalid @enderror"
                                            name="applicant_name" id="applicant_name" value="{{ old('applicant_name') }}"
                                            placeholder="@lang('আপনার নাম লিখুন')" />

                                    </div>

                                    @error('applicant_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label class="control-label" for="father_name">@lang('পিতার নাম') <span
                                            class="text-danger"> *</span></label>

                                    <div class="input-group">
                                        <input type="text" required
                                            class="form-control formOnInput @error('father_name') is-invalid @enderror"
                                            name="father_name" id="father_name"
                                            value="{{ old('father_name') }}"
                                            placeholder="@lang('পিতার  নাম লিখুন')" />

                                    </div>

                                    @error('father_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label class="control-label" for="mother_name">@lang('মাতার নাম') <span
                                            class="text-danger"> *</span></label>

                                    <div class="input-group">
                                        <input type="text" required
                                            class="form-control formOnInput @error('mother_name') is-invalid @enderror"
                                            name="mother_name" id="mother_name"
                                            value="{{ old('mother_name') }}"
                                            placeholder="@lang('মাতার নাম লিখুন')" />

                                    </div>

                                    @error('mother_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label class="control-label" for="nid_num">@lang('সিটিজেন এন আই ডি নম্বর') <span
                                            class="text-danger"> *</span></label>

                                    <div class="input-group">
                                        <input type="text" required
                                            class="form-control formOnInput @error('nid_num') is-invalid @enderror"
                                            name="nid_num" id="nid_num" value="{{ old('nid_num') }}"
                                            placeholder="@lang('সিটিজেন এন আই ডি নম্বর লিখুন')" />

                                    </div>

                                    @error('nid_num')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label class="control-label" for="mobile_num">@lang('মোবাইল নম্বর ') <span
                                            class="text-danger"> *</span></label>

                                    <div class="input-group">
                                        <input type="text" required
                                            class="form-control formOnInput @error('mobile_num') is-invalid @enderror"
                                            name="mobile_num" id="mobile_num"
                                            value="{{ old('mobile_num') }}"
                                            placeholder="@lang('মোবাইল নম্বর  লিখুন')" />

                                    </div>

                                    @error('mobile_num')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label class="control-label" for="email">@lang('ইমেইল নাম') <span
                                            class="text-danger"> *</span></label>

                                    <div class="input-group">
                                        <input type="text" required
                                            class="form-control formOnInput @error('email') is-invalid @enderror"
                                            name="email" id="email"
                                            value="{{ old('email') }}"
                                            placeholder="@lang('ইমেইল লিখুন')" />

                                    </div>

                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="control-label" for="c_address">@lang('বর্তমান ঠিকানা') <span
                                            class="text-danger"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" required
                                            class="form-control formOnInput @error('c_address') is-invalid @enderror"
                                            name="c_address" id="c_address"
                                            value="{{ old('c_address') }}"
                                            placeholder="@lang('বর্তমান ঠিকানা লিখুন ')" />
                                        @error('c_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="control-label" for="p_address">@lang('স্থায়ী ঠিকানা') <span
                                            class="text-danger"> *</span></label>
                                    <div class="input-group">
                                        <input type="text" required
                                            class="form-control formOnInput @error('p_address') is-invalid @enderror"
                                            name="p_address" id="p_address"
                                            value="{{ old('p_address') }}"
                                            placeholder="@lang('স্থায়ী ঠিকানা লিখুন ')" />
                                        @error('p_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="applicant">
                            <div class="row mb-3">
                                <div class="col-sm-11 ml-2 p-3" style="background: #f7f7f7">
                                    <label class="control-label" for="place">@lang('Attachment (if any)')<span
                                            style="color: red;"> *</span></label>
                                    <input type="file" name="files" class="form-control" />
                                </div>
                                <div class="col-sm-1" style="display: contents;">
                                    <button type="button" class="btn btn-success addApplicant  btn-lg"> <i
                                            class="fa fa-plus"> </i> </button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                        <a href="{{ route('login') }}">@lang('Back')</a>
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                    <button onclick="second_step_submit()"
                                        class="btn btn-success btn-sm">@lang('Submit')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="petitionModal" tabindex="-1" role="dialog"
                        aria-labelledby="petitionModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div id="modalBtn" class="modal-content">
                                <div class="modal-header">
                                    {{-- <h5 class="modal-title" id="petitionModalLabel">আবেদনকারীর</h5> --}}
                                    <h5 class="modal-title d-none" id="otpModalLabel">আপনার প্রদত্ত মোবাইল নম্বরে প্রেরিত ও
                                        টি পি নির্ধারিত সময়ের মধ্যে দিন</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="input-group contactInfo">
                                            <input type="text"
                                                class="form-control formOnInput @error('applicant_nid') is-invalid @enderror"
                                                name="applicant_nid" id="applicant_nid"
                                                value="{{ old('applicant_nid') }}"
                                                placeholder="@lang('এন আই ডি নম্বর লিখুন')" />

                                        </div>
                                        @error('applicant_nid')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group contactInfo">
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control formOnInput @error('applicant_mobile') is-invalid @enderror"
                                                name="applicant_mobile" id="applicant_mobile"
                                                value="{{ old('applicant_mobile') }}"
                                                placeholder="@lang('মোবাইল নম্বর লিখুন')" />

                                        </div>
                                        @error('applicant_mobile')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group contactInfo">
                                        <div class="input-group">
                                            <input type="email"
                                                class="form-control formOnInput @error('applicant_email') is-invalid @enderror"
                                                name="applicant_email" id="applicant_email"
                                                value="{{ old('applicant_email') }}"
                                                placeholder="@lang('ইমেইল লিখুন')" />

                                        </div>
                                        @error('applicant_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group otpInfo d-none">
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control formOnInput @error('otp_number') is-invalid @enderror"
                                                name="otp_number" id="otp_number" value="{{ old('otp_number') }}"
                                                placeholder="@lang('ও টি পি লিখুন ')" />

                                        </div>
                                        @error('otp_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group otpView d-none">

                                        <button type="button" id="otpViewBtn" class="btn btn-success">@lang('View
                                            OTP')</button>

                                        <div style="float: right;
                                                    font-weight: 700;
                                                    border: 1px solid;
                                                    padding: 5px 15px;" id="otpView"></div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="backBtn" class="btn btn-dark d-none">@lang('পিছনে')</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('বাতিল
                                        করুন')</button>
                                    <button type="button" id="submitBtn" class="btn btn-success">@lang('পরবর্তী
                                        ধাপ')</button>


                                    <button type="submit" id="finalSubmitBtn" class="btn btn-success d-none">@lang('জমা
                                        দিন')</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Modal -->
                </form>
            </div>
        </div>
    </div>

    <script>
        function first_step_submit() {
            var type = $("input[name=type]").val();
            var date = $('#date').val();
            var time_from = $('#time_from').val();
            var time_to = $('#time_to').val();
            var place = $('#place').val();
            if(type != '' && date != '' && time_from != '' && time_to != '' && place != ''){
                $('#2nd_step').show();
                $('#1st_step').hide();
            }
        }
        function second_step_submit() {
            var applicant_name = $("#applicant_name").val();
            var father_name = $('#father_name').val();
            var mother_name = $('#mother_name').val();
            var nid_num = $('#nid_num').val();
            var email = $('#email').val();
            
            var mobile_num = $('#mobile_num').val();
            var c_address = $('#c_address').val();
            var p_address = $('#p_address').val();

            if(applicant_name != '' && father_name != '' && mother_name != '' 
            && nid_num != '' && email != '' && mobile_num != '' && c_address != '' && p_address != ''){
                $('#petitionModal').modal('show');
            }
        }
        $(function() {
            $('#2nd_step').hide();
            $('.preload').show();
            setTimeout(() => {
                $('.preload').hide();
            }, 1000);
            $('#mp_list').hide();
            $('#reservationdate').datetimepicker({
                format: 'DD MMMM, YYYY'
            });
            $('#reservationtimefrom').datetimepicker({
                format: 'hh:mm A'
            });
            $('#reservationtimeto').datetimepicker({
                format: 'hh:mm A'
            });
            $('#ministry_id').on('change', function() {
                var requested_to = $('#requested_id').val();
                $.ajax({
                    url: "{{ url('/citizen_get_ministry_list') }}",
                    data: {
                        requested_to: requested_to,
                        ministry_id: this.value
                    },
                    type: "get",
                    beforeSend: function() {
                        $('.preload').show();
                    },
                    success: function(data) {
                        $('.preload').hide();
                        $('#mp_list').show();
                        $('#ajax_mp_list').html(data);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        toastr.error(
                            'দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য দেখা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান ', {
                                globalPosition: 'top right',
                                className: 'error',
                                autoHideDelay: 10000
                            });
                        $('.preload').hide();
                    }
                });
            });
            $('input[type=radio][name=type]').change(function() {
                var requested_to = $('#requested_id').val();
                //alert(requested_to)
                if (this.value == '1') {
                    //$('#ajax_mp_list').show();
                    $('#ministry').show();
                    $('#mp_list').show();
                    $.ajax({
                        url: "{{ url('/citizen_get_ministry_list') }}",
                        data: {
                            requested_to: requested_to,
                            ministry_id: $('#ministry_id').val()
                        },
                        type: "get",
                        beforeSend: function() {
                            $('.preload').show();
                        },
                        success: function(data) {
                            $('.preload').hide();
                            $('#ajax_mp_list').html(data);
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            toastr.error(
                                'দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য দেখা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান ', {
                                    globalPosition: 'top right',
                                    className: 'error',
                                    autoHideDelay: 10000
                                });
                            $('.preload').hide();
                        }
                    });
                } else if (this.value == '2') {
                    $('#ajax_mp_list').show();
                    $('#ministry').hide();
                    $('#mp_list').show();
                    $.ajax({
                        url: "{{ url('/citizen_get_mp_list') }}",
                        data: {
                            requested_to: requested_to
                        },
                        type: "get",
                        beforeSend: function() {
                            $('.preload').show();
                        },
                        success: function(data) {
                            $('.preload').hide();
                            $('#ajax_mp_list').html(data);
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            toastr.error(
                                'দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য দেখা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান ', {
                                    globalPosition: 'top right',
                                    className: 'error',
                                    autoHideDelay: 10000
                                });
                            $('.preload').hide();
                        }
                    });
                }
            });
            $('.formOnInput').on('keyup', function() {
                if ($.trim($('.formOnInput').val()).length) {
                    $(this).removeClass('focusedInput');
                }
            });

            $('.formOnSelect').on('change', function() {
                $('.select2-selection').removeClass('focusedInput');
            });

            $('#modalBtn').on('click', function() {
                var applicant_name = $('#applicant_name').val();
                var applicant_designation = $('#applicant_designation').val();
                var applicant_division_id = $('#applicant_division_id').val();
                var applicant_district_id = $('#applicant_district_id').val();
                var applicant_upazila_id = $('#applicant_upazila_id').val();
                var applicant_union = $('#applicant_union').val();
                var description = $('#description').val();
                var prayer = $('#prayer').val();
                var multi_name_0 = $('#multi_name_0').val();
                var signature_0 = $('#signature_0').val();
                var division_id_0 = $('#division_id_0').val();
                var district_id_0 = $('#district_id_0').val();
                var upazila_id_0 = $('#upazila_id_0').val();
                var union_0 = $('#union_0').val();
                var mp_name = $('#mp_name').val();

                if (applicant_name.length == 0) {
                    toastr.error('The Name Field is Required!');
                    $('#applicant_name').addClass('focusedInput');
                } else if (applicant_designation.length == 0) {
                    toastr.error('The Designation Field is Required!');
                    $('#applicant_designation').addClass('focusedInput');
                } else if (applicant_division_id.length == 0) {
                    toastr.error('The Division Field is Required!');
                    $('[aria-labelledby="select2-applicant_division_id-container"]').addClass(
                        'focusedInput');
                } else if (applicant_district_id.length == 0) {
                    toastr.error('The District Field is Required!');
                    $('[aria-labelledby="select2-applicant_district_id-container"]').addClass(
                        'focusedInput');
                } else if (applicant_upazila_id.length == 0) {
                    toastr.error('The Upazila Field is Required!');
                    $('[aria-labelledby="select2-applicant_upazila_id-container"]').addClass(
                        'focusedInput');
                } else if (applicant_union.length == 0) {
                    toastr.error('The Union Field is Required!');
                    $('#applicant_union').addClass('focusedInput');
                } else if (description.length == 0) {
                    toastr.error('The Description Field is Required!');
                    $('#description').addClass('focusedInput');
                } else if (prayer.length == 0) {
                    toastr.error('The Prayer Field is Required!');
                    $('#prayer').addClass('focusedInput');
                } else if (multi_name_0.length == 0) {
                    toastr.error('The Name Field is Required!');
                    $('#multi_name_0').addClass('focusedInput');
                } else if (signature_0.length == 0) {
                    toastr.error('The Signature Field is Required!');
                    $('#signature_0').addClass('focusedInput');
                } else if (division_id_0.length == 0) {
                    toastr.error('The Division Field is Required!');
                    $('[aria-labelledby="select2-division_id_0-container"]').addClass('focusedInput');
                } else if (district_id_0.length == 0) {
                    toastr.error('The District Field is Required!');
                    $('[aria-labelledby="select2-district_id_0-container"]').addClass('focusedInput');
                } else if (upazila_id_0.length == 0) {
                    toastr.error('The Upazila Field is Required!');
                    $('[aria-labelledby="select2-upazila_id_0-container"]').addClass('focusedInput');
                } else if (union_0.length == 0) {
                    toastr.error('The Union Field is Required!');
                    $('#union_0').addClass('focusedInput');
                } else if (mp_name.length == 0) {
                    toastr.error('The Upazila Field is Required!');
                    $('[aria-labelledby="select2-mp_name-container"]').addClass('focusedInput');
                } else {
                    $('#petitionModal').modal('show');
                }

            });

            $('#submitBtn').on('click', function() {

                var applicant_nid = $('#applicant_nid').val();
                var applicant_mobile = $('#applicant_mobile').val();
                var applicant_email = $('#applicant_email').val();

                if (applicant_nid.length == 0) {
                    toastr.error('The NID Field is Required!');
                    $('#applicant_nid').addClass('focusedInput');
                } else if (applicant_mobile.length == 0) {
                    toastr.error('The Mobile Field is Required!');
                    $('#applicant_mobile').addClass('focusedInput');
                } else if (applicant_email.length == 0) {
                    toastr.error('The E-mail Field is Required!');
                    $('#applicant_email').addClass('focusedInput');
                } else if (IsEmail(applicant_email) == false) {
                    toastr.error('Enter valid E-mail!');
                    $('#applicant_email').addClass('focusedInput');
                } else {
                    $.ajax({
                        url: "{{ url('citizenContactInfo') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            applicant_mobile: applicant_mobile
                        }
                    });

                    $(this).addClass('d-none');
                    $('.contactInfo').addClass('d-none');
                    $('#petitionModalLabel').addClass('d-none');

                    $('#otpModalLabel').removeClass('d-none');
                    $('#backBtn').removeClass('d-none');
                    $('#finalSubmitBtn').removeClass('d-none');
                    $('.otpInfo').removeClass('d-none');
                    $('.otpView').removeClass('d-none');
                }
            });

            function IsEmail(email) {
                var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!regex.test(email)) {
                    return false;
                } else {
                    return true;
                }
            }

            $('#backBtn').on('click', function() {
                $('#submitBtn').removeClass('d-none');
                $('#petitionModalLabel').removeClass('d-none');
                $('.contactInfo').removeClass('d-none');
                $('.otpInfo').addClass('d-none');
                $('#backBtn').addClass('d-none');
                $('#finalSubmitBtn').addClass('d-none');
                $('#otpModalLabel').addClass('d-none');
                $('.otpView').addClass('d-none');
            });




            $('#otpViewBtn').on('click', function() {

                var applicant_mobile = $('#applicant_mobile').val();
                $.ajax({
                    url: '{{ url('petitionOtpView') }}',
                    data: {
                        applicant_mobile: applicant_mobile
                    },
                    type: "GET",
                    dataType: "json",

                    success: function(response) {
                        $('#otpView').html(response.data.otp_number)

                    }
                })

            });




            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $('#appointmentCreateForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                        type: 'POST',
                        url: "{{ url('citizenAppointmentInsert') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false
                    })
                    .then(function(response) {
                        if (response == 1) {
                            $('#petitionModal').modal('hide');
                            Swal.fire({
                                text: 'এপয়েন্টমেন্ট অনুরোধ জমা দেওয়ার জন্য আপনাকে ধন্যবাদ। সিস্টেম হতে আবেদনের সর্বশেষ অবস্থা জানতে এন আই ডি নম্বর ও মোবাইল নম্বর ব্যাবহার করুন।',
                                type: 'success'
                            }).then((result) => {
                                location.replace("{{ url('/citizenAppointmentSuccess') }}");
                            });
                        } else {
                            Swal.fire('Error!!!', '', 'error');
                        }
                    })
                    .catch(function(error) {
                        Swal.fire('Error!!!', '', 'error');
                    });
            });


            var incrementValue = 1;

            $('.addApplicant').click(function() {

                incrementValue++;

                var loadMember = ` <div class="row mb-3 applicantRow">
                                            <div class="col-sm-11 ml-2 p-3" style="background: #f7f7f7">
                                                <label class="control-label" for="place">@lang('Attachment (if any)')<span
                                                    style="color: red;"> *</span></label>
                                            <input type="file" name="files" class="form-control" />
                                            </div>
                                            <div class="col-sm-1" style="display: contents;"> <button type="button" class="btn btn-danger removeApplicant btn-lg"> <i class="fa fa-times"> </i> </button></div>
                                        </div>`;

                $('#applicant').append(loadMember);

            });

            //Remove Applicant
            $(document).on("click", ".removeApplicant", function() {
                $(this).closest('.applicantRow').remove();
            });



        });

    </script>

@endsection
