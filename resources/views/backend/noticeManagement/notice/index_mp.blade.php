@extends('backend.layouts.app')
@section('content')
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

@if(auth()->user()->usertype === 'mp' || auth()->user()->usertype ==='ps')
<div class="content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @if($current_parliament==1)
                <form id="noticeSearchForm" class="form-horizontal" action="{{route('admin.notice_management.notices.create')}}" method="get">
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label class="control-label" for="rule_number">@lang('For Create Notice Select the Rule')<span class="required text-danger">*</span></label>
                            <select id="rule_number" name="rule_number" class="form-control form-control-sm select2" required>
                                <option value="">@lang('Select Rule')</option>
                                @if(isset($parliamentSession))
                                    @if (isset($allRules) && count($allRules) > 0)
                                        @foreach ($allRules as $data)
                                            @if( $data->rule_number ==old('rule_number'))
                                                <option selected value="{{ $data->rule_number }}">{{ $data->name }}</option>
                                            @else
                                                <option value="{{ $data->rule_number }}">{{ $data->name }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                            </select>
                        </div>

                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-info btn-sm seachNotice" style="margin-top:28px">
                                @lang('GO')
                            </button>
                        </div>
                    </div>
                </form>
                @else
                <code>No Parliament Session is Active</code>
                @endif
            </div>
        </div>
    </div>
</div>
@endif

<div class="content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>@lang('All Notice')</h4>
            </div>

            <div class="card-body">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="my_notices_tab" data-toggle="tab" href="#my_notices" onClick="load_data('my_notices')">@lang('My Notices')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="my_received_notices" data-toggle="tab" href="#received_notices" onClick="load_data('received_notices')">@lang('Received Notices')</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane container active" id="my_notices">
                        <table id="my_notices_table" class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">@lang('Rule')</th>
                                    <th width="30%">@lang('Subject')</th>
                                    <!-- <th width="15%">@lang('From')</th> -->
                                    <th width="15%">@lang('To')</th>
                                    <th width="13%">@lang('Date')</th>
                                    <th width="7%">@lang('Status')</th>
                                    <th>@lang('Comments')</th>
                                    <th width="15%" class="text-center">@lang('Action')</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tab-pane container" id="received_notices">
                        <table id="received_notices_table" class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">@lang('Rule')</th>
                                    <th width="30%">@lang('Subject')</th>
                                    <!-- <th width="15%">@lang('MP')</th> -->
                                    <th width="15%">@lang('To')</th>
                                    <th width="13%">@lang('Date')</th>
                                    <th width="7%">@lang('Status')</th>
                                    <th>@lang('Comments')</th>
                                    <th width="15%" class="text-center">@lang('Action')</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        load_data('my_notices');
    });

    function giveApproval(item, notice_id) {
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
                        type: 'recent_discussion',
                        id: notice_id,
                        agree_condition: item,
                        acceptance_duration: 0
                    },
                    success: function(response) {
                        if (response == 1) {
                            location.reload();
                        } else if (response == 2) {
                            Swal.fire('@lang("Openion already given")', '', 'warning');
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

    function load_data(type, bill_topic = null, rule_number = null) {
        var yes_no_selector = '';
        var table_id = '';
        var topic_id = (bill_topic != null) ? bill_topic : '';

        if (rule_number != null) {
            rule_number = rule_number;
        }

        if (type == 'my_notices') {
            table_id = 'my_notices_table';
        } else if (type == 'received_notices') {
            table_id = 'received_notices_table';
        }
        parliament_session_id = "{{$parliamentSession->id}}";
        //yes_no_selector = $("#yes_no_selector").val();

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
                    //status_id: '0,1',
                    type: (table_id != 'other_records') ? type : '',
                    rule_number: rule_number,
                    topic_id: topic_id,
                    parliament_session_id: parliament_session_id,
                    yes_no: yes_no_selector
                }
            },
            "columnDefs": [{
                "orderable": false,
                "targets": [0]
            }],
            columns: [{
                    data: 'rule_number',
                    name: 'rule_number'
                },
                {
                    data: 'topic',
                    name: 'Subject'
                },
                {
                    /* data: (type === 'my_notices') ? 'to_user_name' : 'from_user_name', */
                    data: 'to_user_name',
                    name: 'MP'
                },
                {
                    data: 'date',
                    name: 'Date'
                },
                {
                    data: 'status',
                    name: 'Status'
                },
                {
                    data: 'comments',
                    name: 'Comments'
                },

                {
                    data: 'action',
                    name: 'Action'
                },
            ]
        });
    }

    function confirm_acceptance(notice_id = 0, yes_no = 0, duration = null) {
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
                        type: 'mp_acceptance',
                        id: (notice_id == 0) ? selected_notice : notice_id,
                        mp_acceptance: yes_no
                    },
                    success: function(response) {
                        if (response == 1) {
                            $("#my_received_notices").click();
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

@endsection