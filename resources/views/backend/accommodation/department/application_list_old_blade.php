

@extends('backend.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Manage Accommodation Application')</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Manage Accommodation Application')</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row" style="padding-bottom: 5px;">
            <div class="col-sm-5">  
                <select id="applist" name="applicationlisttype" class="form-control form-control-sm">
                    <option value="">@lang('Select Application')</option>
                    @foreach ($accommodation_application_types as $value)
                    @if(session()->get('language') =='bn') 
                    <option value="{{ $value->id }}">{{  Lang::locale()=='bn'?$value->name_bn:$value->name}}</option>
                    @else
                    <option value="{{ $value->id }}">{{  Lang::locale()=='bn'?$value->name_bn:$value->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header text-left">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a  class="nav-link {{ request()->approve? "":"active" }} applicationdata" data-toggle="tab" href="#pending" >বিচারাধীন</a>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link applicationdata {{ request()->approve ? "active":"" }}" data-toggle="tab" href="#approved" >অনুমোদিত</a>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link applicationdata" data-toggle="tab" href="#rejected" >প্রত্যাখ্যাত</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <table  id="dt" class="table table-sm table-bordered table-striped">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        function dtdata(value1,value2,value3,value4,value5,value6,value7,value8,value9,value10,value11,value12,value13,value14,value15 ) {
            this._value1     = value1;
            this._value2     = value2;
            this._value3     = value3;
            this._value4     = value4;
            this._value5     = value5;
            this._value6     = value6;
            this._value7     = value7;
            this._value8     = value8;
            this._value9     = value9;
            this._value10     = value10;
            this._value11     = value11;
            this._value12     = value12;
            this._value13     = value13;
            this._value14     = value14;
            this._value15     = value15;
            this.value1 = function () {
                return this._value1;
            };
            this.value2 = function () {
                return this._value2;
            };
            this.value3 = function () {
                return this._value3;
            };
            this.value4 = function () {
                return this._value4;
            };
            this.value5 = function () {
                return this._value5;
            };
            this.value6 = function () {
                return this._value6;
            };
            this.value7 = function () {
                return this._value7;
            };
            this.value8 = function () {
                return this._value8;
            };
            this.value9 = function () {
                return this._value9;
            };
            this.value10 = function () {
                return this._value10;
            };
            this.value11 = function () {
                return this._value11;
            };
            this.value12 = function () {
                return this._value12;
            };
            this.value13 = function () {
                return this._value13;
            };
            this.value14 = function () {
                return this._value14;
            };
            this.value15 = function () {
                return this._value15;
            };
        }

var tbl = $('#dt').DataTable({
    "columnDefs": [
    { "title": "@lang('Serial')", "targets": 0 },
    { "title": "@lang('Application Subject')", "targets": 1 },
    { "title": "@lang('Applicant Name')", "targets": 2 },
    { "title": "@lang('Expected Allocated Date')", "targets": 3 },
    { "title": "@lang('Area')", "targets": 4 },
    { "title": "@lang('status')", "targets": 5 },
    { "title": "@lang('Action')", "targets": 6 },
    ],

    columns: [
    { data: null, render: 'value1' },
    { data: null, render: 'value2' },
    { data: null, render: 'value3' },
    { data: null, render: 'value4' },
    { data: null, render: 'value5' },
    { data: null, render: 'value6' },
    { data: null, render: 'value7' },
    ]
});

var applisttype=1;
$('select[name="applicationlisttype"]').on('change', function () {
   var applisttype= $("#applist option:selected").val();
   if(applisttype=='1'){
    var tbl = $('#dt').DataTable({
        "columnDefs": [
        { "title": "@lang('Serial')", "targets": 0 },
        { "title": "@lang('Application Subject')", "targets": 1 },
        { "title": "@lang('Applicant Name')", "targets": 2 },
        { "title": "@lang('Expected Allocated Date')", "targets": 3 },
        { "title": "@lang('Area')", "targets": 4 },
        { "title": "@lang('status')", "targets": 5 },
        { "title": "@lang('Action')", "targets": 6 },
        ],
        columns: [
        { data: null, render: 'value1' },
        { data: null, render: 'value2' },
        { data: null, render: 'value3' },
        { data: null, render: 'value4' },
        { data: null, render: 'value5' },
        { data: null, render: 'value6' },
        { data: null, render: 'value7' },
        ]
    });
    var dataurl='{{url("applicationListByAccommodationDepartment")}}';
}
if(applisttype=='2'){
    var table = $('#dt').DataTable({
        "columnDefs": [
        { "title": "col1", "targets": 0 }
        ],

        columns: [
        { data: null, render: 'value1' },
        ]
    });
    var dataurl='{{url("applicationListByAccommodationDepartment")}}';
}
if(applisttype=='3'){
    var table = $('#dt').DataTable({
        "columnDefs": [
        { "title": "col1", "targets": 0 }
        ],
        columns: [
        { data: null, render: 'value1' },
        ]
    });
    var dataurl='{{url("applicationListByAccommodationDepartment")}}';
}
if(applisttype=='4'){
    var table = $('#dt').DataTable({
        "columnDefs": [
        { "title": "col1", "targets": 0 }
        ],
        columns: [
        { data: null, render: 'value1' },
        ]
    });
    var dataurl='{{url("applicationListByAccommodationDepartment")}}';
}
if(applisttype=='5'){
    var table = $('#dt').DataTable({
        "columnDefs": [
        { "title": "col1", "targets": 0 }
        ],
        columns: [
        { data: null, render: 'value1' },
        ]
    }); 
    var dataurl='{{url("applicationListByAccommodationDepartment")}}';
}
if(applisttype=='6'){
    var table = $('#dt').DataTable({
        "columnDefs": [
        { "title": "col1", "targets": 0 }
        ],
        columns: [
        { data: null, render: 'value1' },
        ]
    });
    var dataurl='{{url("applicationListByAccommodationDepartment")}}';
}


         //application type ajax data
         $.ajax({
            url: dataurl,
            data:{applisttype},
            type: "GET",
            dataType: "json",
            beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },
                        success: function (result) {
                            $.each(result.data, function (k, val) {


                                if(val.status==5){
                                    applicationstatus = "@lang('Whip Approved')";
                                }
                                if(val.status==6){
                                    applicationstatus = "@lang('Waiting for approval')";


                                }
                                if(val.status==1){                                
                                    applicationstatus = "@lang('Pending')";

                                }
                                @php
                                if(Lang::locale()=='bn'){
                                 echo 'applicationsubject= val.applicationsubject_bn;
                                 mpname= val.mpname_bn;
                                 applicationdate=val.applicationdate;
                                 areaname=val.areaname_bn;












                                 ';
                                 

                             }
                             else{
                                 echo 'applicationsubject= val.applicationsubject;
                                 mpname= val.mpname;
                                 applicationdate=val.applicationdate;
                                 areaname=val.areaname;










                                 ';
                             }

                             @endphp

















                         });
                        },
                        complete: function () {
                            //$('#loader').css("visibility", "hidden");
                        }
                    });


                 //   table.draw();


             });





