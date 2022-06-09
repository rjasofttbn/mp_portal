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

<div class="content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>@lang('All Notice')</h4>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <div class="col-3">
                        <select name="parliament_session_id" id="parliament_session_id" readonly class="form-control select2" style="width:100%">
                            <option value="">@lang('Parliament Session')</option>
                            @foreach($parliament_session_list as $s)
                            <option value="{{$s->id}}">{{Lang::get($s->session_no)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <select name="report_type" id="report_type" readonly class="form-control select2" style="width:100%">
                            <option value="">@lang('Select Report Type')</option>
                            @foreach($report_types as $r)
                            <option value="{{$r['type']}}">{{$r['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--  <label class="control-label col-1" for="list_parliament_session_id">@lang('Date')<span style="color: red;"></span></label> -->
                    <div class="col-3">
                        <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span> <i class="fa fa-caret-down"></i>
                        </div>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-info" onClick="load_report('html')">@lang('GO')</button>
                    </div>
                </div>
                <div style="border: 1px solid #ddd; padding: 30px;" id="list_container">

                </div>
            </div>
        </div>

        <script>
            function load_report(type) {
                if (type == 'pdf') {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}"
                        }
                    });
                    $.ajax({
                        type: "POST",
                        crossDomain: true,
                        data: JSON.stringify({
                            date: $('#reportrange').text().trim(),
                            doc_type: type,
                            report_type: $("#report_type").val(),
                            //report_title: $("#report_type").text(),
                            parliament_session_id: $("#parliament_session_id").val()
                        }),
                        url: "{{url('/admin/notice-management/notices/notice/report')}}",
                        contentType: "application/json",
                        success: function(data) {
                            const linkSource = data;
                            const downloadLink = document.createElement("a");
                            const fileName = $("#report_type").val() + "_" + Date() + ".pdf";
                            downloadLink.href = linkSource;
                            downloadLink.download = fileName;
                            downloadLink.click();
                        }

                    });
                } else {
                    $('#list_container').html('<center><img src="{{asset("public/images/lottery.gif")}}"></center>');
                    $.ajax({
                        url: "{{url('/admin/notice-management/notices/notice/report')}}",
                        type: "POST",
                        data: {
                            _token: "{{csrf_token()}}",
                            date: $('#reportrange').text().trim(),
                            doc_type: type,
                            report_type: $("#report_type").val(),
                            parliament_session_id: $("#parliament_session_id").val()
                        },
                        success: function(response) {
                            response = JSON.parse(response);
                            if (response.status == true) {
                                $('#list_container').html(response.data);
                                $("#list_table").DataTable({

                                });
                            } else {
                                Swal.fire('@lang("No Data Found")', '', 'error');
                                $('#list_container').html('');
                            }
                        }
                    });
                }

            }
        </script>
        <script type="text/javascript">
            $(function() {

                var start = moment().subtract(29, 'days');
                var end = moment();

                function cb(start, end) {
                    $('#reportrange span').html(start.format('D-MM-YYYY') + ' ~ ' + end.format('D-MM-YYYY'));
                }

                $('#reportrange').daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }
                }, cb);

                cb(start, end);

            });
        </script>
        <script>
            function exportDoc() {
                //$("#list_table").DataTable({ }).destroy();
                var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' " +
                    "xmlns:w='urn:schemas-microsoft-com:office:word' " +
                    "xmlns='http://www.w3.org/TR/REC-html40'>" +
                    "<head><meta charset='utf-8'><title>"+$("#report_type").val()+"</title></head><body>";
                var footer = "</body></html>";
                var sourceHTML = header + document.getElementById("list_container").innerHTML + footer;

                var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
                var fileDownload = document.createElement("a");
                document.body.appendChild(fileDownload);
                fileDownload.href = source;
                fileDownload.download = $("#report_type").val() + "_" + Date() + ".doc";
                fileDownload.click();
                document.body.removeChild(fileDownload);
            }
        </script>
        @endsection