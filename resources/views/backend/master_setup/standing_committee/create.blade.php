@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Standing Committee')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Standing Committee')</li>
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

                        <h5>@lang('Create Committee')</h5>
 
                </div>

                <div class="card-body">
                    <form id="standingCommitteeForm" class="form-horizontal" action="{{route('admin.master_setup.standing_committees.store')}}"
                          method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                            <label class="control-label" for="ministry_id">@lang('1'). @lang('Ministry Name') <span class="text-danger"> *</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8">
                                            <select name="ministry_id" id="ministry_id" class="@error('ministry_id') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select Member Name')</option>
                                                @if (isset($ministries) && count($ministries) > 0)
                                                    @foreach ($ministries as $data)
                                                        @if($data->id == old('ministry_id'))
                                                            <option selected value="{{ $data->id }}">{{ $data->name_bn }}</option>
                                                        @else
                                                            <option value="{{ $data->id }}">{{ $data->name_bn }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
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
                                            <label class="control-label" for="parliament_id">@lang('3'). @lang('Parliament') <span class="text-danger"> *</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8">
                                            <select name="parliament_id" id="parliament" class="@error('parliament_id') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="{{ $parliaments->id ?? null }}">{{ Lang::get($parliaments->parliament_number) ?? null }}</option>

                                            </select>

                                            @error('parliament_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 col-lg-4 pl-4">
                                            <label class="control-label" for="date_from">@lang('2'). @lang('Date From') <span class="text-danger"> *</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8">
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text"
                                                       class="form-control datetimepicker-input @error('date_from') is-invalid @enderror"
                                                       name="date_from"
                                                       value="{{ $parliaments->date_from ?? null }}"
                                                       placeholder="@lang('Select Date')"
                                                       data-target="#reservationdate"/>
                                                <div class="input-group-append" data-target="#reservationdate"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>

                                            @error('date_from')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4 col-lg-4 pl-4">
                                            <label class="control-label" for="date_to">@lang('4'). @lang('Date To') <span class="text-danger"> *</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8">
                                            <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                                <input type="text"
                                                       class="form-control datetimepicker-input @error('date_to') is-invalid @enderror"
                                                       name="date_to"
                                                       value="{{ $parliaments->date_to ?? null }}"
                                                       placeholder="@lang('Select Date')"
                                                       data-target="#reservationdate2"/>
                                                <div class="input-group-append" data-target="#reservationdate2"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>

                                            @error('date_to')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="user_id">@lang('5'). @lang('Standing Committee') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <div id="divAdd">
                                        <div id="childDiv" class="row mb-2">
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <select id="standing_committee" name="user_id[]"
                                                class="@error('user_id') is-invalid @enderror form-control form-control-sm select2">
                                                    <option value="">@lang('Select the Name')</option>
                                                    @if (isset($profiles) && count($profiles) > 0)
                                                        @foreach ($profiles as $data)
                                                            @if($data->user_id == old('user_id'))
                                                                <option selected value="{{ $data->user_id }}">
                                                                    @if(session()->get('language') =='bn')
                                                                    {{ $data->name_bn }}
                                                                    @else
                                                                    {{ $data->name_eng }}
                                                                    @endif
                                                                </option>
                                                            @else
                                                                <option value="{{ $data->user_id }}">
                                                                    @if(session()->get('language') =='bn')
                                                                    {{ $data->name_bn }}
                                                                    @else
                                                                    {{ $data->name_eng }}
                                                                    @endif
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                                
                                                @error('user_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <input id="committee_designation" type="text" name="designation[]" placeholder="@lang('Enter Designation')" class='form-control form-control-sm'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-2 col-lg-2"> </div>
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <input type="button" id="addMore" class='btn btn-outline-info btn-sm' name="add" value="+ @lang('Add More')"/>
                                </div>
                            </div>
                        </div>

                        

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success btn-sm">@lang('Submit')</button>
                                    <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                    <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                        <a href="{{ route('admin.master_setup.standing_committees.index') }}">@lang('Back')</a>
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

        $(function () {

            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'YYYY-MM-DD',
            });

            $('#reservationdate2').datetimepicker({
                format: 'YYYY-MM-DD',
            });

            $('#addMore').click(function(){
                var loadMp = '<div id="childDiv" class="row mb-2"> <div class="col-sm-12 col-md-6 col-lg-6"> <select name="user_id[]" class="@error("user_id") is-invalid @enderror form-control form-control-sm select2"> <option value="">@lang("Select the Name")</option> @if (isset($profiles) && count($profiles) > 0) @foreach ($profiles as $data) @if($data->id==old("user_id")) <option selected value="{{$data->user_id}}"> @if(session()->get("language")=="bn"){{$data->name_bn}}@else{{$data->name_eng}}@endif </option> @else <option value="{{$data->user_id}}"> @if(session()->get("language")=="bn"){{$data->name_bn}}@else{{$data->name_eng}}@endif </option> @endif @endforeach @endif </select> @error("user_id") <span class="text-danger">{{$message}}</span> @enderror </div><div class="col-sm-12 col-md-6 col-lg-6"> <input id="committee_designation" type="text" name="designation[]" placeholder="@lang("Enter Designation")" class="form-control form-control-sm"> </div></div>';

               $('#divAdd').append(loadMp);
                $('.select2').select2();
            });

        })
    </script>

@endsection