<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css">
    body {
        font-family: 'nikosh', Poppins, sans-serif;
    }

    .head_title_acc {
        font-size: 20px;
        line-height: 20px;
        margin-bottom: 0px;
    }

    .header_content_acc {
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
        {!! $acc_head !!}
    </div>
  
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
       
            <tr>
                <td valign="top">{{ digitDateLang($loop->iteration) }}</td>
                <td valign="top">{{ digitDateLang($list->bill_topic) }}</td>
                <td valign="top">{{ digitDateLang($list->total_notice) ?? '' }}</td>
                <td valign="top">{{ $list->mp_names ?? '' }}</td>
            </tr>
         
        </tbody>
    </table>

</body>

</html>