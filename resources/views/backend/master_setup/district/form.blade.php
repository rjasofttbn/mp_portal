@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('District Management')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('District Management')</li>
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
                    @if ($data->id)
                    <h4 class="card-title">@lang('Update District')</h4>
                    @else
                    <h4 class="card-title">@lang('Create District')</h4>
                    @endif
                </div>
                <!-- Form Start-->
                <form id="areaForm" name="areaForm" method="POST"
                      @if($data->id)
                      action="{{ route('admin.master_setup.districts.update', $data->id) }}">
                    <input name="_method" type="hidden" value="PUT">
                    @else
                        action="{{ route('admin.master_setup.districts.store') }}">
                    @endif
                    @csrf

                    <input type="hidden" id="id" name="id" value="{{$data->id}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="bn_name">@lang('Name (Bangla)')<span
                                            style="color: red;"> *</span></label>
                                    <input type="text" id="bn_name" name="bn_name" value="{{old('bn_name', $data->bn_name)}}"
                                           class="form-control @error('bn_name') is-invalid @enderror"
                                           placeholder="@lang('Enter Name in Bangla')" autocomplete="off" maxlength="30">

                                    @error('bn_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="name">@lang('Name (English)')<span
                                            style="color: red;"> *</span></label>
                                    <input type="text" id="name" name="name" value="{{old('name', $data->name)}}"
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
                                    <label class="control-label" for="division_id">@lang('Division')<span
                                            style="color: red;"> *</span></label>
                                    <select id="division_id" name="division_id" class="form-control @error('division_id') is-invalid @enderror">
                                        <option value="">@lang('Select Division')</option>
                                        @foreach ($divisionList as $list)
                                            @if($list['id']==$data->division_id or $list['id']==old('division_id'))
                                                <option selected
                                                        value="{{$list['id']}}">
                                                        @if(session()->get('language') =='bn')
                                                            {{$list['bn_name']}}
                                                        @else
                                                            {{$list['name']}}
                                                        @endif
                                                    </option>
                                            @else
                                                <option  value="{{$list['id']}}">
                                                    @if(session()->get('language') =='bn')
                                                        {{$list['bn_name']}}
                                                    @else
                                                        {{$list['name']}}
                                                    @endif
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('division_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="lat">@lang('Latitude')</label>
                                    <input type="text" id="lat" name="lat" value="{{old('lat', $data->lat)}}"
                                           class="form-control @error('lat') is-invalid @enderror"
                                           placeholder="@lang('Enter Latitude')" autocomplete="off" maxlength="30">

                                    @error('lat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="lon">@lang('Longitude')</label>
                                    <input type="text" id="lon" name="lon" value="{{old('lon', $data->lon)}}"
                                           class="form-control @error('lon') is-invalid @enderror"
                                           placeholder="@lang('Enter Longitude')" autocomplete="off" maxlength="30">

                                    @error('lon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="url">@lang('Website URL')</label>
                                    <input type="text" id="url" name="url" value="{{old('url', $data->url)}}"
                                           class="form-control @error('url') is-invalid @enderror"
                                           placeholder="@lang('Enter Website URL')" autocomplete="off" maxlength="30">

                                    @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <input type="hidden" name="status" id="status" value="1">
                        @if($data->id)
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="status">@lang('Status') <span style="color: red;"> *</span></label>

                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" value="1" id="status_1"
                                               name="status" @if($data->status==1) {{"checked"}} @endif checked>
                                        <label for="status_1" class="custom-control-label">@lang('Active')</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" value="0" id="status_0"
                                               name="status" @if($data->status==0) {{"checked"}} @endif>
                                        <label for="status_0" class="custom-control-label">@lang('Inactive')</label>
                                    </div>
                                    <div>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>

                                </div>
                            </div>
                        @endif


                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                        <a href="{{route('admin.master_setup.districts.index') }}">@lang('Back')</a>
                                    </button>
                                    @if($data->id)
                                        <button type="submit" class="btn btn-success btn-sm">@lang('Update')</button>
                                    @else
                                        <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                        <button type="submit" class="btn btn-success btn-sm">@lang('Save')</button>
                                    @endif
                                    
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
