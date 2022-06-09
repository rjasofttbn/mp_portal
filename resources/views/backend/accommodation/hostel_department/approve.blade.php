@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Building and Flat</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Building and Flat</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->





    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Flat allocation</h5>
                    @foreach ($mpdata as $value )
                      <h6>Name: {{   $value->name }}</h6>
                    <h6> Constituency: {{ $value->constituencyname }} </h6>
                    @endforeach
                   


                </div>



                <!-- Form Start-->
                <form id="flatForm" name="flatForm" method="POST" action="{{url('admin/accommodation/applications/application/flat/approve_application_to_speaker')}}">
                   
                    @csrf

               {{--      <input type="hidden" id="id" name="id" value="{{$data->id}}"> --}}
                    <div class="card-body">
                        <div id="divtoadd">
                        <div id="childdivtoadd" class="row">


                            <div id="areatocopy" class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label" for="hostel_building_id">Hostel Building<span
                                            style="color: red;"> *</span></label>
                                    <select style="width:222px;" id="hostel_building_id" name="hostel_building_id" class="form-control @error('hostel_building_id') is-invalid @enderror">
                                        <option value="">Select Hostel Building</option>
                                        @foreach ($hostelBuildingList as $list)
                                           
                                              
                                                <option  value="{{$list->id}}">{{$list->name}}</option>
                                      
                                        @endforeach
                                    </select>

                                    @error('hostel_building_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                         

                           




                       

                         

                        </div>

                        <div class="row" >


                        <div class="col-sm-2">
                        <p  id="totalofficeroom"></p>
                        </div>
                        <div class="col-sm-2">
                        <p id="allocatedofficeroom"></p>

                        </div>
                        <div class="col-sm-2">
                        <p id="availableofficeroom"></p>

                        </div>

                        </div>



                    </div>
                          


                            <input type="hidden" name="accommodation_application_id" id="accommodation_application_id" value="{{$hostel_application_id}}">
            
                    
                            <table id="dataTable" class="table table-sm table-bordered table-striped">
                                <thead>
                                <tr>
                                 
                                    <th width="8%">@lang('Serial')</th>
                                   <th>@lang('Office Room Number')</th>                                   
                                    <th>@lang('Room Type')</th>
                                    <th>@lang('Block No')</th>
                                   <th>@lang('status')</th>
                                    <th>@lang('Allocated to')</th>
                                    <th>@lang('Action')</th> 



                                  

                            
                            
                            
                                   
                                   
                                </tr>
                                </thead>
                                <tbody>
                            
                             
                            
                              
                            
                                </tbody>
                            </table>
                            

                      

                    </div>
                </form>
                <!--Form End-->
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
           
 
   
           

            document.getElementById('totalofficeroom').innerHTML = 'Total Office Room: ';

            document.getElementById('allocatedofficeroom').innerHTML = 'Allocated Office Room: ';


            document.getElementById('availableofficeroom').innerHTML = 'Available Office Room: ';


            
           
         




            $('select[name="hostel_building_id"]').on('change', function () {
                var hostel_building_id = $(this).val();

                


                if (hostel_building_id > 0) {
                   

                    $.ajax({
                        url: '{{url("hostelOfficeRoomListByHostelBuildingId")}}',
                        data:{hostel_building_id:hostel_building_id},
                        type: "GET",
                        dataType: "json",
                        beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },
                        success: function (result) {

                            $("#dataTable tbody").html("");
                            var i=1;
                            console.log(result);

                           
                            $.each(result.officeroomdata, function (k, val) {

                                document.getElementById('totalofficeroom').innerHTML = 'Total Office Room: '+val.totalofficeroom;

                                document.getElementById('allocatedofficeroom').innerHTML = 'Allocated Office Room: '+val.allocatedofficeroom;


                                document.getElementById('availableofficeroom').innerHTML = 'Available Office Room: '+val.availableofficeroom;

                                
                                

                            });
                             


                            $.each(result.data, function (k, val) {

                                if(val.availability==0){
                                    var status='<span style="color:red">Allocated</span>';
                                    var allocationdetails=val.name+'<br/>'+val.constituencyname+'<br/>'+val.allocateddate;

                                    var action='<button disabled style="border-radius:7px;background:gray;padding:6px;color:white">Allocated</button>';

                                }
                               else{
                                var status='<span style="color:green">Available</span>';
                                var allocationdetails='';
                                var action='<button type="button" class="confirm" style="border-radius:7px;background:green;padding:6px;color:white" value="'+val.id+'" >Allocate</button>';


                                }
                                if(val.applystatus==1){
                                    var status='<span style="color:red">Assigned</span>';
                                    var allocationdetails='';

                                    var action='<button disabled style="border-radius:7px;background:gray;padding:6px;color:white">Assigned</button>';

                                }
                           
                                
                              

                                
                                 $('#dataTable').append('<tr><td>'+i+'</td><td>'+val.number+'</td><td>'+val.officeroomtypename+'</td><td>'+val.floorname+'</td><td>'+status+'</td><td>'+allocationdetails+'</td><td>'+action+'</td><tr>'); 


                                    i++;
                           //    $('#flat_list').append('<option value="' + val.id + '">' + val.number + '</option>');
                            });
                        },
                        complete: function () {
                            //$('#loader').css("visibility", "hidden");
                        }
                    });
                } else {
                  

                    $("#dataTable tbody").html("");

                $('#dataTable').append('<tr><td> No Data Found</td></tr>');




               
                }

            });


 


            $(document).on('click', '.confirm', function() {
      var btn = this;
      Swal.fire({
        title: 'Select Allocation Date',
        type: 'question',
        html:'<input id="datepicker" class="form-control" autofocus>',
  customClass: 'swal2-overflow',
  
  onOpen:function(){
	$('#datepicker').datepicker({
        autoclose: true,
       
           
	});




  },
  
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, allocate it!'
      }).then((result) => {
        console.log(result);
        if (result.value) {
         
          var id = $(this).attr("value");
          var appid=  {{ request()->get('id') }};
          var mpid=  {{ request()->get('mpid') }};
          var allocateddate= $('#datepicker').val();
          
           
          var _token = "{{csrf_token()}}";
          

          $.ajax({
            url: '{{url("confirmApplicationByHostelDepartment")}}',
            type: "get",
            data: {
            
              id:id,
              mpid:mpid,
              appid:appid,
              allocateddate:allocateddate
        
            },
            success: function(response) {
              if (response.status == 'success') {
                Swal.fire({
                  title: 'Applicaton Confirmed',
                  text: "Application has been confirmed!",
                  type: 'success'
                }).then((result) => {
                 
                    var loc =  String(window.location);
              var pos = loc.indexOf("hostel_application_monitoring");
           
   var urlpart= loc.slice(0, (pos+29));
   
           
            newloadurl= urlpart+'?approve=success';
            window.location.replace(newloadurl);

                    
                   



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







       
     


        });
    </script>

@endsection



