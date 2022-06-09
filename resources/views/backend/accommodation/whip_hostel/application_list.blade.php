

@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Manage Accommodation Application')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Manage Accommodation Application')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header text-left">
                           
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a  class="nav-link {{ request()->approve? "":"active" }} applicationdata" data-toggle="tab" href="#pending" >বিচারাধীন</a>
                                </li>
                                <li class="nav-item">
                                    <a  class="nav-link {{ request()->approve ? "active":"" }} applicationdata" data-toggle="tab" href="#approved" >অনুমোদিত</a>
                                </li>
                                <li class="nav-item">
                                    <a  class="nav-link applicationdata" data-toggle="tab" href="#rejected" >প্রত্যাখ্যাত</a>
                                </li>
                            </ul>
                         
                            
                        </div>
                        <div class="card-body">
                            <table id="dt" class="table table-sm table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('Serial')</th>                    
                                    <th>@lang('Application Type')</th>
                                    <th>@lang('Applicant Information')</th>                                  
                                    <th>@lang('Hostel Building')</th>  
                                    <th>@lang('Floor Number')</th>  
                                    <th width="7%">@lang('Office Room Number')</th>  
                                    <th width="8%">@lang('Room Type')</th>  
                                    <th width="8%">@lang('Allocated Date')</th>                              
                                    <th>@lang('Status')</th>
                                    <th class="text-center">@lang('Action')</th>
                                </tr>
                                </thead>
                                <tbody>                   
                                   
                              
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

