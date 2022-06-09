@extends('backend.layouts.app')
@section('content')
<style>
    .select2-selection--single {
        min-width: 150px !important;
        font-size: 20px !important;
    }

    .select2-results__option {
        font-size: 20px !important;
    }
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Notice Management') </h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Notice Management')</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div id="main_content">
    <div class="content">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label class="control-label" for="rule_number">@lang('Select Parliament Session')</label>
                            <select id="parliament_session_id" name="parliament_session_id" class="form-control form-control-sm select2" required>
                                <option value="0">@lang('Select Session No.')</option>
                                @foreach ($parliamentSession as $d)
                                <option value="{{ $d->id }}" data-start="{{date('d/m/Y',strtotime($d->declare_date))}}" data-end="{{date('d/m/Y',strtotime($d->date_to))}}" @if( $d->id == $current_parliament_session) {{'selected="selected"'}} @endif>@php echo Lang::get($d->session_no) @endphp</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label class="control-label" for="rule_number">@lang('Select Date')</label>
                            <input type="text" id="dateRangePicker" readonly class="form-control" />

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>@lang('All Notice')</h4>
                </div>

                <div class="card-body">
                    <!-- Nav tabs -->
                    <div class="text-center" style="margin-bottom:20px;">
                        <strong>@lang('Rule') &raquo; </strong> <input type="hidden" id="item_type" value="pending">
                        <button type="button" class="btn btn-secondary btn-success filter_button" id="rule_0" data-id="0">@lang('All Rules')</button>
                        @foreach($allRules as $r)
                        <button type="button" class="btn btn-secondary filter_button" id="rule_{{$r->rule_number}}" data-id="{{$r->rule_number}}"> @php echo Lang::get('rule_'.$r->rule_number) @endphp </button>
                        @endforeach
                    </div>

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link default_tab active" data-toggle="tab" href="#pending" onClick="load_data('pending')">@lang('Pending')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link default_tab" data-toggle="tab" href="#approved" onClick="load_data('approved')">@lang('Approved')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link default_tab" data-toggle="tab" href="#rejected" onClick="load_data('rejected')">@lang('Rejected')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link default_tab" data-toggle="tab" href="#discussed" onClick="load_data('discussed')">@lang('Discussed')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link default_tab" data-toggle="tab" href="#closed" onClick="load_data('closed')">@lang('Closed')</a>
                        </li>
                        <li class="nav-item acceptance_tab d-none">
                            <a class="nav-link" data-toggle="tab" href="#mins_30" onClick="load_data('mins_30')">@lang('30 Mins')</a>
                        </li>
                        <li class="nav-item acceptance_tab d-none">
                            <a class="nav-link" data-toggle="tab" href="#mins_2" onClick="load_data('mins_2')">@lang('2 Mins')</a>
                        </li>
                        <li class="nav-item rule_78_tab d-none">
                            <a class="nav-link" data-toggle="tab" href="#all_78" onClick="load_data('all_78')">@lang('Bill Amendment List')</a>
                        </li>
                        <li class="nav-item rule_82_tab d-none">
                            <a class="nav-link" data-toggle="tab" href="#all_82" onClick="load_data('all_82')">@lang('Bill Clause Amendment List')</a>
                        </li>
                        <li class="nav-item rule_78_82_tab d-none">
                            <a class="nav-link" data-toggle="tab" href="#speech_attachment" onClick="load_speech()">@lang('Speech Attachment')</a>
                        </li>
                        <li class="nav-item rule_78_82_tab d-none">
                            <a class="nav-link" data-toggle="tab" href="#yes_notice" onClick="load_data('yes_notice')">@lang('Yes Notice')</a>
                        </li>
                        <li class="nav-item rule_78_82_tab d-none">
                            <a class="nav-link" data-toggle="tab" href="#no_notice" onClick="load_data('no_notice')">@lang('No Notice')</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane container active" id="pending">

                            <table id="pending_table" class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>@lang('Details')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                        <div class="tab-pane container fade" id="approved">
                            <table id="approved_table" class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>@lang('Details')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane container fade" id="rejected">
                            <table id="rejected_table" class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>@lang('Details')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane container fade" id="discussed">
                            <table id="discussed_table" class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>@lang('Details')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane container fade" id="closed">
                            <table id="closed_table" class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>@lang('Details')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane container fade" id="mins_30">
                            <table id="mins_30_table" class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>@lang('Details')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane container fade" id="mins_2">
                            <table id="mins_2_table" class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>@lang('Details')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane container fade" id="all_78">
                            <table id="all_78_table" class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>@lang('Details')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane container fade" id="all_82">
                            <table id="all_82_table" class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>@lang('Details')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane container fade" id="yes_notice">
                            <table id="yes_notice_table" class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>@lang('Details')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane container fade" id="no_notice">
                            <table id="no_notice_table" class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>@lang('Details')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane container fade text-center" id="speech_attachment">
                            <div id="speech_content">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="details_content" class="content">

