@extends('backend.petitionManagement.layouts.app')
<style>
    .focusedInput {
        border-color: rgb(247 60 60) !important;
        outline: 0;
        outline: thin dotted \9;
        -moz-box-shadow: 0 0 3px rgba(255, 0, 0);
        box-shadow: 0 0 3px rgba(255,0,0) !important;
    }
</style>
@section('content')
    <div class="container">
        <div class="row mt-5 pt-5">
            <div id="petitionMonitoring" class="col-sm-12 col-md-6 col-lg-6 m-auto">
                <div class="card p-4">
                <h4 class="text-center">পিটিশন মনিটরিং</h4>
                <hr/>
                <form id="petitionMonitoringForm" method="POST" enctype="multipart/form-data" class="form-horizontal mt-3"  action="javascript:void(0)">

                        <div class="form-group">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input type="text"
                                    class="form-control formOnInput"
                                    name="petition_nid" 
                                    id="petition_nid" 
                                    placeholder="আবেদনকারীর এন আই ডি">


                                @error('petition_nid')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input type="text"
                                    class="form-control formOnInput"
                                    name="petition_mobile" 
                                    id="petition_mobile" 
                                    placeholder="আবেদনকারীর মোবাইল">


                                @error('petition_mobile')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group text-center">
                                    <button type="button" class="btn btn-dark btn-sm white-text">
                                        <a href="{{ url('/') }}">@lang('Back')</a>
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                    <button id="submitBtn" type="button" class="btn btn-success btn-sm">পাঠান</button>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="petitionMonitoringIndex" class="d-none col-sm-12 col-md-12 col-lg-12 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="d-inline-block float-left pt-2 mb-0">পিটিশন মনিটরিং</h5>
                        
                        <button id="backBtn" type="button" class="btn btn-dark btn-sm float-right"><i class='fas fa-backward'></i> @lang('Back')</button>
        
                    </div>
                </div>

                <div class="card">
                    <div class="card-body" style="padding: 50px;">
                        <h4 class="text-center mb-5">পিটিশন প্রতিবেদন তালিকা</h4>
                        
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="8%">ক্রমিক</th>
                                <th>আবেদনকারীর নাম</th>
                                <th>আবেদনকারীর এন আই ডি</th>
                                <th>আবেদনকারীর মোবাইল</th>
                                <th width="10%" class="text-center">স্ট্যাটাস</th>
                                <th width="10%" class="text-center">অ্যাকশন</th>
                            </tr>
                            </thead>
                            <tbody id="petition_table">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="petitionMonitoringView" class="d-none col-sm-12 col-md-12 col-lg-12 m-auto">

            </div>
        </div>
    </div>
    <script>
        $(function(){

            $('.formOnInput').on('keyup', function () {
                if ($.trim($('.formOnInput').val()).length) {
                    $(this).removeClass('focusedInput');
                }
            });

            
            $('#submitBtn').on('click', function () {
                var petition_nid       = $('#petition_nid').val();
                var petition_mobile    = $('#petition_mobile').val();

                if(petition_nid.length==0){
                    toastr.error('এনআইডি ফিল্ড প্রয়োজনীয়!');
                    $('#petition_nid').addClass('focusedInput');
                }else if(petition_mobile.length==0){
                    toastr.error('মোবাইল ফিল্ড প্রয়োজনীয়!');
                    $('#petition_mobile').addClass('focusedInput');
                }else{
                    $.ajax({
                        url: '{{url("petitionsMonitoringGetData")}}',
                        type: "GET",
                        dataType: "json",
                        data:{petition_nid:petition_nid, petition_mobile:petition_mobile},

                        success: function (response) {
                            
                            $('#petitionMonitoring').addClass('d-none');
                            $('#petitionMonitoringIndex').removeClass('d-none');

                            $('#petition_table').empty();
                        
                            var jsonData = response.data;
                            var url = "../petitions";
                            $.each(jsonData, function(i, item) {
                                $('<tr>').html(
                                    
                                    "<td>" + (i+1) + "</td>" +
                                    "<td>" + jsonData[i].applicant_name + "</td>" +
                                    "<td>" + jsonData[i].applicant_nid + "</td>" +
                                    "<td>" + jsonData[i].applicant_mobile + "</td>" +
                                    "<td class='text-center'>" + jsonData[i].status + "</td>" +
                                    "<td class='text-center'><a href="+ url +'/'+ jsonData[i].id +" class='petitionViewBtn btn btn-success btn-sm' data-id=" + jsonData[i].id + "> বিস্তারিত</a></td>"
                                ).appendTo('#petition_table');
                            });
                        
                        }
                    })
                }
                $('#backBtn').on('click', function () {
                    $('#petitionMonitoring').removeClass('d-none');
                    $('#petitionMonitoringIndex').addClass('d-none');
                }); 
                
                
                

            });
        });
    </script>
@endsection