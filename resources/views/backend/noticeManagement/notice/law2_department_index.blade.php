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

@if (isset($notices) && count($notices) > 0 && $notice_priority!=2)

<div class="content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>@lang('All Notice')</h4>
            </div>

            <div class="card-body">
                <table id="mydataTable" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            @if($user_type == 'staff')
                            <th><input style="width: 24px;" type="checkbox" id="checkAll" class="form-control"></th>
                            @endif
                            @if($notice_priority==1)
                            <th width="5%">@lang('Priority')</th>
                            @endif
                            <th width="5%">@lang('Serial')</th>
                            <th width="5%">@lang('RD No.')</th>
                            <th width="15%">@lang('MP')</th>
                            <th width="30%">@lang('Subject')</th>
                            <th width="13%">@lang('Date')</th>
                            <th width="7%">@lang('Status')</th>
                            <th width="15%" class="text-center">@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $all_mps; @endphp
                        @foreach ($notices as $data)
                        @php $all_mps[] = $data->from_user_name;
                        @endphp
                        <tr>
                            @if($user_type == 'staff')
                            <td><input style="width: 24px;" type="checkbox" data-id="{{$data->id}}" class="form-control select_data"></td>
                            @endif
                            @if($notice_priority==1)
                            <td>
                                <a class="btn btn-sm btn-{{($data->priority==1)?'success':'danger'}} set_prio" data-id="{{$data->id}}" data-route="{{url('/admin/notice-management/notices/notice/setdata')}}">
                                    <i class="fa fa-sort"> </i>
                                </a>
                            </td>
                            @endif

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->rd_no }}</td>
                            <td>{{ $data->from_user_name ?? '' }}</td>
                            <td>{{ $data->rule_name }}</td>
                            <td>{{ date('d F, Y', strtotime($data->created_at)) }}</td>
                            <td>{!! globalStatus('notice',$data->status) !!}</td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-success" href="{{route('admin.notice_management.notices.show', $data->id)}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @if ($user_type == 'mp' && $data->notice_from==auth()->user()->id && $data->status==0)
                                <a class="btn btn-sm btn-info" href="{{route('admin.notice_management.notices.edit', $data->id)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.notice_management.notices.destroy' , $data->id)}}">
                                    <i class="fa fa-trash"></i>
                                </a>
                                @endif
                                @if ($user_type == 'staff' && $data->status>0 && $data->status!=5)
                                <a class="btn btn-sm btn-info" href="{{route('admin.notice_management.notices.edit', $data->id)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                @endif
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                <p style="text-align:center;">
                    @if($user_type=='staff' && $current_status_ids==1)
                    <a class="btn btn-sm btn-info" data-route="{{url('/admin/notice-management/notices/notice/setdata')}}" id="setStatus">
                        <i class="fa fa-list"> </i> @lang('Confirm')
                    </a> &nbsp; &nbsp;
                    @endif
                    @if($user_type=='staff' && $current_status_ids==5)
                    <!-- <a class="btn btn-sm btn-info" id="makeLottery">
                        <i class="fa fa-list"> </i> @lang('Make Lottery')
                    </a> -->
                    @endif
                    @if($user_type=='staff' && ($current_status_ids==3 || $current_status_ids==4))
                    <a class="btn btn-sm btn-info" href="{{url('/admin/notice-management/notices/notice/generate_pdf/law2/acceptable_notice')}}">
                        <i class="fa fa-check"> </i> @lang('Acceptable List')
                    </a>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>

@else
<div class="content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>@lang('Notice Management')</h4>
            </div>
            <div class="card-body">
                <table class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>@lang('Serial')</th>
                            <th>@lang('Subject')</th>
                            <th>@lang('From')</th>
                            <th>@lang('To')</th>
                            <th>@lang('Date')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7" class="text-center">
                                @if($notice_priority==2)
                                @lang('Priority Can be set only on Wednesday !')
                                @else
                                @lang('Notice is not available !')
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif


<!-- add dropdown MP list with jquery dataTable here... -->
@php
$mp_list = '';
if(!empty($all_mps)){
foreach($all_mps as $mps){
$mp_list.='<option values="'.$mps.'">'.$mps.'</option>';
}
}

@endphp

<script>
    var selected_items = [];
    var lotto = @php echo json_encode($notices, true);
    @endphp;
    var mp_list = [];

    $(document).ready(function() {
        $("#checkAll").on("click", function(e) {
            selected_items = [];
            $('input:checkbox').not(this).prop('checked', this.checked);
            $(".select_data").each(function() {
                if (this.checked) {
                    selected_items.push($(this).data('id'));
                }
            });
            console.log(selected_items);
        });

        $(".select_data").each(function() {
            $(this).on("click", function() {
                if (this.checked == false) {
                    if (selected_items.indexOf($(this).data('id')) > -1) {
                        selected_items.splice(selected_items.indexOf($(this).data('id')), 1);
                    }
                } else {
                    selected_items.push($(this).data('id'));
                }
                //console.log(selected_items);
            });
        });
        var table = $('#mydataTable').DataTable({
            aoColumnDefs: [{
                bSortable: false,
                aTargets: [0]
            }]
        });
        @php
        if ($user_type == 'staff') {
            @endphp
            $("#mydataTable_filter").html('<select id="mySelect" class="form-control select2"><option value="">All</option>@php echo $mp_list @endphp</select>');

            $('#mySelect').on('change', function() {
                if (this.value != '') {
                    table.search(this.value).draw();
                } else {
                    table.search('').draw();
                }
            });

            @php
        }
        @endphp
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
            confirmButtonText: '@lang("Yes")',
            cancelButtonText: '@lang("No")'
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
</script>

@endsection