</div>
<script>
    var parliament_session_id = 0;
    var date_range = '';
    var rule_number = 0;
    var acceptance_duration = '';
    var minimum_date = "{{date('d/m/Y',strtotime($start_date))}}";
    var maximum_date = "{{date('d/m/Y',strtotime($end_date))}}";
    var selected_notice = 0;
    var only_ammendment = 0;
    var selected_items = [];

    $(document).ready(function() {
        $('#dateRangePicker').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY',
            },
            startDate: minimum_date,
            endDate: maximum_date,
            minDate: minimum_date,
            maxDate: maximum_date,
            autoclose: true,
        });

        $('.applyBtn').click(function() {
            var notice_type = $('#item_type').val();
            load_data(notice_type);
        });

        $('.filter_button').each(function(index) {
            $(this).on('click', function() {
                rule_number = $(this).data('id');
                $(".filter_button").not($(this)).removeClass('btn-success');
                $(this).addClass('btn-success');
                var notice_type = $('#item_type').val();

                if (rule_number == 78 || rule_number == 82) {
                    if (rule_number == 78) {
                        $(".rule_82_tab").removeClass('block');
                        $(".rule_82_tab").addClass('d-none');
                        $(".rule_78_tab").removeClass('d-none');
                        $(".rule_78_tab").addClass('block');
                        $(".rule_78_82_tab").removeClass('d-none');
                        $(".rule_78_82_tab").addClass('block');
                    }
                    if (rule_number == 82) {
                        $(".rule_78_tab").removeClass('block');
                        $(".rule_78_tab").addClass('d-none');
                        $(".rule_82_tab").removeClass('d-none');
                        $(".rule_82_tab").addClass('block');
                        $(".rule_78_82_tab").removeClass('d-none');
                        $(".rule_78_82_tab").addClass('block');
                    }
                    $(".default_tab").removeClass('block');
                    $(".default_tab").addClass('d-none');
                } else {
                    $(".rule_82_tab").removeClass('block');
                    $(".rule_82_tab").addClass('d-none');
                    $(".rule_78_tab").removeClass('block');
                    $(".rule_78_tab").addClass('d-none');
                    $(".rule_78_82_tab").removeClass('block');
                    $(".rule_78_82_tab").addClass('d-none');
                    $(".default_tab").removeClass('d-none');
                    $(".default_tab").addClass('block');
                }
                if (rule_number != 71 && (notice_type == 'mins_30' || notice_type == 'mins_2')) {
                    $('a.nav-link[href="#pending"]').trigger('click');
                } else {
                    load_data(notice_type);
                }
            });
        });

        $('#parliament_session_id').on('change', function() {
            var notice_type = $('#item_type').val();
            minimum_date = $(this).find(':selected').attr('data-start');
            maximum_date = $(this).find(':selected').attr('data-end');
            console.log(minimum_date, maximum_date);
            $('#dateRangePicker').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY',
                },
                startDate: minimum_date,
                endDate: maximum_date,
                minDate: minimum_date,
                maxDate: maximum_date,
                autoclose: true,
            });

            load_data(notice_type);
        });

        load_data('pending');
        $("[name='my-checkbox']").bootstrapSwitch();
    });

    function removeDuplicateData(data) {
        return [...new Set(data)];
    }


    function load_data(type, yes_no = null) {
        console.log('type = ' + type);
        acceptance_duration = '';
        selected_items = [];
        $('#item_type').val(type);
        var table_id = '';
        var status_id = '5';
        var yes_no = '';

        if (type == 'approved') {
            table_id = 'approved_table';
            status_id = '5';
        } else if (type == 'rejected') {
            table_id = 'rejected_table';
            status_id = '2';
        } else if (type == 'mins_30') {
            table_id = 'mins_30_table';
            status_id = '5';
            acceptance_duration = 30;
        } else if (type == 'mins_2') {
            table_id = 'mins_2_table';
            status_id = '5';
            acceptance_duration = 2;
        } else if (type == 'all_78') {
            table_id = 'all_78_table';
            status_id = '6';
            only_ammendment = 1; // 1 = বিল সংশোধনী
        } else if (type == 'all_82') {
            table_id = 'all_82_table';
            status_id = '6';
            only_ammendment = 2; // 2 = দফা সংশোধনী
        } else if (type == 'yes_notice') {
            table_id = 'yes_notice_table';
            status_id = '6';
            yes_no = 1;
        } else if (type == 'no_notice') {
            table_id = 'no_notice_table';
            status_id = '6';
            yes_no = 0;
        } else if (type == 'discussed') {
            table_id = 'discussed_table';
            status_id = '7';
        }else if (type == 'closed') {
            table_id = 'closed_table';
            status_id = '-1';
        } else {
            table_id = 'pending_table';
            status_id = '3,4,6';
            only_ammendment = 0;
        }

        console.log('table id: #' + table_id);
        console.log("duration: " + acceptance_duration);

        var table = $('#' + table_id).DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: {
                url: "{{ url('admin/notice-management/filtered_notice') }}",
                dataType: "json",
                type: "GET",
                data: {
                    _token: "{{csrf_token()}}",
                    id: status_id+',1',
                    parliament_session_id: $('#parliament_session_id').val(),
                    rule_number: (rule_number > 0) ? rule_number : 0,
                    acceptance_duration: acceptance_duration,
                    only_ammendment: only_ammendment,
                    yes_no: yes_no,
                    date_range: $('#dateRangePicker').val()
                }
            },
            columns: [

                {
                    data: 'details',
                    name: 'Details'
                },

            ],
            rowGroup: {
                dataSrc: 'group'
            }

        });

        //$("[name='my-checkbox']").bootstrapSwitch();

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        $(document).on('click', '.select_data', function() {
            if (this.checked == false) {
                if (selected_items.indexOf($(this).data('id')) > -1) {
                    selected_items.splice(selected_items.indexOf($(this).data('id')), 1);
                }
            } else {
                selected_items.push($(this).data('id'));
            }
            console.log(removeDuplicateData(selected_items));

            if ($("input[type='checkbox']:checked").length > 0 && selected_items.length > 0) {
                $(".approval_button").removeClass('d-none');
                $(".approval_button").addClass('block');
            } else {
                $(".approval_button").removeClass('block');
                $(".approval_button").addClass('d-none');
            }
        });

        $(document).on('click', '.select_discussed_data', function() {
            if (this.checked == false) {
                if (selected_items.indexOf($(this).data('id')) > -1) {
                    selected_items.splice(selected_items.indexOf($(this).data('id')), 1);
                }
            } else {
                selected_items.push($(this).data('id'));
            }
            console.log(removeDuplicateData(selected_items));

            if ($("input[type='checkbox']:checked").length > 0 && selected_items.length > 0) {
                $(".discussed_button").removeClass('d-none');
                $(".discussed_button").addClass('block');
            } else {
                $(".discussed_button").removeClass('block');
                $(".discussed_button").addClass('d-none');
            }
        });

        $(document).on('click', '.check_datewise_notice', function() {
            var datewise_array = [];
            //selected_items = [];
            var current_date = $(this).data('date');

            $('.item_date_' + current_date).prop('checked', this.checked);

            $('.item_date_' + current_date).each(function() {
                if (this.checked) {
                    selected_items.push($(this).data('id'));
                } else {
                    if (selected_items.indexOf($(this).data('id')) > -1) {
                        selected_items.splice(selected_items.indexOf($(this).data('id')), 1);
                    }
                }
            });

            console.log('merged array', removeDuplicateData(selected_items));

            var atLeastOneIsChecked = false;
            $('.select_data').each(function() {
                if ($(this).is(':checked')) {
                    atLeastOneIsChecked = true;
                    return false;
                }
            });
            if (atLeastOneIsChecked) {
                $(".approval_button").removeClass('d-none');
                $(".approval_button").addClass('block');
            } else {
                $(".approval_button").removeClass('block');
                $(".approval_button").addClass('d-none');
            }
        });

        $(document).on('click', '.check_datewise_submitted_notice', function() {
            var datewise_array = [];
            //selected_items = [];
            var current_date = $(this).data('date');

            $('.submitted_date_' + current_date).prop('checked', this.checked);

            $('.submitted_date_' + current_date).each(function() {
                if (this.checked) {
                    selected_items.push($(this).data('id'));
                } else {
                    if (selected_items.indexOf($(this).data('id')) > -1) {
                        selected_items.splice(selected_items.indexOf($(this).data('id')), 1);
                    }
                }
            });

            console.log('merged array', removeDuplicateData(selected_items));

            var atLeastOneIsChecked = false;
            $('.select_discussed_data').each(function() {
                if ($(this).is(':checked')) {
                    atLeastOneIsChecked = true;
                    return false;
                }
            });
            if (atLeastOneIsChecked) {
                $(".discussed_button").removeClass('d-none');
                $(".discussed_button").addClass('block');
            } else {
                $(".discussed_button").removeClass('block');
                $(".discussed_button").addClass('d-none');
            }
        });

    }

    function view_data(id) {
        $('#main_content').hide();
        $('#details_content').show();
        $('#details_content').html('<center><img src="{{asset("public/images/lottery.gif")}}"></center>');
        $.ajax({
            url: "{{url('admin/notice-management/notice_details/')}}/view/" + id,
            type: "GET",
            data: {
                _token: "{{csrf_token()}}",
                id: id
            },
            success: function(response) {
                //show details div
                $('#details_content').html(response);
            },
            error: function() {
                Swal.fire('তথ্য খুঁজে পাচ্ছি না', '', 'error');
                $('#main_content').show();
                $('#details_content').hide();
            }
        });
    }

    function load_speech() {
        $('#speech_content').html('<center><img src="{{asset("public/images/lottery.gif")}}"></center>');
        $.ajax({
            url: "{{url('admin/notice-management/notices/notice/load_speech')}}",
            type: "GET",
            data: {
                _token: "{{csrf_token()}}",
                parliament_session_id: $('#parliament_session_id').val()
            },
            success: function(response) {
                $('#speech_content').html(response);
            },
            error: function() {
                $('#speech_content').html('তথ্য খুঁজে পাচ্ছি না');
            }
        });
    }

    function go_back() {
        $('#main_content').show();
        $('#details_content').hide();
    }

    function show_speech_settings(id, duration) {
        /* $('#speech_yes').removeClass('btn-success');
        $('#speech_yes').addClass('btn-secondary');
        $('#speech_no').removeClass('btn-danger');
        $('#speech_no').addClass('btn-secondary'); */
        $.ajax({
            url: "{{url('admin/notice-management/notice_details/')}}/single/" + id,
            type: "GET",
            data: {
                _token: "{{csrf_token()}}",
                id: id
            },
            success: function(response) {
                //show details div
                console.log(response.notices);
                selected_notice = response.notices.id;
                $("#speech_duration").val(response.notices.acceptance_duration);
                $("#speech_duration").trigger('change');

                /* if (response.notices.yes_no_vote == 1) {
                    $('#speech_yes').removeClass('btn-secondary');
                    $('#speech_yes').addClass('btn-success');
                } else if (response.notices.yes_no_vote == 0) {
                    $('#speech_no').removeClass('btn-secondary');
                    $('#speech_no').addClass('btn-danger');
                } else {
                    $('#speech_no').removeClass('btn-danger');
                    $('#speech_no').addClass('btn-secondary');
                    $('#speech_yes').removeClass('btn-success');
                    $('#speech_yes').addClass('btn-secondary');
                } */

                $("#speechModal").modal('show');
            },
            error: function() {
                Swal.fire('তথ্য খুঁজে পাচ্ছি না', '', 'error');
            }
        });

    }

    function confirm_speech_duration(notice_id = 0, yes_no = 0, duration = null) {
        console.log(notice_id, yes_no, duration);
        Swal.fire({
            title: 'আপনি কি নিশ্চিত?',
            //text: "এই নোটিশটি সংসদে আলোচনা হবে!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '@lang("Yes")',
            cancelButtonText: '@lang("No")'
        }).then((result) => {
            if (result.value) {
                var url = "{{url('/admin/notice-management/notices/notice/setdata')}}";
                var _token = "{{csrf_token()}}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: _token,
                        type: 'yes_no',
                        id: (notice_id == 0) ? selected_notice : notice_id,
                        yes_no_vote: yes_no,
                        acceptance_duration: (notice_id == 0) ? $("#speech_duration").val() : 0
                    },
                    success: function(response) {
                        if (response == 1) {
                            $("#speechModal").modal('hide');
                            load_data($("#item_type").val());
                        } else {
                            Swal.fire('Status Can not be set', '', 'error');
                        }
                    }
                });
            } else {
                //Swal.fire('Your data is safe', '', 'success');
            }
        })
    }

    /* change status from speaker */
    function giveMassApproval(item, rule_number = null) {

        var acceptance_duration_limit = (rule_number == 71) ? 2 : 0;

        Swal.fire({
            title: 'আপনি কি নিশ্চিত?',
            //text: "এই নোটিশটি সংসদে আলোচনা হবে!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '@lang("Yes")',
            cancelButtonText: '@lang("No")'
        }).then((result) => {
            if (result.value) {
                var url = "{{url('/admin/notice-management/notices/notice/setdata')}}";
                var _token = "{{csrf_token()}}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: _token,
                        type: 'approval',
                        id: selected_items,
                        approval_status: item,
                        acceptance_duration: acceptance_duration_limit
                    },
                    success: function(response) {
                        if (response == 1) {
                            Swal.fire({
                                title: (item == 5) ? 'এই নোটিশগুলো অনুমোদিত' : 'এই নোটিশগুলো প্রত্যাখ্যাত',
                                //text: "এই নোটিশটি সংসদে আলোচনা হবে!",
                                type: 'success'
                            }).then((result) => {
                                load_data($("#item_type").val());
                            });
                        } else {
                            Swal.fire('Status Can not be set', '', 'error');
                        }
                    }
                });
            } else {
                //Swal.fire('Your data is safe', '', 'success');
            }
        })

    }

    function giveMassDiscussed(item, rule_number = null) {

        Swal.fire({
            title: 'আপনি কি নিশ্চিত?',
            //text: "এই নোটিশটি সংসদে আলোচনা হবে!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '@lang("Yes")',
            cancelButtonText: '@lang("No")'
        }).then((result) => {
            if (result.value) {
                var url = "{{url('/admin/notice-management/notices/notice/setdata')}}";
                var _token = "{{csrf_token()}}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: _token,
                        type: 'discussed',
                        id: removeDuplicateData(selected_items),
                        status: item
                    },
                    success: function(response) {
                        if (response == 1) {
                            Swal.fire({
                                title: (item == 7) ? 'এই নোটিশগুলো আলোচিত হয়েছে' : 'এই নোটিশগুলো তামাদি',
                                //text: "এই নোটিশটি সংসদে আলোচনা হবে!",
                                type: 'success'
                            }).then((result) => {
                                load_data($("#item_type").val());
                            });
                        } else {
                            Swal.fire('Status Can not be set', '', 'error');
                        }
                    }
                });
            } else {
                //Swal.fire('Your data is safe', '', 'success');
            }
        })

    }
