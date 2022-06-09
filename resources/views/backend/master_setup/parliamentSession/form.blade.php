@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Parliament Session Management')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Parliament Session Management')</li>
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
                        <h4 class="card-title">@lang('Update Parliament Session')</h4>
                    @else
                        <h4 class="card-title">@lang('Create Parliament Session')</h4>
                    @endif
                </div>
                <!-- Form Start-->
                <form id="parliamentForm" name="parliamentForm" method="POST" enctype="multipart/form-data" 
                      @if($data->id)
                      action="{{ route('admin.master_setup.parliament_sessions.update', $data->id) }}">
                    <input name="_method" type="hidden" value="PUT">
                    @else
                        action="{{ route('admin.master_setup.parliament_sessions.store') }}">
                    @endif
                    @csrf

                    <input type="hidden" id="id" name="id" value="{{$data->id}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="parliament_id">@lang('Parliament No.')<span
                                            style="color: red;"> *</span></label>
                                    <select id="parliament_id" name="parliament_id" class="form-control select2 @error('parliament_id') is-invalid @enderror">
                                        <option value="">@lang('Select Parliament No.')</option>
                                        @foreach ($parliamentList as $list)
                                            @if($list['id']==$data->parliament_id or $list['id']==old('parliament_id'))
                                                <option selected
                                                        value="{{$list['id']}}">{{ Lang::get($list['parliament_number']) }}</option>
                                            @else
                                                <option  value="{{$list['id']}}">{{ Lang::get($list['parliament_number']) }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('parliament_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="session_no">@lang('Session No.')<span
                                            style="color: red;"> *</span></label>
                                           <select id="session_no" name="session_no" class="form-control select2 @error('session_no') is-invalid @enderror">
                                                <option value="">@lang('Select Session No.')</option>
                                                @foreach($session_list as $list)
                                                    @if($list['id']==$data->session_no or $list['id']==old('session_no'))
                                                    <option selected value="{{$list['name']}}">@php echo Lang::get($list['name']) @endphp </option>
                                                    @else
                                                    <option value="{{$list['name']}}">@php echo Lang::get($list['name']) @endphp </option>
                                                    @endif
                                                @endforeach
                                           </select>

                                    @error('session_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="declare_date">@lang('Declare Date')<span
                                            style="color: red;"> *</span></label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input @error('declare_date') is-invalid @enderror"
                                               name="declare_date"
                                               value="{{old('declare_date', $data->declare_date)}}"
                                               placeholder="@lang('Select Date')" autocomplete="off" maxlength="30"
                                               data-target="#reservationdate"/>
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>

                                    @error('declare_date')
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
                                    <div class="input-group date" id="reservationdatefrom" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input @error('date_from') is-invalid @enderror"
                                               name="date_from"
                                               value="{{old('date_from', $data->date_from)}}"
                                               placeholder="@lang('Select Date')" autocomplete="off" maxlength="30"
                                               data-target="#reservationdatefrom"/>
                                        <div class="input-group-append" data-target="#reservationdatefrom" data-toggle="datetimepicker">
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
                                    <div class="input-group date" id="reservationdateto" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input @error('date_to') is-invalid @enderror"
                                               name="date_to"
                                               value="{{old('date_to', $data->date_to)}}"
                                               placeholder="@lang('Select Date')" autocomplete="off" maxlength="30"
                                               data-target="#reservationdateto"/>
                                        <div class="input-group-append" data-target="#reservationdateto" data-toggle="datetimepicker">
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
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label class="control-label" for="attachment">@lang('Attachment (if any)')</label>
                                    <input type="file" class="form-control attachment_upload" name="attachment[]" id="attachment" multiple accept=".png, .jpg, .jpeg, .pdf">
                                    @if($data->id)
                                        @foreach($attachments as $file)
                                        <a class="badge badge-dark text-white d-inline-block float-left mt-2 mr-2" href="{{ asset('public/backend/attachment/'.$file->attachment)  }}" target="_blank">@lang('Previous Attachment') - {{ Lang::get($loop->iteration) }}</a>
                                        @endforeach
                                    @endif

                                    @error('attachment')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
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
                                        <a href="{{route('admin.master_setup.parliament_sessions.index') }}">@lang('Back')</a>
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
            $('#reservationdate').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#reservationdatefrom').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#reservationdateto').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        })
    </script>
@endsection

