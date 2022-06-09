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

<div class="content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>@lang('All Notice')</h4>
            </div>

            <div class="card-body">
                <ul class="nav nav-tabs">
                    @if($current_status_ids==6)
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#waiting_submit" onClick="load_data('waiting_submit')">@lang('Not Already Sent')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#waiting_approval" onClick="load_data('waiting_approval')">@lang('Already Sent')</a>
                    </li>
                    @else
                    <li class="nav-item d-none">
                        <a class="nav-link active" data-toggle="tab" href="#other_tables" onClick="load_data('other')">@lang('Others')</a>
                    </li>
                    @endif
                </ul>
                <div class="tab-content">
                    @if($current_status_ids==6)
                    <div class="tab-pane container active" id="waiting_submit">
                        <table id="waiting_submit_table" class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    @if($user_type == 'staff' && $notice_priority==0)
                                    <th><input style="width: 24px;" type="checkbox" id="checkAll" class="form-control"></th>
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
                            </a> &nbsp; &nbsp;
                            @endif
                        </p>

                    </div>
                    <div class="tab-pane container" id="waiting_approval">
                        <!-- <div class="row text-center">
                            <div class="col-3">
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input @error('date') is-invalid @enderror" name="date" id="datepicker_search" data-firstdate="{{ $parliamentSession->date_from ?? null }}" data-lastdate="{{ $parliamentSession->date_to ?? null }}" value="{{old('date')}}" placeholder="@lang('Select Date')" data-target="#reservationdate" />
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn btn-info" onclick="load_data('waiting_approval')">Show</button>
                            </div>
                        </div> -->
                        <table id="waiting_approval_table" class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    @if($user_type == 'staff' && $notice_priority==0)
                                    <th><input style="width: 24px;" type="checkbox" id="checkAll" class="form-control"></th>
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
                            <!-- <a class="btn btn-sm btn-info" href="{{url('/admin/notice-management/notices/notice/generate_pdf/law2/acceptable_notice')}}">
                                <i class="fa fa-check"> </i> @lang('Acceptable List')
                            </a> -->
                            <a class="btn btn-sm btn-info" onClick="make_pdf()">
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
                                    <th><input style="width: 24px;" type="checkbox" id="checkAll" class="form-control"></th>
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

                <p style="text-align:center;">
                    @if($user_type=='staff' && $current_status_ids==5)
                    <a class="btn btn-sm btn-info" id="makeLottery">
                        <i class="fa fa-list"> </i> @lang('Make Lottery')
                    </a>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    var selected_items = [];
    var selected_stages = [];
    var selected_consent = '';
    var lotto = @php echo json_encode($notices, true);
    @endphp;
    var mp_list = [];
    console.log(lotto.length);
    $(document).ready(function() {

        @php echo($current_status_ids == 6) ? 'load_data("waiting_submit");' : 'load_data("other");';
        @endphp

        $("#checkAll").on("click", function(e) {
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

        $("#massConsent").click(function() {
            if (selected_stages.length == 0) {
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
                        } else if (response == 2) {
                            Swal.fire('চালানোর অনুমতি নেই', '', 'warning');
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
                confirmButtonText: '@lang("Yes")',
                cancelButtonText: '@lang("No")',
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

    //for lottery number
    $('#makeLottery').click(function() {
        //if (lotto.length > 4) {
        Swal.fire({
            title: '@lang("Are you sure?")',
            text: "@lang('Notice of selected MPs will be discussed in Parliament!')",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '@lang("Yes")',
            cancelButtonText: '@lang("No")'
        }).then((result) => {
            console.log(result);
            if (result.value) {
                $("#lotteryModal").modal('show');
                $('#lotteryResult').removeClass('d-none');
                $('#lotteryResult').addClass('block');
                $('#lotteryResult').html('<img src="{{asset("public/images/lottery.gif")}}">');
                setTimeout(() => {
                    randCol();
                }, 2000);

            } else {
                //Swal.fire('Your data is safe', '', 'success');
            }
        });
        /* } else {
            alert('There should be at least 5 notices');
        } */

    });

    function randCol() {
        var random_array = [];
        mp_list = [];
        var final_data = '<table class="table table-striped"><thead><tr><th>{{Lang::get("RD No.")}}</th><th>{{Lang::get("MP")}}</th><th>{{Lang::get("Voter Area")}}</th><th>{{Lang::get("Topic")}}</th></tr></thead><tbody>';

        //random_array = searchRandom(5, lotto);
        var counting_length = (lotto.length < 5) ? lotto.length : 5;
        random_array = searchRandom(counting_length, lotto);

        for (var x = 0; x < random_array.length; x++) {
            final_data += '<tr><td>' + random_array[x].rd_no + '</td><td>' + random_array[x].from_user_name + '</td><td>' + random_array[x].voter_area + '</td><td class="comment_column">' + random_array[x].topic + '</td></tr>';
            mp_list.push(random_array[x].notice_from);
        }
        final_data += '</tbody></table>';
        console.log(mp_list);
        //$("#lotteryModal").modal('hide');
        $.ajax({
            url: "{{url('admin/notice-management/notices/notice/makelottery')}}",
            type: "POST",
            data: {
                _token: "{{csrf_token()}}",
                mp_ids: mp_list
            },
            success: function(response) {
                if (response == 1) {
                    $('#lotteryResult').html(final_data);
                    //location.reload();
                } else if (response == 2) {
                    Swal.fire('চালানোর অনুমতি নেই', '', 'warning');
                    $("#lotteryModal").modal('hide');
                } else {
                    Swal.fire('@lang("Server Error")', '', 'error');
                    $("#lotteryModal").modal('hide');
                }
            }
        });
    }

    function searchRandom(count, arr) {
        let answer = [],
            counter = 0;

        while (counter < count) {
            let rand = arr[Math.floor(Math.random() * arr.length)];

            if (!answer.some(an => an === rand)) {
                answer.push(rand);
                counter++;
                console.log(rand);
            }
        }

        const uniqueObjectsByContent = [...new Map(answer.map(item => [item['notice_from'], item])).values()];

        return uniqueObjectsByContent;
    }

    function start_lottery() {
        Swal.fire({
            title: '@lang("Are you sure?")',
            text: "এই নোটিশটি সংসদে আলোচনা হবে!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '@lang("Yes")',
            cancelButtonText: '@lang("No")'
        }).then((result) => {
            console.log(result);
            if (result.value) {
                $.ajax({
                    url: "{{url('admin/notice-management/notices/notice/makelottery')}}",
                    type: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        mp_ids: mp_list
                    },
                    success: function(response) {
                        if (response == 1) {
                            Swal.fire({
                                title: 'লটারি সম্পন্ন হয়েছে',
                                //text: "এই নোটিশটি সংসদে আলোচনা হবে!",
                                type: 'success'
                            }).then((result) => {
                                location.reload();
                            });
                        } else if (response == 2) {
                            Swal.fire('চালানোর অনুমতি নেই', '', 'warning');
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

    function make_pdf() {
        $.ajax({
            url: "{{url('/admin/notice-management/notices/notice/generate_pdf/law2/acceptable_notice')}}",
            type: "GET",
            data: {
                _token: "{{csrf_token()}}",
                submission_date: ($("#datepicker_search").val() != '') ? $("#datepicker_search").val() : ''
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

    function load_data(type) {
        var given_date = ($("#datepicker_search").val() != '') ? $("#datepicker_search").val() : '';
        var table_id = '';
        selected_items = [];
        selected_stages = [];
        selected_consent = '';
        if (type == 'waiting_approval') {
            table_id = 'waiting_approval_table';
            $(".dt-buttons").append('Hello world');
        } else if (type == 'waiting_submit') {
            table_id = 'waiting_submit_table';
        } else {
            table_id = 'other_records';
        }
        console.log('table id: ' + table_id);
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
            /* ,
                        dom: 'Blrtip',
                        buttons: [
                            'copy', 'csv', 'excel',
                            {
                                extend: 'print',
                                orientation: 'landscape',
                                title: "বাংলাদেশ জাতীয় সংসদ সচিবালয়<br>{{\Lang::get('Acceptable List')}}",
                                messageTop: "<center><h2>hello my name is PDF export</h2><p>I am fine...</p></center>",
                                classname: 'btn btn-info',
                                exportOptions: {
                                    columns: [2, 3, 4, 5, 7]
                                },
                            },
                            {
                                extend: 'pdf',
                                orientation: 'landscape',
                                title: "{{\Lang::get('Acceptable List')}}",
                                //messageTop: "hello my name is PDF export",
                                customize: function(doc) {
                                    //processDoc(doc);
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
                                        },
                                        kalpurush: {
                                            normal: "kalpurush.ttf",
                                            bold: "kalpurush.ttf",
                                            italics: "kalpurush.ttf",
                                            bolditalics: "kalpurush.ttf"
                                        }
                                    };
                                    // modify the PDF to use a different default font:
                                    doc.defaultStyle.font = "kalpurush";
                                    //doc.header = "<h2> hello owrld...</h2><p>Only testeing purpose</p>";
                                    var i = 1;
                                },
                                classname: 'btn btn-info',
                                exportOptions: {
                                    columns: [2, 3, 4, 5, 7],
                                    stripHtml: true
                                },
                            }
                        ] */
        });

        if (type == 'waiting_approval') {
            if (!$("#waiting_approval_table_length").hasClass("form-group row")) {
                $("#waiting_approval_table_length").addClass("form-group row");
            }

            $("#waiting_approval_table_length").append('<div class="row text-center" style="padding-left:15px; margin-top: -8px;"> <div class="col-8"> <div class="input-group date" id="reservationdate" data-target-input="nearest"> <input type="text" class="form-control datetimepicker-input @error("date") is-invalid @enderror" name="date" id="datepicker_search" data-firstdate="{{$parliamentSession->date_from ?? null}}" data-lastdate="{{$parliamentSession->date_to ?? null}}" value="{{old("date")}}" placeholder="@lang("Select Date")" data-target="#reservationdate"/> <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker"> <div class="input-group-text"><i class="fa fa-calendar"></i></div></div></div></div><div class="col-1"> <button type="button" class="btn btn-info" onclick=load_data(' + '"waiting_approval"' + ')>Show</button> </div></div><input type="hidden" id="given_date">');

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
            let ids = selected_stages.map(o => o.id);
            selected_stages = selected_stages.filter(({
                id
            }, index) => !ids.includes(id, index + 1));
            console.log(selected_stages);
        });
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
                        id: selected_items,
                        total_stage: '',
                        id_stages: selected_stages,
                        rule_number: 131,
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