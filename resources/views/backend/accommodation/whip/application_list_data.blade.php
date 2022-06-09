<div class="row">
    <div class="col-xs-12" style="width: 100%;">
        <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link {{(request()->approve || request()->reject)?(''):'active'}}" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">বিচারাধীন</a>
                <a class="nav-item nav-link {{(request()->approve)?('active'):''}}" id="approval-tab" data-toggle="tab" href="#approval" role="tab" aria-controls="approval" aria-selected="false">অনুমোদিত</a>
                <a class="nav-item nav-link {{(request()->reject)?('active'):''}}" id="reject-tab" data-toggle="tab" href="#reject" role="tab" aria-controls="reject" aria-selected="false">প্রত্যাখ্যাত</a>
            </div>
        </nav>
        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <div class="tab-pane fade {{(request()->approve || request()->reject)?(''):'show active'}}" id="pending" role="tabpanel" aria-labelledby="pending-tab" style="padding: 0px 15px 0px 15px;">
                <table id="pending_table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">@lang('Serial')</th>
                            <th>@lang('Application Subject')</th>
                            <th>@lang('Applicant Name')</th>
                            <th>@lang('Expected Allocated Date')</th>
                            <th>@lang('Area')</th>
                            <th>@lang('status')</th>
                            <th width="10%" class="text-center">@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($accommodation_application_pendings as $list)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{(session()->get('language') =='bn')?(@$list['accommodation_application_type']['name_bn']):@$list['accommodation_application_type']['name']}}</td>
                            <td>{{(session()->get('language') =='bn')?(@$list['mp']['name_bn']):@$list['mp']['name']}}</td>
                            <td>{{(session()->get('language') =='bn')?(en2bn(date('d-m-Y',strtotime(@$list['date'])))):date('d-m-Y',strtotime(@$list['date']))}}</td>
                            <td>{{(session()->get('language') =='bn')?(@$list['area']['name_bn']):@$list['area']['name']}}</td>
                            <td>{{accommodation_status(@$list->status)}}</td>
                            <td>
                                <a style="margin-left:2px;" class="btn btn-sm btn-info approve" data-id="{{$list->id}}"><i class="fa fa-check"></i></a>
                                <a style="margin-left:2px;" class="btn btn-sm btn-danger reject_accommodation" data-id="{{$list->id}}"><i class="fa fa fa-times">
                            </td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade {{(request()->approve)?('show active'):''}}" id="approval" role="tabpanel" aria-labelledby="approval-tab" style="padding: 0px 15px 0px 15px;">
                <table id="approve_table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">@lang('Serial')</th>
                            <th>@lang('Application Subject')</th>
                            <th>@lang('Applicant Name')</th>
                            <th>@lang('Expected Allocated Date')</th>
                            <th>@lang('Area')</th>
                            <th>@lang('status')</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($accommodation_application_approves as $list)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{(session()->get('language') =='bn')?(@$list['accommodation_application_type']['name_bn']):@$list['accommodation_application_type']['name']}}</td>
                            <td>{{(session()->get('language') =='bn')?(@$list['mp']['name_bn']):@$list['mp']['name']}}</td>
                            <td>{{(session()->get('language') =='bn')?(en2bn(date('d-m-Y',strtotime(@$list['date'])))):date('d-m-Y',strtotime(@$list['date']))}}</td>
                            <td>{{(session()->get('language') =='bn')?(@$list['area']['name_bn']):@$list['area']['name']}}</td>
                            <td>{{accommodation_status(@$list->status)}}</td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade {{(request()->reject)?('show active'):''}}" id="reject" role="tabpanel" aria-labelledby="reject-tab" style="padding: 0px 15px 0px 15px;">
                <table id="reject_table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">@lang('Serial')</th>
                            <th>@lang('Application Subject')</th>
                            <th>@lang('Applicant Name')</th>
                            <th>@lang('Expected Allocated Date')</th>
                            <th>@lang('Area')</th>
                            <th>@lang('status')</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($accommodation_application_rejects as $list)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{(session()->get('language') =='bn')?(@$list['accommodation_application_type']['name_bn']):@$list['accommodation_application_type']['name']}}</td>
                            <td>{{(session()->get('language') =='bn')?(@$list['mp']['name_bn']):@$list['mp']['name']}}</td>
                            <td>{{(session()->get('language') =='bn')?(en2bn(date('d-m-Y',strtotime(@$list['date'])))):date('d-m-Y',strtotime(@$list['date']))}}</td>
                            <td>{{(session()->get('language') =='bn')?(@$list['area']['name_bn']):@$list['area']['name']}}</td>
                            <td>{{accommodation_status(@$list->status)}}</td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">                     
    $(document).ready(function() {
        $('#pending_table').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
        });

        $('#approve_table').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
        });

        $('#reject_table').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
        });
    });
</script>