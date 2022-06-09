@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Appointment Management')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Appointment Management')</li>
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
                        {{-- <div class="card-header text-right">
                            <a href="{{route('admin.appointment-management.appointment-request.create') }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> @lang('Add Appointment')</a>
                        </div> --}}
                        <div class="card-body">
                            
                            @include('backend.appointmentManagement.receivedGrid')
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!--/. container-fluid -->
    </section>
    <div class="modal fade" id="appointmentAccept">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="ajax_details_modal">
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
@endsection
<script>
    function load_data(type) {
        if (type == 'approved') {
            window.location.href = "{{ route('admin.appointment-management.appointment-received.acceptedList')}}";
        } else if (type == 'rejected') {
            window.location.href = "{{ route('admin.appointment-management.appointment-received.rejectedList')}}";
        
        } else if (type == 'pending') {
            window.location.href = "{{ route('admin.appointment-management.appointment-received.index')}}";
        
        }
    }
    function acceptModal(id) {
        $.ajax({
            url : "{{url('/appointment-management/appointment-received/details_data')}}",
            data : {id:id},
            type : "get",
            beforeSend : function(){
                $('.preload').show();
            },
            success:function(data){
                
                $('#appointmentAccept').modal('show');
                $('.preload').hide();
                $('#ajax_details_modal').html(data);
                $('#new_time').hide();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                toastr.error('দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য দেখা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান ', {globalPosition: 'top right',className: 'error',autoHideDelay:10000});
                $('.preload').hide();
            }
        });
    }

    function changeModal(id) {
        $.ajax({
            url : "{{url('/appointment-management/appointment-received/timechange_data')}}",
            data : {id:id},
            type : "get",
            beforeSend : function(){
                $('.preload').show();
            },
            success:function(data){
                
                $('#appointmentAccept').modal('show');
                $('.preload').hide();
                $('#ajax_details_modal').html(data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                toastr.error('দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য দেখা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান ', {globalPosition: 'top right',className: 'error',autoHideDelay:10000});
                $('.preload').hide();
            }
        });
    }
    
</script>

