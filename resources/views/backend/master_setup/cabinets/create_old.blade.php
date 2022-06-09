@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Cabinet Setup')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Cabinet Setup')</li>
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
                <h5>{{$current_ministry->name_bn}}</h5>
            </div>

            <div class="card-body">
                <form id="cabinetForm" class="form-horizontal" action="{{url('/master-setup/cabinet/save')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-9">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label class="control-label" for="parliament_id">@lang('Ministry') <span class="text-danger"> *</span></label>
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <select name="ministry_id" id="ministry_id" class="@error('ministry_id') is-invalid @enderror form-control form-control-sm select2">
                                            
                                            @foreach ($ministry_list as $data)

                                            <option value="{{ $data->id }}" @if($data->id == old('ministry_id') || $data->id == $current_ministry->id ){{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                            @endforeach

                                        </select>

                                        @error('ministry_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label class="control-label" for="minister_id">@lang('Minister') </label>
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <select name="minister_id" id="minister_id" class="@error('minister_id') is-invalid @enderror form-control form-control-sm select2">
                                            <option value="">@lang('Select Minister')</option>
                                            @foreach ($profile_list as $data)
                                            <option value="{{ $data->id }}" @if($data->id == old('minister_id')) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                            @endforeach

                                        </select>

                                        @error('minister_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label class="control-label" for="minister_id">@lang('State Minister') </label>
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <select name="state_minister[]" multiple='multiple' id="state_minister" class="@error('state_minister') is-invalid @enderror form-control form-control-sm select2">
                                            <option value="">@lang('Select State Minister')</option>
                                            @foreach ($profile_list as $data)
                                            <option value="{{ $data->id }}" @if($data->id == old('state_minister')) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                            @endforeach
                                        </select>
                                       
                                        @error('state_minister')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label class="control-label" for="minister_id">@lang('Deputy Minister') </label>
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <select name="deputy_minister[]" multiple='multiple' id="deputy_minister" class="@error('deputy_minister') is-invalid @enderror form-control form-control-sm select2">
                                            <option value="">@lang('Select Deputy Minister')</option>
                                            @foreach ($profile_list as $data)
                                            <option value="{{ $data->id }}" @if($data->id == old('deputy_minister')) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                            @endforeach
                                        </select>
                                       
                                        @error('deputy_minister')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label class="control-label" for="minister_id">@lang('Secretary') </label>
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <select name="secretary[]" multiple='multiple' id="secretary" class="@error('secretary') is-invalid @enderror form-control form-control-sm select2">
                                            <option value="">@lang('Select Secretary')</option>
                                            @foreach ($profile_list as $data)
                                            <option value="{{ $data->id }}" @if($data->id == old('secretary')) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                            @endforeach
                                        </select>
                                        
                                        @error('secretary')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label class="control-label" for="minister_id">@lang('Joint Secretary') </label>
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <select name="joint_secretary[]" multiple='multiple' id="joint_secretary" class="@error('joint_secretary') is-invalid @enderror form-control form-control-sm select2">
                                            <option value="">@lang('Select Joint Secretary')</option>
                                            @foreach ($profile_list as $data)
                                            <option value="{{ $data->id }}" @if($data->id == old('joint_secretary')) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                            @endforeach
                                        </select>
                                       
                                        @error('joint_secretary')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-success btn-sm">@lang('Submit')</button>
                                <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                    <a href="{{ route('admin.master_setup.assessment_committees.index') }}">@lang('Back')</a>
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

@section('script')
<script>
    $(function() {
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $('#reservationdate2').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $('#state_minister').select2({
            placeholder: "@lang('Select State Minister')",
            allowClear: true,
            multiple: true,
        });
        $('#deputy_minister').select2({
            placeholder: "@lang('Select Deputy Minister')",
            allowClear: true,
            multiple: true,
        });
        $('#secretary').select2({
            placeholder: "@lang('Select Secretary')",
            allowClear: true,
            multiple: true,
        });
        $('#joint_secretary').select2({
            placeholder: "@lang('Select Joint Secretary')",
            allowClear: true,
            multiple: true,
        });
    })

    function save_data(id,type) {
        $.ajax({
            url: "{{url('admin/master-setup/cabinet/save')}}",
            type: "POST",
            data: {
                _token: "{{csrf_token()}}",
                ministry_id: id,
                minister_id:$("#minister_id").val(),
                state_minister:$("#state_ministers").val(),
                deputy_minister:$("#deputy_minister").val(),
                secretary:$("#secretaries").val(),
                joint_secretary:$("#joint_secretaries").val(),
            },
            success: function(response) {
                if (response == 1) {
                    $('#lotteryResult').html(final_data);
                    //location.reload();
                } else if (response == 2) {
                    Swal.fire('চালানোর অনুমতি নেই', '', 'warning');
                    $("#lotteryModal").modal('hide');
                } else {
                    Swal.fire('@lang("Server Error")', '', 'error');
                    $("#lotteryModal").modal('hide');
                }
            }
        });
    }
</script>
@endsection