$(document).ready(function(){



  let searchParams = new URLSearchParams(window.location.search);
                   
                   let approve = searchParams.get('approve');



    
   
   var j=1;
       var type = $(this).attr("href");
       
      var url='<a href="">';
       var baseurl =  String(window.location);
        
       confirmurl=baseurl+'/hostel/approve_application_by_whip/';

      
       updateurl=baseurl+'/hostel/whip_edit_application';
       cancelurl=baseurl+'/hostel/cancel_application_by_whip/';
       
       

       
    
       
    var tbl = $('#dt').DataTable();
     
    if( !(searchParams.has('approve'))){
      var start=1;

       $.ajax({
           url: '{{url("hostelApplicationListForWhip")}}',
           data:{type:type,start:start},
                       type: "GET",
                       dataType: "json",
                       beforeSend: function () {
                           //$('#loader').css("visibility", "visible");
                       },
                       success: function (result) {



                               for (var i = 0; i < result.data.length; i++) {
                             
                            


                                 var applicationsubject=  result.data[i].applicationsubject;
                                 var applicationid =  result.data[i].id;
                                 var mpid =  result.data[i].mpid;
                                 var mpname =  result.data[i].mpname;
                                  var allocatedate =   result.data[i].date;
                                    var constituencyname =   result.data[i].constituencyname;                                    
                                    var hostelbuildingname =  result.data2[i].hostelbuildingname;
                                    var hostelfloorname =  result.data2[i].hostelfloorname;
                                    var officeroomnumber =  result.data2[i].officeroomnumber;
                                    var officeroomtype =  result.data2[i].officeroomtype;
                                    var officeroomid =  result.data2[i].officeroomid;





                                 
                                  
                                  

                                   tbl.row.add( [
                                       j++,
                                       applicationsubject,
                                       mpname+'<br/>'+constituencyname,
                                       hostelbuildingname,
                                       hostelfloorname,
                                       officeroomnumber,
                                       officeroomtype,
                                        allocatedate,
                                       'Pending for approval',                                                                             
                                      
                                       '<button id="'+officeroomid+'" class="btn btn-sm btn-success confirm" value="'+confirmurl+applicationid+'"><i class="fa fa-check"></i></button>'+
                                       '<a style="margin-left:5px;" class="btn btn-sm btn-info" href="'+updateurl+'?id='+applicationid+'&mpid='+mpid+'"><i class="fa fa-edit"></i></a>'+
                                       '<button style="margin-left:5px;" class="btn btn-sm btn-danger cancel" value="'+cancelurl+applicationid+'"><i class="fa fa-times"></i></button>'




                                   ] ).draw( false );

                                   


                           
                        
                               




                               }
                       },
                       complete: function () {
                           //$('#loader').css("visibility", "hidden");
                       }
                   });


                  }





                  if(approve=='success'){

                    $.ajax({
           url: '{{url("hostelApplicationListForWhip")}}',
           data:{approve:approve},
                       type: "GET",
                       dataType: "json",
                       beforeSend: function () {
                           //$('#loader').css("visibility", "visible");
                       },
                       success: function (result) {



                     




                               for (var i = 0; i < result.data.length; i++) {
                             
                                   
                           
                              
                          

                           

                                   

                                    var applicationsubject=  result.data[i].applicationsubject;
                                 var applicationid =  result.data[i].id;
                                 var mpid =  result.data[i].mpid;
                                 var mpname =  result.data[i].mpname;
                                  var allocatedate =   result.data[i].date;
                                    var constituencyname =   result.data[i].constituencyname;                                    
                                    var hostelbuildingname =  result.data2[i].hostelbuildingname;
                                    var hostelfloorname =  result.data2[i].hostelfloorname;
                                    var officeroomnumber =  result.data2[i].officeroomnumber;
                                    var officeroomtype =  result.data2[i].officeroomtype;
                                   var applicationstatus= 'Approved';
                                  

                                   tbl.row.add( [
                                    j++,
                                    applicationsubject,
                                       mpname+'<br/>'+constituencyname,
                                       hostelbuildingname,
                                       hostelfloorname,
                                       officeroomnumber,
                                       officeroomtype,
                                        allocatedate,
                                       applicationstatus,                                                                              
                                      
                                   '<button class="btn btn-sm btn-info" value=""><i class="fa fa-eye"></i></button>'
                                      
                                   



                                   ] ).draw( false );

                                   

                        
                               




                               }
                       },
                       complete: function () {
                           //$('#loader').css("visibility", "hidden");
                       }
                   });



                  }





















    $(".applicationdata").click(function(){
   
   var j=1;
       var type = $(this).attr("href");
       
      var url='<a href="">';
       var baseurl =  String(window.location);
      
       confirmurl=baseurl+'/hostel/approve_application_by_whip/';

       updateurl=baseurl+'/hostel/whip_edit_application';
       cancelurl=baseurl+'/hostel/cancel_application_by_department/';

       
           
       
       var tbl = $('#dt').DataTable();
       tbl.clear().draw();
       $.ajax({
           url: '{{url("hostelApplicationListForWhip")}}',
           data:{type:type},
                       type: "GET",
                       dataType: "json",
                       beforeSend: function () {
                           //$('#loader').css("visibility", "visible");
                       },
                       success: function (result) {



                     




                               for (var i = 0; i < result.data.length; i++) {
                             
                                   
                           
                              
                                if(type=='#rejected'){

                                  var applicationsubject=  result.data[i].applicationsubject;
                                 var applicationid =  result.data[i].id;
                                 var mpid =  result.data[i].mpid;
                                 var mpname =  result.data[i].mpname;
                                  var allocatedate =   result.data[i].date;
                                    var constituencyname =   result.data[i].constituencyname;                                    
                                    var hostelbuildingname =  result.data2[i].hostelbuildingname;
                                    var hostelfloorname =  result.data2[i].hostelfloorname;
                                    var officeroomnumber =  result.data2[i].officeroomnumber;
                                    var officeroomtype =  result.data2[i].officeroomtype;
                                 
                                  

                                   tbl.row.add( [
                                    j++,
                                    applicationsubject,
                                       mpname+'<br/>'+constituencyname,
                                       hostelbuildingname,
                                       hostelfloorname,
                                       officeroomnumber,
                                       officeroomtype,
                                        allocatedate,
                                       'Rejected',                                                                            
                                      
                                   '<button class="btn btn-sm btn-info" value=""><i class="fa fa-eye"></i></button>'




                                   ] ).draw( false );

                               } 

                               if(type=='#pending'){


                                var applicationsubject=  result.data[i].applicationsubject;
                                 var applicationid =  result.data[i].id;
                                 var mpid =  result.data[i].mpid;
                                 var mpname =  result.data[i].mpname;
                                  var allocatedate =   result.data[i].date;
                                    var constituencyname =   result.data[i].constituencyname;                                    
                                    var hostelbuildingname =  result.data2[i].hostelbuildingname;
                                    var hostelfloorname =  result.data2[i].hostelfloorname;
                                    var officeroomnumber =  result.data2[i].officeroomnumber;
                                    var officeroomtype =  result.data2[i].officeroomtype;
                                    var officeroomid =  result.data2[i].officeroomid;

                                  
                                  

                                   tbl.row.add( [
                                    j++,
                                    applicationsubject,
                                       mpname+'<br/>'+constituencyname,
                                       hostelbuildingname,
                                       hostelfloorname,
                                       officeroomnumber,
                                       officeroomtype,
                                        allocatedate,
                                       'Pending for approval',                                                                              
                                      
                                       '<button id="'+officeroomid+'" class="btn btn-sm btn-success confirm" value="'+confirmurl+applicationid+'"><i class="fa fa-check"></i></button>'+
                                       '<a style="margin-left:5px;" class="btn btn-sm btn-info" href="'+updateurl+'?id='+applicationid+'&mpid='+mpid+'"><i class="fa fa-edit"></i></a>'+
                                       '<button style="margin-left:5px;" class="btn btn-sm btn-danger cancel" value="'+cancelurl+applicationid+'"><i class="fa fa-times"></i></button>'





                                   ] ).draw( false );

                                   }


                                   if(type=='#approved'){

                                    var applicationsubject=  result.data[i].applicationsubject;
                                 var applicationid =  result.data[i].id;
                                 var mpid =  result.data[i].mpid;
                                 var mpname =  result.data[i].mpname;
                                  var allocatedate =   result.data[i].date;
                                    var constituencyname =   result.data[i].constituencyname;                                    
                                    var hostelbuildingname =  result.data2[i].hostelbuildingname;
                                    var hostelfloorname =  result.data2[i].hostelfloorname;
                                    var officeroomnumber =  result.data2[i].officeroomnumber;
                                    var officeroomtype =  result.data2[i].officeroomtype;
                                   var applicationstatus= 'Approved';
                                  

                                   tbl.row.add( [
                                    j++,
                                    applicationsubject,
                                       mpname+'<br/>'+constituencyname,
                                       hostelbuildingname,
                                       hostelfloorname,
                                       officeroomnumber,
                                       officeroomtype,
                                        allocatedate,
                                       applicationstatus,                                                                              
                                      
                                   '<button class="btn btn-sm btn-info" value=""><i class="fa fa-eye"></i></button>'
                                      
                                   



                                   ] ).draw( false );

                                   }

                        
                               




                               }
                       },
                       complete: function () {
                           //$('#loader').css("visibility", "hidden");
                       }
                   });








 });












  $(document).on('click', '.confirm', function() {
    
      Swal.fire({
        title: 'Are you sure to approve this application?',
    
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, confirm it!'
      }).then((result) => {
        
        if (result.value) {
          var url = $(this).val();
          var officeroomid=this.id;
          
          
          var _token = "{{csrf_token()}}";
          $.ajax({
            url: url,
            type: "get",
            data: {
              _token: _token,
              officeroomid: officeroomid
            

            },
            success: function(response) {
              if (response.status == 'success') {
                Swal.fire({
                  title: 'Application Confirmed',
                  text: "Application has been Confirmed!",
                 type:'success'
                }).then((result) => {
                 
                    window.setTimeout(function(){window.location.reload()}, 1000);



                });
              } 
              
          
              
              
              else {
                Swal.fire('Approve error', '', 'error');
              }
            }
          });
        } else {
         
        }
      })
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
        
        if (result.value) {
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
                  type: 'warning'
                }).then((result) => {
                 
                    window.setTimeout(function(){window.location.reload()}, 1000);



                });
              } 
              
          
              
              
              else {
                Swal.fire('Cancel error', '', 'error');
              }
            }
          });
        } else {
         
        }
      })
    });








});
    
    
    
   
    
    </script>
    


@endsection








