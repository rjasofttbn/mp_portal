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
                        <div class="card-header text-right">
                            <a href="{{route('admin.appointment-management.appointment-request.create') }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> @lang('Add Appointment')</a>
                        </div>
                        <div class="card-body">
                            
                            @include('backend.appointmentManagement.grid')
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!--/. container-fluid -->
    </section>

@endsection
<script>
     
    function load_data(type) {
        if (type == 'approved') {
            window.location.href = "{{ route('admin.appointment-management.appointment-request.acceptedList')}}";
        } else if (type == 'rejected') {
            window.location.href = "{{ route('admin.appointment-management.appointment-request.rejectedList')}}";
        
        } else if (type == 'pending') {
            window.location.href = "{{ route('admin.appointment-management.appointment-request.index')}}";
        
        }
    }
</script>

