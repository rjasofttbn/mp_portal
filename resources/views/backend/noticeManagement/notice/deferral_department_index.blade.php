@extends('backend.layouts.app')
@section('content')
<style>
    #lotteryResult {
        background: #deb330;
        border: 4px solid #333;
        border-radius: 10px;
        color: #fff;
        float: left;
        font: 1em arial;
        height: 100%;
        /* margin: 0 10px;
        padding: 2px; */
        text-align: center;
        /* text-shadow: 0 2px 3px #ffbf00; */
        width: 100%;
    }

    .dataTables_length,
    .dt-buttons {
        float: left;
        margin-right: 10px;
    }

    .dt-buttons .dt-button {
        display: inline-block;
        font-weight: 400;
        color: #212529;
        text-align: center;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 1px solid transparent;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: .25rem;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .filter_button_topic {
        padding: 3px !important;
    }
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Notice Management')</h4>
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
                <div class="card-header">
                    <h4>@lang('All Notice')</h4>
                </div>

                <div class="card-body">
                    <div class="rule_container" style="margin-bottom:20px;">
                        <strong>@lang('Rule') &raquo; </strong> <input type="hidden" id="item_type" value="pending">
                        <button type="button" class="btn btn-secondary btn-success filter_button" id="rule_0" data-id="0">@lang('All Rules')</button>
                        @foreach($allRules as $r)
                        <button type="button" class="btn btn-secondary filter_button" id="rule_{{$r->rule_number}}" data-id="{{$r->rule_number}}"> @php echo Lang::get('rule_'.$r->rule_number) @endphp </button>
                        @endforeach
                    </div>
                    <ul class="nav nav-tabs">
                        @if($current_status_ids==6)
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#waiting_submit" onClick="load_data('waiting_submit')">@lang('Not Already Sent')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#waiting_approval" onClick="load_data('waiting_approval')">@lang('Already Sent')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#yes_no_tab" onClick="load_data('yes_no_tab')">@lang('Yes No List')</a>
                        </li>
                        <!--  <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#bill_amendment" onClick="load_data('bill_amendment')">@lang('Bill Amendment List')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#bill_clause_amendment" onClick="load_data('bill_clause_amendment')">@lang('Bill Clause Amendment List')</a>
                        </li> -->
                        @else
                        <li class="nav-item d-none">
                            <a class="nav-link active" data-toggle="tab" href="#other_tables" onClick="load_data('other')">@lang('Others')</a>
                        </li>
                        @endif
                    </ul>
                    @if($topic_list==1)
                    <ul class="nav nav-tabs mt-2 topic_section78 d-none" style="padding: 20px;">

                        <li class="nav-item">
                            <a class="nav-link filter_button_topic btn btn-secondary btn-success mr-1 mb-2 active" data-id="0">@lang('All Notice')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link filter_button_topic btn btn-secondary mr-1 mb-2" data-id="1">@lang('Promoting Bills for Public Opinion')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link filter_button_topic btn btn-secondary mr-1 mb-2" data-id="2">@lang('Sending Bills to the Standing/Assessment Committee')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link filter_button_topic btn btn-secondary mr-1 mb-2" data-id="3">@lang('Adding Names to The Assessment Committee')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link filter_button_topic btn btn-secondary mr-1 mb-2" data-id="4">@lang('Canceling Names from The Assessment Committee')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link filter_button_topic btn btn-secondary mr-1 mb-2" data-id="5">@lang('Exchanging Names in The Assessment Committee')</a>
                        </li>

                    </ul>
                    <ul class="nav nav-tabs mt-2 topic_section82 d-none">
                        <li class="nav-item">
                            <a class="nav-link filter_button_topic btn btn-secondary btn-success mr-1 mb-2 active" data-rule_number="82" data-id="0">@lang('All Notice')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link filter_button_topic btn btn-secondary mr-1 mb-2" data-rule_number="82" data-id="1">@lang('দফার পরিবর্তে দফা সন্নিবেশ')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link filter_button_topic btn btn-secondary mr-1 mb-2" data-rule_number="82" data-id="2">@lang('নতুন দফা সংযোজন')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link filter_button_topic btn btn-secondary mr-1 mb-2" data-rule_number="82" data-id="3">@lang('শর্ত-দফা সংযোজন')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link filter_button_topic btn btn-secondary mr-1 mb-2" data-rule_number="82" data-id="4">@lang('শব্দটি/শব্দাবলী বর্জন')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link filter_button_topic btn btn-secondary mr-1 mb-2" data-rule_number="82" data-id="5">@lang('শব্দাবলী সন্নিবেশ')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link filter_button_topic btn btn-secondary mr-1 mb-2" data-rule_number="82" data-id="5">@lang('প্যারার পরিবর্তে প্যারা সন্নিবেশ')</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link filter_button_topic btn btn-secondary mr-1 mb-2" data-rule_number="82" data-id="5">@lang('শব্দাবলী বর্জন এবং শব্দাবলীর পরিবর্তে নতুন শব্দাবলী সন্নিবেশ')</a>
                        </li>
                    </ul>
                    @endif
                    <div class="tab-content">
                        @if($current_status_ids==6)
                        <div class="tab-pane container active" id="waiting_submit">
                            <table id="waiting_submit_table" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @if($user_type == 'staff' && $notice_priority==0)
                                        <th><input style="width: 24px;" type="checkbox" id="checkAll_waiting_submit" class="form-control"></th>
                                        @endif
                                        <th width="5%">@lang('Serial')</th>
                                        <th width="5%">@lang('RD No.')</th>
                                        <th width="15%">@lang('MP')</th>
                                        <th width="30%">@lang('Subject')</th>
                                        <th width="13%">@lang('Date')</th>
                                        <th width="13%">@lang('Comments')</th>
                                        <th width="7%">@lang('Status')</th>
                                        <th width="15%" class="text-center">@lang('Action')</th>
                                    </tr>
                                </thead>

                            </table>
                            <p style="text-align:center;">
                                @if($user_type=='staff' && $current_status_ids==6)
                                <a class="btn btn-sm btn-info" data-route="{{url('/admin/notice-management/notices/notice/setdata')}}" id="setStatus">
                                    <i class="fa fa-list"> </i> @lang('Confirm')
                                </a> &nbsp;
                                <a class="btn btn-sm btn-info d-none" id="speech_button" onClick="add_speech()">
                                    <i class="fa fa-file"> </i> @lang('Upload Speech')
                                </a>
                                @endif
                            </p>

                        </div>
                        <div class="tab-pane container" id="waiting_approval">
                            <table id="waiting_approval_table" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @if($user_type == 'staff' && $notice_priority==0)
                                        <th><input style="width: 24px;" type="checkbox" id="checkAll_waiting_approval" class="form-control"></th>
                                        @endif

                                        <th width="5%">@lang('Serial')</th>
                                        <th width="5%">@lang('RD No.')</th>
                                        <th width="15%">@lang('MP')</th>
                                        <th width="30%">@lang('Subject')</th>
                                        <th width="13%">@lang('Date')</th>
                                        <th width="13%">@lang('Comments')</th>
                                        <th width="7%">@lang('Status')</th>
                                        <th width="15%" class="text-center">@lang('Action')</th>
                                    </tr>
                                </thead>

                            </table>
                            <p>
                                @if($user_type=='staff' && ($current_status_ids==6))
                                <a class="btn btn-sm btn-info" onClick="make_pdf('acceptable_notice')">
                                    <i class="fa fa-check"> </i> @lang('Acceptable List')
                                </a>
                                </a>&nbsp;
                                <a class="btn btn-sm btn-info" onClick="make_pdf('topicwise')">
                                    <i class="fa fa-file"> </i> @lang('Topicwise Report')
                                </a>
                                @endif
                            </p>
                        </div>
                        <div class="tab-pane container" id="yes_no_tab">
                            <table id="yes_no_tab_table" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @if($user_type == 'staff' && $notice_priority==0)
                                        <th><input style="width: 24px;" type="checkbox" id="checkAll_yes_no_tab" class="form-control"></th>
                                        @endif

                                        <th width="5%">@lang('Serial')</th>
                                        <th width="5%">@lang('RD No.')</th>
                                        <th width="15%">@lang('MP')</th>
                                        <th width="30%">@lang('Subject')</th>
                                        <th width="13%">@lang('Date')</th>
                                        <th width="13%">@lang('Comments')</th>
                                        <th width="7%">@lang('Status')</th>
                                        <th width="15%" class="text-center">@lang('Action')</th>
                                    </tr>
                                </thead>

                            </table>
                            <p>
                                @if($user_type=='staff' && ($current_status_ids==6))
                                <a class="btn btn-sm btn-info" onClick="make_pdf('yes_no_list')">
                                    <i class="fa fa-check"> </i> @lang('Yes No List')
                                </a>
                                @endif
                            </p>
                        </div>
                        <div class="tab-pane container" id="bill_amendment">
                            <table id="bill_amendment_table" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @if($user_type == 'staff' && $notice_priority==0)
                                        <th><input style="width: 24px;" type="checkbox" id="checkAll_bill_amendment" class="form-control"></th>
                                        @endif

                                        <th width="5%">@lang('Serial')</th>
                                        <th width="5%">@lang('RD No.')</th>
                                        <th width="15%">@lang('MP')</th>
                                        <th width="30%">@lang('Subject')</th>
                                        <th width="13%">@lang('Date')</th>
                                        <th width="13%">@lang('Comments')</th>
                                        <th width="7%">@lang('Status')</th>
                                        <th width="15%" class="text-center">@lang('Action')</th>
                                    </tr>
                                </thead>

                            </table>
                            <p>
                                @if($user_type=='staff' && ($current_status_ids==6))
                                <a class="btn btn-sm btn-info" onClick="make_pdf('bill_amendment')">
                                    <i class="fa fa-check"> </i> @lang('Acceptable List')
                                </a>
                                @endif
                            </p>
                        </div>
                        <div class="tab-pane container" id="bill_clause_amendment">
                            <table id="bill_clause_amendment_table" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @if($user_type == 'staff' && $notice_priority==0)
                                        <th><input style="width: 24px;" type="checkbox" id="checkAll_bill_clause_amendment" class="form-control"></th>
                                        @endif

                                        <th width="5%">@lang('Serial')</th>
                                        <th width="5%">@lang('RD No.')</th>
                                        <th width="15%">@lang('MP')</th>
                                        <th width="30%">@lang('Subject')</th>
                                        <th width="13%">@lang('Date')</th>
                                        <th width="13%">@lang('Comments')</th>
                                        <th width="7%">@lang('Status')</th>
                                        <th width="15%" class="text-center">@lang('Action')</th>
                                    </tr>
                                </thead>

                            </table>
                            <p>
                                @if($user_type=='staff' && ($current_status_ids==6))
                                <a class="btn btn-sm btn-info" onClick="make_pdf('bill_clause_amendment')">
                                    <i class="fa fa-check"> </i> @lang('Acceptable List')
                                </a>
                                @endif
                            </p>
                        </div>
                        @endif
                        @if($current_status_ids!=6)
                        <div class="tab-pane container active " id="other_tables">
                            <table id="other_records" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @if($user_type == 'staff' && $notice_priority==0)
                                        <th><input style="width: 24px;" type="checkbox" id="checkAll_others" class="form-control"></th>
                                        @endif
                                        <th width="5%">@lang('Serial')</th>
                                        <th width="5%">@lang('RD No.')</th>
                                        <th width="15%">@lang('MP')</th>
                                        <th width="30%">@lang('Subject')</th>
                                        <th width="13%">@lang('Date')</th>
                                        <th width="13%">@lang('Comments')</th>
                                        <th width="7%">@lang('Status')</th>
                                        <th width="15%" class="text-center">@lang('Action')</th>
                                    </tr>
                                </thead>

                            </table>
                            <p style="text-align:center;">
                                @if($user_type=='staff')
                                <a class="btn btn-sm btn-info" id="massConsent">
                                    <i class="fa fa-list"> </i> @lang('Mass Consent')
                                </a>
                                @endif
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="details_content" class="content">

</div>
<script>
    var selected_items = [];
    var selected_stages = [];
    var selected_consent = '';
    var lotto = '{!! json_encode($notices, true) !!}';
    var mp_list = [];
    var rule_number = 0;
    var selected_rule_number = 0;
    var my_rule_name = '';
    var topic_id = 0;
    var parliament_session_id = "{{$parliamentSession->id}}";
    var yes_no_selector = '';
    $(document).ready(function() {
        // show topic list based on above condition
        "@if($current_status_ids == 6)";
        load_data('waiting_submit');
        "@else";
        load_data('other');
        "@endif";

        $("#checkAll_others").on("click", function(e) {
            selected_items = [];
            selected_stages = [];
            $('input:checkbox').not(this).prop('checked', this.checked);
            $(".select_data").each(function() {
                if (this.checked) {
                    selected_items.push($(this).data('id'));
                    selected_stages.push({
                        id: $(this).data('id'),
                        stage: $(this).data('stage')
                    });
                }
            });
            console.log(selected_items);
            console.log(selected_stages);
        });

        /*    $("#checkAll_waiting_submit, #checkAll_waiting_approval, #checkAll_bill_amendment, #checkAll_bill_clause_amendment, #checkAll_yes_no_tab").on("click", function(e) {
               selected_items = [];
               $('input:checkbox').not(this).prop('checked', this.checked);
               $(".select_data").each(function() {
                   if (this.checked) {
                       selected_items.push($(this).data('id'));
                   }
               });
               console.log(selected_items);
           }); */

        /*   $(".select_data").each(function() {
              $(this).on("click", function() {
                  if (this.checked == false) {
                      if (selected_items.indexOf($(this).data('id')) > -1) {
                          selected_items.splice(selected_items.indexOf($(this).data('id')), 1);
                      }
                  } else {
                      selected_items.push($(this).data('id'));
                  }
                  console.log(selected_items);
              });
          }); */

        $("#massConsent").click(function() {
            if (selected_rule_number == 0) {
                Swal.fire('বিধি নির্বাচন করুন', '', 'error');
                return false;
            }
            else if (selected_stages.length == 0) {
                Swal.fire('নোটিশ নির্বাচন করুন', '', 'error');
                return false;
            }
            $("#consentModal").modal('show');
        });

        $(".consent_button").each(function() {
            $(this).on("click", function() {
                selected_consent = $(this).data('id');
                if (selected_consent == 1) {
                    $(this).removeClass('btn-secondary');
                    $(this).addClass('btn-success');
                    $('.consent_button').not(this).removeClass('btn-danger');
                    $('.consent_button').not(this).addClass('btn-secondary');
                }
                if (selected_consent == 0) {
                    $(this).removeClass('btn-secondary');
                    $(this).addClass('btn-danger');
                    $('.consent_button').not(this).removeClass('btn-success');
                    $('.consent_button').not(this).addClass('btn-secondary');
                }
                console.log(selected_consent);
            });
        });
    });

    /* for priority set */
    $(document).on('click', '.set_prio', function() {
        var btn = this;
        Swal.fire({
            title: '@lang("Are you sure?")',
            //text: "এই নোটিশটি সংসদে আলোচনা হবে!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'YES',
            cancelButtonText: 'NO'
        }).then((result) => {
            console.log(result);
            if (result.value) {
                var url = $(this).data('route');
                var _token = "{{csrf_token()}}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: _token,
                        type: 'priority',
                        id: $(this).data('id')
                    },
                    success: function(response) {
                        if (response == 1) {
                            Swal.fire({
                                title: 'এই নোটিশটি সংসদে আলোচনা হবে',
                                //text: "এই নোটিশটি সংসদে আলোচনা হবে!",
                                type: 'success'
                            }).then((result) => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Priority Can not be set', '', 'error');
                        }
                    }
                });
            } else {
                //Swal.fire('Your data is safe', '', 'success');
            }
        })
    });

    /* change status from department for speaker */
    $(document).on('click', '#setStatus', function() {
        if (selected_items.length > 0) {
            var btn = this;
            Swal.fire({
                title: '@lang("Are you sure?")',
                //text: "এই নোটিশটি সংসদে আলোচনা হবে!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'YES',
                cancelButtonText: 'NO'
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    var url = $(this).data('route');
                    var _token = "{{csrf_token()}}";
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            _token: _token,
                            type: 'status',
                            id: selected_items
                        },
                        success: function(response) {
                            if (response == 1) {
                                Swal.fire({
                                    title: 'এই বিজ্ঞপ্তিগুলি অনুমোদনযোগ্য',
                                    //text: "এই নোটিশটি সংসদে আলোচনা হবে!",
                                    type: 'success'
                                }).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error!!!', '', 'error');
                            }
                        }
                    });
                } else {
                    //Swal.fire('Your data is safe', '', 'success');
                }
            })
        } else {
            alert('please choose as notice');
        }
    });

    function make_pdf(list_type = null) {
        $.ajax({
            url: "{{url('/admin/notice-management/notices/notice/generate_pdf/dr/')}}/" + list_type,
            type: "GET",
            data: {
                _token: "{{csrf_token()}}",
                submission_date: ($("#datepicker_search").val() != '') ? $("#datepicker_search").val() : '',
                yes_no: ($('#yes_no_selector').val() != '') ? $('#yes_no_selector').val() : '',
                topic_id: topic_id,
                rule_number: selected_rule_number,
                rule_name: my_rule_name
            },
            xhrFields: {
                responseType: 'blob'
            },

            success: function(response) {
                var blob = new Blob([response]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "Sample.pdf";
                link.click();
            },
            error: function(blob) {
                console.log(blob);
            }
        });
    }

    $('.filter_button').each(function(index) {

        $(this).on('click', function() {

            var rule_number = $(this).data('id');
            if (rule_number == 6 || rule_number == 7) {
                if (rule_number == 6) {
                    $(".topic_section78").removeClass('show');
                    $(".topic_section78").addClass('d-none');
                } else {
                    $(".topic_section78").removeClass('d-none');
                    $(".topic_section78").addClass('show');
                }
                if (rule_number == 7) {
                    $(".topic_section82").removeClass('show');
                    $(".topic_section82").addClass('d-none');
                } else {
                    $(".topic_section82").removeClass('d-none');
                    $(".topic_section82").addClass('show');
                }
                $("#speech_button").removeClass('d-none');
                $("#speech_button").addClass('block');
            } else {
                $(".topic_section78").removeClass('show');
                $(".topic_section78").addClass('d-none');
                $(".topic_section82").removeClass('show');
                $(".topic_section82").addClass('d-none');
                $("#speech_button").removeClass('block');
                $("#speech_button").addClass('d-none');
            }

            $(".filter_button").not($(this)).removeClass('btn-success');
            $(this).addClass('btn-success');
            var notice_type = $('#item_type').val();
            load_data(notice_type, topic_id = null, rule_number);
            selected_rule_number = rule_number;
            my_rule_name = $(this).text();

            console.log(selected_rule_number + ': ' + my_rule_name);
        });
    });

    $('.filter_button_topic').each(function(index) {

        $(this).on('click', function() {
            topic_id = $(this).data('id');
            rule_number = $(this).data('rule_number');
            $(".filter_button_topic").not($(this)).removeClass('active btn-success');
            $(this).addClass('active btn-success');
            var notice_type = $('#item_type').val();
            if (topic_id > 0) {
                load_data(notice_type, topic_id, rule_number);
            } else if (topic_id == 0) {
                load_data(notice_type, null, rule_number);
            } else {
                load_data(notice_type);
            }

        });
    });

    function load_data(type, bill_topic = null, rule_number = null) {
        $('#item_type').val(type);
        $("#checkAll_others,#checkAll_waiting_submit, #checkAll_waiting_approval, #checkAll_bill_amendment, #checkAll_bill_clause_amendment").prop('checked', false);
        selected_items = [];
        selected_stages = [];
        selected_consent = '';
        $(".rule_container").show();
        var given_date = ($("#datepicker_search").val() != '') ? $("#datepicker_search").val() : '';
        var table_id = '';
        var topic_id = (bill_topic != null) ? bill_topic : '';

        if (rule_number != null) {
            rule_number = rule_number;
        }

        if (type == 'waiting_approval') {
            table_id = 'waiting_approval_table';
            $(".dt-buttons").append('Hello world');
        } else if (type == 'waiting_submit') {
            table_id = 'waiting_submit_table';
        } else if (type == 'bill_amendment') {
            $(".rule_container").hide();
            table_id = 'bill_amendment_table';
        } else if (type == 'bill_clause_amendment') {
            $(".rule_container").hide();
            table_id = 'bill_clause_amendment_table';
        } else if (type == 'yes_no_tab') {
            table_id = 'yes_no_tab_table';
        } else {
            table_id = 'other_records';
        }
        console.log('table id: ' + table_id);
        parliament_session_id = $("#parliament_session").val();
        yes_no_selector = $("#yes_no_selector").val();
        var table = $('#' + table_id).DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            filter: true,
            ajax: {
                url: "{{ url('admin/notice-management/notice_list') }}",
                dataType: "json",
                type: "GET",
                data: {
                    _token: "{{csrf_token()}}",
                    status_id: '{{$current_status_ids}}',
                    type: (table_id != 'other_records') ? type : '',
                    rule_number: rule_number,
                    topic_id: topic_id,
                    parliament_session_id: parliament_session_id,
                    yes_no: yes_no_selector,
                    submission_date: ($("#datepicker_search").val() != '') ? $("#datepicker_search").val() : ''
                }
            },
            //"order": [],
            "columnDefs": [{
                "orderable": false,
                "targets": [0],
            }],
            columns: [{
                    data: 'checkButton',
                    name: 'checkButton'
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'rd_no',
                    name: 'RD No.'
                },
                {
                    data: 'from_user_name',
                    name: 'MP'
                },
                {
                    data: 'topic',
                    name: 'Subject'
                },
                {
                    data: 'date',
                    name: 'Date'
                },
                {
                    data: 'comments',
                    name: 'Comments'
                },
                {
                    data: 'status',
                    name: 'Status'
                },
                {
                    data: 'action',
                    name: 'Action'
                },
            ]
        });

        var session_list = '<select name="parliament_session" id="parliament_session" class="form-control select2" style="width:100%;"> @foreach($parliament_session_list as $p) <option value="{{$p->id}}">{{$p->session_name}}</option> @endforeach</select>';

        if (type == 'waiting_approval') {
            if (!$("#waiting_approval_table_length").hasClass("form-group row")) {
                $("#waiting_approval_table_length").addClass("form-group row");
                $("#waiting_approval_table_length").parent().removeClass("col-sm-12 col-md-6");
                $("#waiting_approval_table_length").parent().addClass("col-8");
                $("#waiting_approval_table_filter").parent().removeClass("col-sm-12 col-md-6");
                $("#waiting_approval_table_filter").parent().addClass("col-4");
            }

            $("#waiting_approval_table_length").append('<div class="row text-center" style="padding-left:15px; margin-top: -8px;"> <div class="col-5"> <div class="input-group date" id="reservationdate" data-target-input="nearest"> <input type="text" class="form-control datetimepicker-input @error("date") is-invalid @enderror" name="date" id="datepicker_search" data-firstdate="{{$parliamentSession->date_from ?? null}}" data-lastdate="{{$parliamentSession->date_to ?? null}}" value="{{old("date")}}" placeholder="@lang("Date")" data-target="#reservationdate"/> <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker"> <div class="input-group-text"><i class="fa fa-calendar"></i></div></div></div></div><div class="col-4"> ' + session_list + ' </div> <div class="col-1"> <button type="button" class="btn btn-info" onclick=load_data(' + '"waiting_approval"' + ')>Show</button> </div></div><input type="hidden" id="given_date"> ');


            var elem = document.getElementById('datepicker_search');
            var firstDate = elem.getAttribute('data-firstdate');
            var lastDate = elem.getAttribute('data-lastdate');

            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'YYYY-MM-DD',
                minDate: firstDate,
                maxDate: lastDate,
            });
            $("#datepicker_search").val(given_date);

        }
        if (type == 'yes_no_tab') {
            if (!$("#yes_no_tab_table_length").hasClass("form-group row")) {
                $("#yes_no_tab_table_length").addClass("form-group row");
                $("#yes_no_tab_table_length").parent().removeClass("col-sm-12 col-md-6");
                $("#yes_no_tab_table_length").parent().addClass("col-8");
                $("#yes_no_tab_table_filter").parent().removeClass("col-sm-12 col-md-6");
                $("#yes_no_tab_table_filter").parent().addClass("col-4");
            }

            $("#yes_no_tab_table_length").append('<div class="row text-center" style="padding-left:15px; margin-top: -8px;"> <div class="col-5"> <div class="input-group date" id="reservationdate" data-target-input="nearest"> <input type="text" class="form-control datetimepicker-input @error("date") is-invalid @enderror" name="date" id="datepicker_search" data-firstdate="{{$parliamentSession->date_from ?? null}}" data-lastdate="{{$parliamentSession->date_to ?? null}}" value="{{old("date")}}" placeholder="@lang("Date")" data-target="#reservationdate"/> <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker"> <div class="input-group-text"><i class="fa fa-calendar"></i></div></div></div></div><div class="col-4"> ' + session_list + ' </div> <div class="col-2"><select id="yes_no_selector" class="form-control select2" style="width:100%;"><option value=""> </option><option value="1">@lang("Yes")</option> <option value="0">@lang("No")</option></select></div> <div class="col-1"> <button type="button" class="btn btn-info" onclick=load_data(' + '"yes_no_tab"' + ')>Show</button> </div></div><input type="hidden" id="given_date"> ');


            var elem = document.getElementById('datepicker_search');
            var firstDate = elem.getAttribute('data-firstdate');
            var lastDate = elem.getAttribute('data-lastdate');

            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'YYYY-MM-DD',
                minDate: firstDate,
                maxDate: lastDate,
            });
            $("#datepicker_search").val(given_date);

        }
        $("#parliament_session").val(parliament_session_id).select2({});
        $("#yes_no_selector").val(yes_no_selector).select2({});

        $(document).on('click', '.select_data', function() {
            if (this.checked == false) {
                if (selected_items.indexOf($(this).data('id')) > -1) {
                    selected_items.splice(selected_items.indexOf($(this).data('id')), 1);
                }
                let index = selected_stages.map((item) => item.id).indexOf($(this).data('id'));
                if (index > -1) {
                    selected_stages.splice(index, 1);
                }
            } else {
                selected_items.push($(this).data('id'));
                selected_stages.push({
                    id: $(this).data('id'),
                    stage: $(this).data('stage')
                });
            }
            //console.log(selected_items);
            let ids = selected_stages.map(o => o.id);
            selected_stages = selected_stages.filter(({
                id
            }, index) => !ids.includes(id, index + 1));
            console.log(selected_stages);
        });
    }

    function removeDuplicateData(data) {
        return [...new Set(data)];
    }

    /* for bangla in DataTable pdf export */
    function processDoc(doc) {
        pdfMake.fonts = {
            Roboto: {
                normal: 'Roboto-Regular.ttf',
                bold: 'Roboto-Medium.ttf',
                italics: 'Roboto-Italic.ttf',
                bolditalics: 'Roboto-MediumItalic.ttf'
            },
            nikosh: {
                normal: "NikoshBAN.ttf",
                bold: "NikoshBAN.ttf",
                italics: "NikoshBAN.ttf",
                bolditalics: "NikoshBAN.ttf"
            }
        };
        // modify the PDF to use a different default font:
        doc.defaultStyle.font = "nikosh";
        var i = 1;
        /* =================================== */
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

    function edit_data(id) {
        $('#main_content').hide();
        $('#details_content').show();
        $('#details_content').html('<center><img src="{{asset("public/images/lottery.gif")}}"></center>');
        $.ajax({
            url: "{{url('admin/notice-management/notice_details/')}}/edit/" + id,
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

    function go_back() {
        $('#main_content').show();
        $('#details_content').hide();
    }

    function add_speech() {
        if (selected_items.length > 0) {
            $("#speechModal").modal('show');
        } else {
            Swal.fire("No Notice is Selected", '', 'error');
        }
    }
</script>

<script type="text/javascript">
    $(document).ready(function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });
        $('#laravel-ajax-file-upload').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('notice_ids', selected_items);
            $('#speech_loader').removeClass('d-none');
            $('#speech_loader').addClass('show');
            $('#speech_content').removeClass('show');
            $('#speech_content').addClass('d-none');
            $.ajax({
                type: 'POST',
                url: "{{url('/admin/notice-management/notices/notice/notice_speech')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    if (data.success) {
                        $('#speech_loader').removeClass('show');
                        $('#speech_loader').addClass('d-none');
                        $('#speech_content').removeClass('d-none');
                        $('#speech_content').addClass('show');
                        $("#speechModal").modal('hide');
                        Swal.fire({
                            text: '@lang("The Speech is sent successfully")',
                            type: 'success'
                        }).then((result) => {
                            load_data('waiting_approval');
                        });
                    } else {
                        $('#speech_loader').removeClass('show');
                        $('#speech_loader').addClass('d-none');
                        $('#speech_content').removeClass('d-none');
                        $('#speech_content').addClass('show');
                        if (data.speech.length > 0) {
                            Swal.fire(data.speech[0], '', 'error');
                        }

                    }
                },
                error: function(data) {
                    $('#speech_loader').removeClass('show');
                    $('#speech_loader').addClass('d-none');
                    $('#speech_content').removeClass('d-none');
                    $('#speech_content').addClass('show');
                }
            });

        });
    });

    function giveConsent() {
        Swal.fire({
            title: '@lang("Are You Sure?")',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'YES',
            cancelButtonText: 'NO'
        }).then((result) => {
            if (result.value) {
                var url = "{{url('/admin/notice-management/notices/notice/setdata')}}";
                var _token = "{{csrf_token()}}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: _token,
                        type: 'mass_consent',
                        id: removeDuplicateData(selected_items),
                        total_stage: '',
                        rule_number: selected_rule_number,
                        id_stages: selected_stages,
                        user_consent: selected_consent,
                        stage_note: $("#stage_note").val()
                    },
                    success: function(response) {
                        if (response == 1) {
                            Swal.fire({
                                title: '@lang("Your Consent has been sent")',
                                type: 'success'
                            }).then((result) => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('কারিগরী সমস্যা', '', 'error');
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
<div class="modal" id="lotteryModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">@lang('Lottery')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div id="lotteryResult" class="text-center d-none"> </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <!-- <button type="button" id="confirm_lottery" class="btn btn-info float-right d-none" onClick="start_lottery()">@lang('Confirm')</button> -->
                <button type="button" class="btn btn-danger float-left" data-dismiss="modal">@lang('Close')</button>
            </div>

        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="speechModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">@lang('Speech')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div id="speech_loader" class="d-none">
                    <center><img src="{{asset("public/images/lottery.gif")}}"></center>
                </div>
                <div id="speech_content">
                    <form method="POST" enctype="multipart/form-data" id="laravel-ajax-file-upload" action="javascript:void(0)">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-6">
                                        <input type="file" name="speech" placeholder="Choose File" id="speech">
                                        @if ($errors->has('speech'))
                                        <span class="invalid-file" role="alert">
                                            <strong>{{ $errors->first('speech') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <!-- <button type="button" id="confirm_lottery" class="btn btn-info float-right d-none" onClick="start_lottery()">@lang('Confirm')</button> -->
                <button type="button" class="btn btn-danger float-left" data-dismiss="modal">@lang('Close')</button>
            </div>

        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal" id="consentModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">@lang('Consent')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div id="consent_loader" class="d-none">
                    <center><img src="{{asset("public/images/lottery.gif")}}"></center>
                </div>
                <div id="consent_conent">
                    <div class="form-group" id="comment_container">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <label class="control-label" for="stage_note">@lang('Comments')</label>
                            </div>
                            <div class="col-sm-12 col-md-10 col-lg-10">
                                <textarea id="stage_note" name="stage_note" class="form-control textareaWithoutImgVideo">

                                    </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <p style="text-align:center;">
                            <a class="btn btn-lg btn-secondary consent_button" data-id="1">
                                <i class="fa fa-check"> </i> @lang('Agree')
                            </a>
                            &nbsp; &nbsp;
                            <a class="btn btn-lg btn-secondary consent_button" data-id="0">
                                <i class="fa fa-times"> </i> @lang('Disagree')
                            </a>
                        </p>

                    </div>
                    <div class="form-group" id="comment_container">
                        <div class="row">
                            <button type="buton" class="btn btn-success btn-sm" data-route="{{url('/admin/notice-management/notices/notice/setdata')}}" onClick="giveConsent()" style="margin:0 auto;">@lang('Submit')</button>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <!-- <button type="button" id="confirm_lottery" class="btn btn-info float-right d-none" onClick="start_lottery()">@lang('Confirm')</button> -->
                <button type="button" class="btn btn-danger float-left" data-dismiss="modal">@lang('Close')</button>
            </div>

        </div>
    </div>
</div>
@endsection