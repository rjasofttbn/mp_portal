@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Floor and Flat Setup')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Floor and Flat Setup')</li>
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
                            <a href="{{route('admin.accommodation-management.setup.floorflats.create')}}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> @lang('Floor and Flat Setup')</a>
                        </div>
                        <div class="card-body">
                             @include('backend.accommodation.floor_flat.grid')
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
$('.noflatmessage').attr("href","");
  $(".noflatmessage").click(function(){
    Swal.fire({
    type: 'warning',
  title: 'No Flat Available to update',
  text: 'Add Flat to Building!'

})

return false;
  });
});
        
          </script>
@endsection


