@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Parliament Management')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Parliament Management')</li>
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
                        <h4 class='card-title'>@lang('Update Parliament')</h4>
                    @else
                        <h4 class='card-title'>@lang('Create Parliament')</h4>
                    @endif
                </div>
                <!-- Form Start-->
                <form id="parliamentForm" name="parliamentForm" method="POST"
                      @if($data->id)
                      action="{{ route('admin.master_setup.parliaments.update', $data->id) }}">
                    <input name="_method" type="hidden" value="PUT">
                    @else
                        action="{{ route('admin.master_setup.parliaments.store') }}">
                    @endif
                    @csrf

                    <input type="hidden" id="id" name="id" value="{{$data->id}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="parliament_number">@lang('Parliament No.')<span
                                            style="color: red;"> *</span></label>
                                    <input type="text" id="parliament_number" name="parliament_number" value="{{old('parliament_number', $data->parliament_number)}}"
                                           class="form-control @error('parliament_number') is-invalid @enderror"
                                           placeholder="@lang('Enter Parliament Number')" autocomplete="off" maxlength="30">

                                    @error('parliament_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="date_from">@lang('Date From')<span
                                            style="color: red;"> *</span></label>
                                    <div class="input-group date" id="reservationfrom" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input @error('date_from') is-invalid @enderror"
                                               name="date_from"
                                               value="{{old('date_from', $data->date_from)}}"
                                               placeholder="@lang('Select Date')" autocomplete="off" maxlength="30"
                                               data-target="#reservationfrom"/>
                                        <div class="input-group-append" data-target="#reservationfrom" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>

                                    @error('date_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="date_to">@lang('Date To')<span
                                            style="color: red;"> *</span></label>
                                    <div class="input-group date" id="reservationto" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input @error('date_to') is-invalid @enderror"
                                               name="date_to"
                                               value="{{old('date_to', $data->date_to)}}"
                                               placeholder="@lang('Select Date')" autocomplete="off" maxlength="30"
                                               data-target="#reservationto"/>
                                        <div class="input-group-append" data-target="#reservationto" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>

                                    @error('date_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @if($data->id)
                                <div class="form-group col-sm-4 mt-auto">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="status" {{ $data->status == 1 ? 'checked' : '' }} value="1" class="custom-control-input" id="active-status">
                                        <label class="custom-control-label" for="active-status">@lang('Make it active ?')</label>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group text-right">
                                    @if($data->id)
                                        <button type="submit" class="btn btn-success btn-sm">@lang('Update')</button>
                                    @else
                                        <button type="submit" class="btn btn-success btn-sm">@lang('Save')</button>
                                        <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                    @endif
                                    <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                        <a href="{{route('admin.master_setup.parliaments.index') }}">@lang('Back')</a>
                                    </button>
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
@section('script')
    <script>
        $(function () {
            //Date picker
            $('#reservationfrom').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#reservationto').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        })
    </script>
@endsection