let searchParams = new URLSearchParams(window.location.search);

let approve = searchParams.get('approve');




var i=1;
var type = $(this).attr("href");

var url='<a href="">';
var baseurl =  String(window.location);




url=baseurl+'/flat/approve_application';
cancelurl=baseurl+'/flat/cancel_application/';





        // true

        if( !(searchParams.has('approve'))){
            var start =1;


            $.ajax({
                url: '{{url("applicationListByAccommodationDepartment")}}',
                data:{start:start,applisttype},
                type: "GET",
                dataType: "json",
                beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },
                        success: function (result) {
                            $.each(result.data, function (k, val) {


                                if(val.status==5){
                                    applicationstatus = "@lang('Whip Approved')";
                                }
                                if(val.status==6){
                                    applicationstatus = "@lang('Waiting for approval')";


                                }
                                if(val.status==1){                                
                                    applicationstatus = "@lang('Pending')";

                                }
                                @php
                                if(Lang::locale()=='bn'){
                                 echo 'applicationsubject= val.applicationsubject_bn;
                                 mpname= val.mpname_bn;
                                 applicationdate=val.applicationdate;
                                 areaname=val.areaname_bn;












                                 ';
                                 

                             }
                             else{
                                 echo 'applicationsubject= val.applicationsubject;
                                 mpname= val.mpname;
                                 applicationdate=val.applicationdate;
                                 areaname=val.areaname;










                                 ';
                             }

                             @endphp












                             tbl.row.add( new dtdata( i++,applicationsubject,mpname,applicationdate,areaname,applicationstatus,'<a style="margin-left:10px;" class="btn btn-sm btn-info" href="'+url+'?id='+val.id+'&mpid='+val.mpid+'"><i class="fa fa-check"></i></a>'+'<button style="margin-left:5px;" class="btn btn-sm btn-danger cancel" value="'+cancelurl+val.id+'"><i class="fa fa-times"></i></button>'

                               ) ).draw( false ); 












                         });
                        },
                        complete: function () {
                            //$('#loader').css("visibility", "hidden");
                        }
                    });


            tbl.draw();


        }
                    //after confirm

                    


                    if(approve=='success'){






                        var i=1;









   // var tbl = $('#newflatdt').DataTable();
   tbl.clear().draw();
   $.ajax({
    url: '{{url("applicationListByAccommodationDepartment")}}',
    data:{approve:approve},
    type: "GET",
    dataType: "json",
    beforeSend: function () {
                        //$('#loader').css("visibility", "visible");
                    },
                    success: function (result) {
                        $.each(result.data, function (k, val) {

                            if(val.status==5){
                                applicationstatus = "@lang('Whip Approved')";
                            }
                            if(val.status==9){
                                applicationstatus = "@lang('Waiting for approval')";

                                
                            }

                            @php
                            if(Lang::locale()=='bn'){
                             echo 'applicationsubject= val.applicationsubject_bn;
                             mpname= val.mpname_bn;
                             applicationdate=val.applicationdate;
                             areaname=val.areaname_bn;












                             ';
                             

                         }
                         else{
                             echo 'applicationsubject= val.applicationsubject;
                             mpname= val.mpname;
                             applicationdate=val.applicationdate;
                             areaname=val.areaname;










                             ';
                         }

                         @endphp

                         

                         




                         tbl.row.add( [
                            i++,
                            applicationsubject,
                            mpname,
                            applicationdate,
                            areaname,
                            applicationstatus, 
                            '<a class="btn btn-sm btn-info" href="#"><i class="fa fa-eye"></i></a>'
                            ,



                            ] ).draw( false );









                     });
                    },
                    complete: function () {
                        //$('#loader').css("visibility", "hidden");
                    }
                });












}









