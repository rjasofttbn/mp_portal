@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Update Flat Type')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.accommodation.flat_types.index') }}">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Flat Type')</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{-- <h6>@lang('Update Flat Type')</h6> --}}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.accommodation.flat_types.update', $data->id) }}" enctype="multipart/form-data">
                    @csrf
                    @if (isset($data))
                    @method('PUT')
                    @endif
                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="name">@lang('Name')<span style="color: red;"> *</span></label>
                                    <input type="text" id="name" name="name" value="{{old('name', $data->name)}}"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="@lang('Enter Size')" autocomplete="off" maxlength="30">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="name_bn">@lang('Name (Bangla)')<span
                                            style="color: red;"> *</span></label>
                                    <input type="text" id="name_bn" name="name_bn"  value="{{ old('name_bn') ?? $data->name_bn ?? '' }}"
                                           class="form-control @error('name_bn') is-invalid @enderror"
                                           placeholder="@lang('Enter Name in Bangla')" autocomplete="off" maxlength="30">
                                    @error('name_bn')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="size">@lang('Size')<span style="color: red;"> *</span></label>
                                    <input type="text" id="size" name="size" value="{{old('size', $data->size)}}"
                                           class="form-control @error('size') is-invalid @enderror"
                                           placeholder="@lang('Enter Size')" autocomplete="off" maxlength="30">

                                    @error('size')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="service_charge">@lang('Service Charge')<span
                                            style="color: red;"> *</span></label>
                                    <input type="text" id="service_charge" name="service_charge" value="{{old('service_charge', $data->service_charge)}}"
                                           class="form-control @error('service_charge') is-invalid @enderror"
                                           placeholder="@lang('Enter Service Charge')" autocomplete="off" maxlength="30">

                                    @error('service_charge')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>                           
                                </div>

                                

                                <div class="form-group col-sm-4 mt-auto">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="status" {{ $data->status == 1 ? 'checked' : '' }} value="1" class="custom-control-input" id="active-status">
                                        <label class="custom-control-label" for="active-status">@lang('Make it active ?')</label>
                                    </div>
                                </div>
                            </div> 

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-success btn-sm">@lang('Submit')</button>
                                <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                    <a href="{{ route('admin.accommodation.flat_types.index') }}">@lang('Back')</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
