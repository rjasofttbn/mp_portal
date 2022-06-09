@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Furniture/Electrical Goods Managment')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.accommodation-asset-management.setup.accommodation_assets.index')}}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Furniture/Electrical Goods Managment')</li>
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
                        <div >
                            
                                <div class="card-header text-right">
                                    <a href="{{route('admin.accommodation-asset-management.setup.accommodation_assets.create')}}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> @lang('Furniture/Electrical Goods Name Add')</a>
                                </div>
                                <div class="card-header text-left">
                                    <h5>@lang('Furniture/Electrical Goods Name List')</h5>
                                </div>
                        </div>
                       
                        <div class="card-body">
                             @include('backend.accommodation-asset-management.setup.accommodation-assets.grid') 
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


