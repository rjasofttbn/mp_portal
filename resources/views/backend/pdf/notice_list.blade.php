<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css">
    body {
        font-family: 'nikosh', Poppins, sans-serif;
    }

    .notice_head_title {
        font-size: 20px;
        line-height: 20px;
        margin-bottom: 0px;
    }

    .notice_header_content {
        font-size: 16px;
        margin-top: 15px;
        margin-bottom: 15px;
    }

    table thead tr th {
        border-right: 1px solid #000000;
        border-bottom: 1px solid #000000;
        border-top: 1px solid #000000;
    }

    table thead tr:first-child {
        border-left: 1px solid #000000;
    }

    table tbody tr:last-child {
        border-right: 1px solid #000000;
        border-left: 1px solid #000000;
        border-bottom: 1px solid #000000;
    }
</style>

<body>
    <div class="header_section" style="text-align:center;">
        {!! $notice_head !!}
    </div>

    @if(isset($summary_view))
    <table class="table table-sm table-bordered table-striped">
        <thead>
            <tr style="border:1px solid;">
                <th width="5%">@lang('Serial')</th>
                <th width="30%">@lang('Topic')</th>
                <th width="15%">@lang('Total')</th>
                <th width="30%">@lang('Mp')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($summary_list as $list)
            <tr>
                <td valign="top">{{ digitDateLang($loop->iteration) }}</td>
                <td valign="top">{{ digitDateLang($list->bill_topic) }}</td>
                <td valign="top">{{ digitDateLang($list->total_notice) ?? '' }}</td>
                <td valign="top">{{ $list->mp_names ?? '' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <table class="table table-sm table-bordered table-striped">
        <thead>
            <tr style="border:1px solid;">
                <th width="5%">@lang('Serial')</th>
                <th width="5%">@lang('RD No.')</th>
                <th width="15%">@lang('MP')</th>
                <th width="30%">@lang('Subject')</th>
                <th width="13%">@lang('Comments')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notice_list as $data)
            <tr>
                <td valign="top">{{ digitDateLang($loop->iteration) }}</td>
                <td valign="top">{{ digitDateLang($data->rd_no) }}</td>
                <td valign="top">{{ $data->from_user_name ?? '' }}</td>
                <td valign="top">{!! $data->topic !!}</td>
                <td>{{ $data->comments }} <br> @if($data->acceptance_tag==1) @lang('Acceptable') @else @lang('Acceptable with Correction') @endif</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

</body>

</html>