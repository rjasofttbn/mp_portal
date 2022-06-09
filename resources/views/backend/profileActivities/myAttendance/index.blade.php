@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('My Attendance')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Attendance Management')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <div class="content">
        <div class="col-md-12">
            <div class="card">
                {{--  <div class="card-header">
                      <h3>Select Area</h3>
                  </div>--}}
                <div class="card-body">
                    <form id="myAttendanceSearchForm"  name="myAttendanceSearchForm" class="form-horizontal" action="{{ route('admin.my-attendance-search') }}" method="get">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label class="control-label" for="parliament_id">@lang('Parliament')<span class="required">*</span></label>
                                <select id="parliament_id" name="parliament_id" class="form-control form-control-sm select2" required>
                                    <option value="0">@lang('All')</option>
                                    @foreach ($parliamentList as $list)
                                        @if($list['id']==old('parliament_id'))
                                            <option selected
                                                    value="{{$list['id']}}">{{$list['parliament_number']}}</option>
                                        @else
                                            <option  value="{{$list['id']}}">{{$list['parliament_number']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-4">
                                <label class="control-label" for="session_id">@lang('Parliament Session')<span class="required">*</span></label>
                                <select id="session_id" name="session_id" class="form-control form-control-sm select2" required>
                                    <option value="0">@lang('All')</option>

                                </select>
                            </div>
                            <div class="col-sm-3 mt-1">
                                <button type="button" class="btn btn-info btn-sm seachAttendance" style="margin-top:28px">
                                    <i class="ion-search"></i> @lang('Search')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>


        <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body">
                            <table id="dataTableAttendance" class="table table-sm table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>@lang('Serial')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Parliament')</th>
                                    <th>@lang('Parliament Session')</th>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Status')</th>
                                </tr>
                                </thead>
                                <tbody id="loadMyAttendanceList">

                                </tbody>
                            </table>




                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!--/. container-fluid -->
    </section>

        <script>

            function LoadAttendanceGrid() {
                search();
            }

            window.onload = LoadAttendanceGrid;

           /* $("#myAttendanceSearchForm").submit(function(e) {


                search();
            });*/

            $(".seachAttendance").click(function () {

                search();

            })


            function search() {

                //e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $("#myAttendanceSearchForm");
                var url = form.attr('action');
                var data = form.serialize();


                $.ajax({
                    type: "GET",
                    url: url,
                    data: data, // serializes the form's elements.
                    dataType: "json",
                    success: function (data) {
                        if (data.status) {
                            $("#loadMyAttendanceList").html(data.loadMyAttendanceListHtml);

                        } else {
                            $("#loadMyAttendanceList").html("");
                            toastr.error("", data.msg);
                            return false;
                        }
                    }
                });

            }

            //window.onload = search;




                // Author Rajan Bhatta: create date: 01-02-2021
                // Get Session List By parliament Id:

                $('select[name="parliament_id"]').on('change', function () {
                    var parliament_id = $(this).val();


                    $('select[name="session_id"]').empty();
                    $('select[name="session_id"]').append('<option value="0">All</option>');


                    if (parliament_id > 0) {
                        $.ajax({
                            url: '{{url("sessionListByParliamentId")}}',
                            data:{parliament_id:parliament_id},
                            type: "GET",
                            dataType: "json",
                            beforeSend: function () {
                                //$('#loader').css("visibility", "visible");
                            },
                            success: function (result) {
                                $.each(result.data, function (k, val) {
                                    $('select[name="session_id"]').append('<option value="' + val.id + '">' + val.session_no + '</option>');
                                });
                            },
                            complete: function () {
                                //$('#loader').css("visibility", "hidden");
                            }
                        });
                    } else {

                        $('select[name="session_id"]').empty();
                        $('select[name="session_id"]').append('<option value="0">All</option>');

                    }

                });


                // Load data After Filer





        </script>

@endsection


