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

@if (isset($notices) && count($notices) > 0)

<div class="content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>@lang('All Notice')</h4>
            </div>

            <div class="card-body">
                <table id="dataTable" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">@lang('Rule')</th>
                            <th width="30%">@lang('Subject')</th>
                            <th width="15%">@lang('From')</th>
                            <th width="15%">@lang('To')</th>
                            <th width="13%">@lang('Date')</th>
                            <th width="7%">@lang('Status')</th>
                            <th>@lang('Comments')</th>
                            <th width="15%" class="text-center">@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notices as $data)

                        @php
                        if($data->rule_number==78 || $data->rule_number==82){
                        $bill_topics = billTopicList($data->rule_number);
                        foreach ($bill_topics as $b) {
                        if ($data->bill_topic == $b['id']) {
                        $data->topic = $b['name'];
                        }
                        }
                        }
                        

                        @endphp
                        <tr>
                            <td>{{ $data->rule_number }}</td>
                            <td class="comment_column">{!! $data->topic !!}</td>
                            <td>{{ $data->from_user_name ?? '' }}</td>
                            <td>{{ $data->to_user_name ?? '' }}</td>
                            <td>{{ digitDateLang(nanoDateFormat($data->created_at,'d F Y')) }}</td>
                            <td>{!! globalStatus('notice',$data->status) !!}</td>
                            <td class="comment_column">{{$data->comments}}</td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-success" href="{{route('admin.notice_management.notices.show', $data->id)}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @if (auth()->user()->usertype == 'mp' and $data->notice_from==auth()->user()->id and $data->status==0)
                                <a class="btn btn-sm btn-info" href="{{route('admin.notice_management.notices.edit', $data->id)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.notice_management.notices.destroy' , $data->id)}}">
                                    <i class="fa fa-trash"></i>
                                </a>
                                @endif

                                @if(isset($recent_discussion) && $recent_discussion==1)
                                <a class="btn btn-xs  {{(isset($data->mp_agree_condition) && $data->mp_agree_condition==1)?'btn-success':'btn-secondary'}}" data-id="{{$data->id}}" onClick="giveApproval(1,{{$data->id}})">
                                    <i class="fa fa-check"> </i> @lang('Agree')
                                </a>
                                &nbsp; &nbsp;
                                <a class="btn btn-xs {{(isset($data->mp_agree_condition) && $data->mp_agree_condition==0)?'btn-danger':'btn-secondary'}}" data-id="{{$data->id}}" onClick="giveApproval(0,{{$data->id}})">
                                    <i class="fa fa-times"> </i> @lang('Disagree')
                                </a>

                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@else
<div class="content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>@lang('All Notice')</h4>
            </div>
            <div class="card-body">
                <table id="dataTable" class="table table-sm table-bordered table-striped">
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
                            <td colspan="7" class="text-center">@lang('Notice is not available !')</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif

<script>
    function giveApproval(item,notice_id) {
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
                        agree_condition:item,
                        acceptance_duration: 0
                    },
                    success: function(response) {
                        if (response == 1) {
                            location.reload();
                        } 
                        else if(response==2){
                            Swal.fire('@lang("Openion already given")', '', 'warning');
                        }
                        else {
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