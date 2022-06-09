@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Petition Stages')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Petition Stages')</li>
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
                @if($existingData->id)
                <h5>@lang('Update Stage')</h5>
                @else
                <h5>@lang('Create Stage')</h5>
                @endif
            </div>
            <!-- Form Start-->
            <form id="stageForm" name="stageForm" method="POST" @if($existingData->id)
                action="{{ route('admin.petition_management.petitionstage.update', $existingData->id) }}">
                <input name="_method" type="hidden" value="PUT">
                @else
                action="{{ route('admin.petition_management.petitionstage.store') }}">
                @endif
                @csrf

                <input type="hidden" id="id" name="id" value="{{$existingData->id}}">
                <input type="hidden" id="rule_number" name="rule_number" value="102">

                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label" for="role_id">@lang('Role Name')<span style="color: red;"> *</span></label>
                                <select id="role_id" name="role_id" class="form-control @error('role_id') is-invalid @enderror select2">
                                    <option value="">@lang('Select Role')</option>
                                    @foreach ($user_role_list as $list)
                                    <option value="{{$list->id}}" @if($list->id==$existingData->role_id or $list->id==old('role_id')) {{'selected="selected"'}} @endif>{{$list->name_bn}}</option>
                                    @endforeach
                                </select>

                                @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label" for="stage">@lang('Stage Number')<span style="color: red;"> *</span></label>
                                <input type="number" id="stage" name="stage" value="{{old('stage', $existingData->stage)}}" class="form-control @error('stage') is-invalid @enderror" autocomplete="off" min="0" max="15">

                                @error('stage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                        </div>
                        
                        <div class="form-group col-12">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="status" {{ $existingData->status == 1 ? 'checked' : '' }} value="1" class="custom-control-input" id="active-status">
                                <label class="custom-control-label" for="active-status">@lang('Make it active ?')</label>
                            </div>
                        </div>
                      


                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group text-right">
                                @if($existingData->id)
                                <button type="submit" class="btn btn-success btn-sm">@lang('Update')</button>
                                @else
                                <button type="submit" class="btn btn-success btn-sm">@lang('Save')</button>
                                <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                @endif
                                <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                    <a href="{{route('admin.petition_management.petitionstage.index') }}">@lang('Back')</a>
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