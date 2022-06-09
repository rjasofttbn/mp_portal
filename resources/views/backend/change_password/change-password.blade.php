@extends('backend.layouts.app') @section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Manage Role</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Role</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        {{-- <a href="{{route('project-management.role.view')}}" class="btn btn-info btn-sm"><i class="fas fa-stream"></i> View Role</a> --}}
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile-management.store.password') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">

                                <div class="form-group col-sm-6">
                                    <label>Old Password</label>
                                    <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" autocomplete="off" value="{{ !empty($editData->old_password)? $editData->old_password : old('old_password') }}">
                                    @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                {!! Session::has('msg') ? Session::get("msg") : '' !!}
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>New Password</label>
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" autocomplete="off" value="{{ !empty($editData->new_password)? $editData->new_password : old('new_password') }}">
                                    @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" autocomplete="off" value="{{ !empty($editData->confirm_password)? $editData->confirm_password : old('confirm_password') }}">
                                    @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                

                            </div>

                            <button class="btn bg-gradient-success btn-flat"><i class="fas fa-save"></i> {{ !empty($editData)? 'Update' : 'Save' }}</button>
                        </form>
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