@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Rule')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Rule')</li>
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
                    @if($data->id)
                        <h5>@lang('Update Rule')</h5>
                    @else
                        <h5>@lang('Create Rule')</h5>
                    @endif
                </div>
                <!-- Form Start-->
                <form id="ruleForm" name="ruleForm" method="POST"
                      @if($data->id)
                      action="{{ route('admin.notice_management.parliament_rules.update', $data->id) }}">
                    <input name="_method" type="hidden" value="PUT">
                    @else
                        action="{{ route('admin.notice_management.parliament_rules.store') }}">
                    @endif
                    @csrf

                    <input type="hidden" id="id" name="id" value="{{$data->id}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="rule_number">@lang('Rule Number')<span
                                            style="color: red;"> *</span></label>
                                    <input type="text" id="rule_number" name="rule_number" value="{{old('rule_number', $data->rule_number)}}"
                                           class="form-control @error('rule_number') is-invalid @enderror"
                                           placeholder="@lang('Enter Rule Mumber')" autocomplete="off" maxlength="30">

                                    @error('rule_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="name">@lang('Name')<span
                                            style="color: red;"> *</span></label>
                                    <input type="text" id="name" name="name" value="{{old('name', $data->name)}}"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="@lang('Enter Rule Name')" autocomplete="off" maxlength="30">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="department_id">@lang('Department')<span
                                            style="color: red;"> *</span></label>
                                    <select id="department_id" name="department_id" class="form-control @error('department_id') is-invalid @enderror select2">
                                        <option value="">@lang('Select Department')</option>
                                        @foreach ($departments as $list)
                                            @if($list['id']==$data->department_id or $list['id']==old('department_id'))
                                                <option selected
                                                        value="{{$list['id']}}">{{$list['name']}}</option>
                                            @else
                                                <option  value="{{$list['id']}}">{{$list['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <label>@lang('Description')</label>
                                <textarea  name="description" id="description" class="textareaWithoutImgVideo">{{$data->description}}</textarea>
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
                                        <a href="{{route('admin.notice_management.parliament_rules.index') }}">@lang('Back')</a>
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
