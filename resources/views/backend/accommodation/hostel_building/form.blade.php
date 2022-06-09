@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Hostel Building Management')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Hostel Building Management')</li>
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
                    @if (isset($editData))
                    <h5>@lang('Update Hostel Building')</h5>
                    @else
                    <h5>@lang('Create Hostel Building')</h5>
                    @endif
                </div>
                <!-- Form Start-->
                <form method="POST" action="{{ isset($editData) ? route('admin.accommodation.hostel_buildings.update', $editData->id) : route('admin.accommodation.hostel_buildings.store') }}">
                    @csrf
                    @if (isset($editData))
                        @method('PUT')
                    @endif

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="name">@lang('Name (English)')<span
                                            style="color: red;"> *</span></label>
                                    <input type="text" id="name" name="name"  value="{{ old('name') ?? $editData->name ?? '' }}"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="@lang('Enter Name in English')" autocomplete="off" maxlength="30">
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
                                    <input type="text" id="name_bn" name="name_bn"  value="{{ old('name_bn') ?? $editData->name_bn ?? '' }}"
                                           class="form-control @error('name_bn') is-invalid @enderror"
                                           placeholder="@lang('Enter Name in Bangla')" autocomplete="off" maxlength="30">
                                    @error('name_bn')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>




                            {{-- <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="building_no">@lang('Number')<span
                                            style="color: red;"> *</span></label>
                                    <input type="text" id="building_no" name="building_no"  value="{{ old('building_no') ?? $editData->building_no ?? '' }}"
                                           class="form-control @error('building_no') is-invalid @enderror"
                                           placeholder="@lang('Enter Number')" autocomplete="off" maxlength="30">
                                    @error('building_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> --}}

                            {{-- <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="total_floor">@lang('Total Floor')<span
                                            style="color: red;"> *</span></label>
                                    <input type="text" id="total_floor" name="total_floor" value="{{ old('total_floor') ?? $editData->total_floor ?? '' }}"
                                           class="form-control @error('total_floor') is-invalid @enderror"
                                           placeholder="@lang('Enter Total Floor')" autocomplete="off" maxlength="30">
                                    @error('total_floor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> --}}

                            @if (isset($editData))
                                <div class="form-group col-sm-4 mt-auto">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="status" {{ $editData->status == 1 ? 'checked' : '' }} value="1" class="custom-control-input" id="active-status">
                                        <label class="custom-control-label" for="active-status">@lang('Make it active ?')</label>
                                      </div>
                                </div>
                            @endif

                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                        <a href="{{route('admin.accommodation.hostel_buildings.index') }}">@lang('Back')</a>
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                    <button type="submit" class="btn btn-success btn-sm">@if(isset($editData)) @lang('Update') @else @lang('Save') @endif</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--Form End-->
            </div>
        </div>
    </div>

@endsection
