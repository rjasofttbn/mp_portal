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
                    <h5>Update Flat allocation</h5>
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
                                    <label class="control-label" for="area_id">Area<span
                                            style="color: red;"> *</span></label>
                                    <select id="area_id" name="area_id" class="form-control @error('area_id') is-invalid @enderror">
                                        <option value="">Select Area</option>
                                        @foreach ($areaList as $list)
                                           
                                              
                                                <option 
                                                @if($list['id']== $proposedAreaId)
                                                    selected
                                                    @endif

                                                 value="{{$list['id']}}">{{$list['name']}}</option>
                                      
                                        @endforeach
                                    </select>

                                    @error('area_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label" for="building_id">Building<span
                                            style="color: red;"> *</span></label>
                                    <select id="building_id" name="building_id" class="form-control @error('building_id') is-invalid @enderror">
                                        <option value="">Select Building</option>
                                        @foreach ($buildingData as $list)
                                           
                                              
                                        <option 
                                        @if($list->id== $proposedBuildingId)
                                            selected
                                            @endif

                                         value="{{$list->id}}">{{$list->name}}</option>
                              
                                @endforeach
                                    </select>

                                    @error('building_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                           




                       

                         

                        </div>

                   



                    </div>
                          


                            <input type="hidden" name="accommodation_application_id" id="accommodation_application_id" value="{{$accommodation_application_id}}">
            
                    
                            <table id="dataTable" class="table table-sm table-bordered table-striped">
                                <thead>
                                <tr>
                                 
                                    <th width="8%">@lang('Serial')</th>
                                   <th>@lang('Flat No')</th>
                                    <th>@lang('Floor Number')</th>
                                    <th>@lang('Flat Size')</th>
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

            
           
            
            

            $('select[name="area_id"]').on('change', function () {
                var area_id = $(this).val();

                $('select[name="building_id"]').empty();
                $('select[name="building_id"]').append('<option value="">Select Building</option>');


                if (area_id > 0) {

                    $.ajax({
                        url: '{{url("buildingListByAreaId")}}',
                        data:{area_id:area_id},
                        type: "GET",
                        dataType: "json",
                        beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },
                        success: function (result) {
                            $.each(result.data, function (k, val) {
                                $('select[name="building_id"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                            });
                        },
                        complete: function () {
                            //$('#loader').css("visibility", "hidden");
                        }
                    });
                } else {
                    $('select[name="building_id"]').empty();
                    $('select[name="building_id"]').append('<option value="">Select Building</option>');
                }

            });




            $('select[name="building_id"]').on('change', function () {
                var building_id = $(this).val();

                


                if (building_id > 0) {
                   

                    $.ajax({
                        url: '{{url("accommodationFlatListByBuildingId")}}',
                        data:{building_id:building_id},
                        type: "GET",
                        dataType: "json",
                        beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },
                        success: function (result) {

                            $("#dataTable tbody").html("");
                            var i=1;
                            console.log(result);

                           
                            $.each(result.flatdata, function (k, val) {

                               

                                
                                

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
                           
                                
                              

                                
                                 $('#dataTable').append('<tr><td>'+i+'</td><td>'+val.number+'</td><td>'+val.floorname+'</td><td>'+val.size+'</td><td>'+status+'</td><td>'+allocationdetails+'</td><td>'+action+'</td><tr>'); 


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
            url: '{{url("confirmUpdatedApplicationByWhip")}}',
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
              var pos = loc.indexOf("whip_application_monitoring");
           
   var urlpart= loc.slice(0, (pos+27));
   
           
            newloadurl= urlpart+'?approve=success';
                  
                    
                   
            window.location.replace(newloadurl);





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



