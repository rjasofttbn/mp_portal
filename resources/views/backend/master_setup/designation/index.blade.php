@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Designation Management')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Designation Management')</li>
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
                            <a href="{{route('admin.master_setup.designations.create') }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> @lang('Add Designation')</a>
                        </div>
                        <div class="card-body">
                            @include('backend.master_setup.designation.grid')
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
        function ConfirmDelete()
        { var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }
    </script>
@endsection