$(".applicationdata").click(function(){



    var i=1;
    var type = $(this).attr("href");

    var url='<a href="">';
    var baseurl =  String(window.location);



    pendingurl=baseurl+'/flat/approve_application/';
    cancelurl=baseurl+'/flat/cancel_application/';




    tbl.clear().draw();
    $.ajax({
        url: '{{url("applicationListByAccommodationDepartment")}}',
        data:{type:type},
        type: "GET",
        dataType: "json",
        beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },
                        success: function (result) {
                            $.each(result.data, function (k, val) {


                                if(val.status==5){
                                    applicationstatus = "@lang('Whip Approved')";
                                }
                                if(val.status==6){
                                    applicationstatus = "@lang('Waiting for approval')";


                                }
                                if(val.status==1){                                
                                    applicationstatus = "@lang('Pending')";

                                }
                                @php
                                if(Lang::locale()=='bn'){
                                 echo 'applicationsubject= val.applicationsubject_bn;
                                 mpname= val.mpname_bn;
                                 applicationdate=val.applicationdate;
                                 areaname=val.areaname_bn;












                                 ';
                                 

                             }
                             else{
                                 echo 'applicationsubject= val.applicationsubject;
                                 mpname= val.mpname;
                                 applicationdate=val.applicationdate;
                                 areaname=val.areaname;










                                 ';
                             }

                             @endphp

                             if(type=='#rejected'){

                                tbl.row.add( [
                                    i++,
                                    applicationsubject,
                                    mpname,
                                    applicationdate,
                                    areaname,
                                    'Rejected',    
                                    '<a class="btn btn-sm btn-info" href="#"><i class="fa fa-eye"></i></a>'




                                    ] ).draw( false );

                            }

                            if(type=='#pending'){

                                tbl.row.add( [
                                    i++,
                                    applicationsubject,
                                    mpname,
                                    applicationdate,
                                    areaname,
                                    applicationstatus,    
                                    '<a class="btn btn-sm btn-info" href="'+pendingurl+'?id='+val.id+'&mpid='+val.mpid+'"><i class="fa fa-check"></i></a>'+
                                    '<button style="margin-left:5px;" class="btn btn-sm btn-danger cancel" value="'+cancelurl+val.id+'"><i class="fa fa-times"></i></button>'
                                    



                                    ] ).draw( false );

                            }


                            if(type=='#approved'){

                                tbl.row.add( [
                                    i++,
                                    applicationsubject,
                                    mpname,
                                    applicationdate,
                                    areaname,
                                    applicationstatus, 
                                    '<a class="btn btn-sm btn-info" href="#"><i class="fa fa-eye"></i></a>'
                                    ,



                                    ] ).draw( false );

                            }







                        });
},
complete: function () {
                            //$('#loader').css("visibility", "hidden");
                        }
                    });








});



$(document).on('click', '.cancel', function() {
  var btn = this;
  Swal.fire({
    title: 'Are you sure to cancel this application?',
    text: "Cancel Reason",
    type: 'warning',
    input: 'textarea',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, cancel it!'
}).then((result) => {


  var url = $(this).val();

  var reason= result.value;
  var _token = "{{csrf_token()}}";
  $.ajax({
    url: url,
    type: "get",
    data: {
      _token: _token,
      reason: reason

  },
  success: function(response) {
      if (response.status == 'success') {
        Swal.fire({
          title: 'Cancelled',
          text: "Application has been Cancelled!",
          type: 'success'
      }).then((result) => {

        window.setTimeout(function(){window.location.reload()}, 1000);



    });
  } 




  else {
    Swal.fire('Cancel error', '', 'error');
}
}
});

})
});














});





</script>



@endsection