</script>

<!-- The Modal -->
<div class="modal" id="speechModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">@lang('Duration')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div id="speech_content">
                    <form method="POST" enctype="multipart/form-data" id="set_speech_time" action="javascript:void(0)">
                        <div class="form-group row">

                        </div>
                        <div class="row" style="font-size:2em;">
                            <div class="col-12 text-center" style="margin-bottom:20px; font-size: 14px;">
                                <!--  <label class="control-label col-3" for="speech_duration">@lang('Duration')</label> -->
                                <select id="speech_duration" name="speech_duration" class="form-control form-control-sm select2" required style="min-width: 100px;">
                                    @php for($i=1; $i<=30; $i+=0.50) { if($i<10){ if(is_float($i)){ $i='0' .$i; $min_string='00:' .str_replace(array('.5','.'),array('.30',':'),$i); } else{ $i='0' .$i; $min_string='00:' .str_replace(array('.5','.'),array('.30',':'),$i).':00'; } } else{ if(is_float($i)){ $min_string='00:' .str_replace(array('.5','.'),array('.30',':'),$i); } else{ $min_string='00:' .str_replace(array('.5','.'),array('.30',':'),$i).':00'; } } @endphp <option value="{{str_replace('.5','.30',$i)}}">{{$min_string}}</option>
                                        @php } @endphp
                                </select> @lang('Minutes')
                            </div>
                        </div>
                        <!-- <div class="row" style="font-size:2em;">
                            <div class="col-12 text-center" style="margin-bottom:20px;">
                                <label class="control-label col-3" for="speech_duration">@lang('Duration')</label>
                                <select id="speech_duration" name="speech_duration" class="form-control form-control-sm select2" required>
                                    @php for($i=1; $i<=30; $i+=0.50) { @endphp <option value="{{str_replace('.5','.3',$i)}}">00:{{str_replace(array('.5','.'), array('.30',':'),$i)}}</option>
                                        @php } @endphp
                                </select> @lang('Minutes')
                            </div>
                        </div> -->
                    </form>
                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-danger float-left" data-dismiss="modal">@lang('Close')</button> -->
                <button type="button" class="btn btn-info float-right" onClick="confirm_speech_duration()">@lang('Confirm')</button>
            </div>

        </div>
    </div>
</div>
<script src="{{ asset('public/backend') }}/js/bootstrap-switch.js"></script>
@endsection