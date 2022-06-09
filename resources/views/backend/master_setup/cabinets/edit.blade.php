@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<style>
    fieldset {
        padding: 15px;
        border: 1px solid rgba(0, 0, 0, .125);
        margin-bottom: 20px;
    }

    legend {
        max-width: 7%;
        font-size: 15px;
    }

    .datepicker {
        z-index: 99999;
    }
</style>
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
                        <div class="col-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2">
                                        <label class="control-label" for="parliament_id">@lang('Ministry') <span class="text-danger"> *</span></label>
                                    </div>
                                    <div class="col-10">
                                        <input type="hidden" id="ministry_id" name="ministry_id" value="{{$current_ministry->id}}">
                                        <select class="@error('ministry_id') is-invalid @enderror form-control form-control-sm select2" disabled>

                                            @foreach ($ministry_list as $data)

                                            <option value="{{ $data->id }}" @if($data->id == $current_ministry->id ){{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                            @endforeach

                                        </select>

                                        @error('ministry_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-12">
                            <fieldset>
                                <legend>@lang('Minister')</legend>
                                <div id="minister_container">
                                    @if(!$existing_ministers->isEmpty())
                                    @foreach($existing_ministers as $m)
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <select name="minister_wing[]" class="@error('minister') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select Ministery Wings')</option>
                                                @foreach ($ministry_wing_list as $data)
                                                <option value="{{ $data->id }}" @if(isset($m->wing_id) && $data->id==$m->wing_id) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <select name="minister[]" class="@error('minister') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select Minister')</option>
                                                @foreach ($profile_list as $data)
                                                <option value="{{ $data->user_id }}" @if( $data->user_id==$m->profile_id) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                                @endforeach
                                            </select>

                                            @error('minister')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="minister_from[]" class="form-control datepicker text-center " placeholder="@lang('Date From')" value="{{date('d.m.Y',strtotime($m->date_from))}}">

                                            @error('date_from')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="minister_to[]" class="form-control datepicker text-center " placeholder="@lang('Date To')" value="{{date('d.m.Y',strtotime($m->date_to))}}">

                                            @error('date_to')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                        <div class="col-1 text-center">
                                            @if($loop->iteration==1)
                                            <button type="button" class="btn btn-info" onClick="add_more('minister')">
                                                <i class="fa fa-plus"> </i>
                                            </button>
                                            @else
                                            <button type="button" class="btn btn-danger delete_me"> <i class="fa fa-times"> </i> </button>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <select name="minister_wing[]" class="@error('minister') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select Ministery Wings')</option>
                                                @foreach ($ministry_wing_list as $data)
                                                <option value="{{ $data->id }}" @if(isset($m->wing_id) && $data->id==$m->wing_id) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <select name="minister[]" class="@error('minister') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select Minister')</option>
                                                @foreach ($profile_list as $data)
                                                <option value="{{ $data->user_id }}" @if(isset($m->profile_id) && $data->user_id==$m->profile_id) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                                @endforeach
                                            </select>

                                            @error('minister')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="minister_from[]" class="form-control datepicker text-center " placeholder="@lang('Date From')" value="{{$session_from}}">

                                            @error('date_from')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="minister_to[]" class="form-control datepicker text-center " placeholder="@lang('Date To')" value="{{$session_to}}">

                                            @error('date_to')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                        <div class="col-1 text-center">

                                            <button type="button" class="btn btn-info" onClick="add_more('minister')">
                                                <i class="fa fa-plus"> </i>
                                            </button>

                                        </div>
                                    </div>
                                    @endif
                                </div>

                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset>
                                <legend>@lang('State Minister')</legend>
                                <div id="state_minister_container">
                                    @if(!$existing_state_ministers->isEmpty())
                                    @foreach($existing_state_ministers as $state)
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <select name="state_minister_wing[]" class="@error('minister') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select Ministery Wings')</option>
                                                @foreach ($ministry_wing_list as $data)
                                                <option value="{{ $data->id }}" @if(isset($state->wing_id) && $data->id==$state->wing_id) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <select name="state_minister[]" class="@error('state_minister') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select State Minister')</option>
                                                @foreach ($profile_list as $data)
                                                <option value="{{ $data->user_id }}" @if( $data->user_id==$state->profile_id) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                                @endforeach
                                            </select>

                                            @error('state_minister')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="stateminister_from[]" class="form-control datepicker text-center " placeholder="@lang('Date From')" value="{{date('d.m.Y',strtotime($state->date_from))}}">

                                            @error('date_from')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="stateminister_to[]" class="form-control datepicker text-center " placeholder="@lang('Date To')" value="{{date('d.m.Y',strtotime($state->date_to))}}">

                                            @error('date_to')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                        <div class="col-1 text-center">
                                            @if($loop->iteration==1)
                                            <button type="button" class="btn btn-info" onClick="add_more('state_minister')">
                                                <i class="fa fa-plus"> </i>
                                            </button>
                                            @else
                                            <button type="button" class="btn btn-danger delete_me"> <i class="fa fa-times"> </i> </button>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <select name="state_minister_wing[]" class="@error('minister') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select Ministery Wings')</option>
                                                @foreach ($ministry_wing_list as $data)
                                                <option value="{{ $data->id }}" @if(isset($state->wing_id) && $data->id==$state->wing_id) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <select name="state_minister[]" class="@error('state_minister') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select State Minister')</option>
                                                @foreach ($profile_list as $data)
                                                <option value="{{ $data->user_id }}" @if(isset($state->profile_id) && $data->user_id==$state->profile_id) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                                @endforeach
                                            </select>

                                            @error('state_minister')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="stateminister_from[]" class="form-control datepicker text-center " placeholder="@lang('Date From')" value="{{$session_from}}">

                                            @error('date_from')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="stateminister_to[]" class="form-control datepicker text-center " placeholder="@lang('Date To')" value="{{$session_to}}">

                                            @error('date_to')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                        <div class="col-1 text-center">

                                            <button type="button" class="btn btn-info" onClick="add_more('state_minister')">
                                                <i class="fa fa-plus"> </i>
                                            </button>

                                        </div>
                                    </div>
                                    @endif
                                </div>

                            </fieldset>
                        </div>

                        <div class="col-12">
                            <fieldset>
                                <legend>@lang('Deputy Minister')</legend>
                                <div id="deputy_minister_container">
                                    @if(!$existing_deputy_ministers->isEmpty())
                                    @foreach($existing_deputy_ministers as $deputy)
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <select name="deputy_minister_wing[]" class="@error('minister') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select Ministery Wings')</option>
                                                @foreach ($ministry_wing_list as $data)
                                                <option value="{{ $data->id }}" @if(isset($deputy->wing_id) && $data->id==$deputy->wing_id) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <select name="deputy_minister[]" id="deputy_minister" class="@error('deputy_minister') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select Deputy Minister')</option>
                                                @foreach ($profile_list as $data)
                                                <option value="{{ $data->user_id }}" @if( $data->user_id==$deputy->profile_id) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                                @endforeach
                                            </select>

                                            @error('deputy_minister')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="deputyminister_from[]" class="form-control datepicker text-center " placeholder="@lang('Date From')" value="{{date('d.m.Y',strtotime($deputy->date_from))}}">

                                            @error('date_from')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="deputyminister_to[]" class="form-control datepicker text-center " placeholder="@lang('Date To')" value="{{date('d.m.Y',strtotime($deputy->date_to))}}">

                                            @error('date_to')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                        <div class="col-1 text-center">
                                            @if($loop->iteration==1)
                                            <button type="button" class="btn btn-info" onClick="add_more('deputy_minister')">
                                                <i class="fa fa-plus"> </i>
                                            </button>
                                            @else
                                            <button type="button" class="btn btn-danger delete_me"> <i class="fa fa-times"> </i> </button>
                                            @endif

                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <select name="deputy_minister_wing[]" class="@error('minister') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select Ministery Wings')</option>
                                                @foreach ($ministry_wing_list as $data)
                                                <option value="{{ $data->id }}" @if(isset($deputy->wing_id) && $data->id==$deputy->wing_id) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <select name="deputy_minister[]" id="deputy_minister" class="@error('deputy_minister') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select Deputy Minister')</option>
                                                @foreach ($profile_list as $data)
                                                <option value="{{ $data->user_id }}" @if( isset($deputy->profile_id) && $data->user_id==$deputy->profile_id) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                                @endforeach
                                            </select>

                                            @error('deputy_minister')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="deputyminister_from[]" class="form-control datepicker text-center " placeholder="@lang('Date From')" value="{{$session_from}}">

                                            @error('date_from')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="deputyminister_to[]" class="form-control datepicker text-center " placeholder="@lang('Date To')" value="{{$session_to}}">

                                            @error('date_to')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                        <div class="col-1 text-center">

                                            <button type="button" class="btn btn-info" onClick="add_more('deputy_minister')">
                                                <i class="fa fa-plus"> </i>
                                            </button>

                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset>
                                <legend>@lang('Secretary')</legend>
                                <div id="secretary_container">
                                    @if(!$existing_secretary->isEmpty())
                                    @foreach($existing_secretary as $sec)
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <select name="secretary_wing[]" class="@error('minister') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select Ministery Wings')</option>
                                                @foreach ($ministry_wing_list as $data)
                                                <option value="{{ $data->id }}" @if(isset($sec->wing_id) && $data->id==$sec->wing_id) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <select name="secretary[]" id="secretary" class="@error('secretary') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select State Minister')</option>
                                                @foreach ($profile_list as $data)
                                                <option value="{{ $data->user_id }}" @if( $data->user_id==$sec->profile_id) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                                @endforeach
                                            </select>

                                            @error('secretary')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="secretary_from[]" class="form-control datepicker text-center " placeholder="@lang('Date From')" value="{{date('d.m.Y',strtotime($sec->date_from))}}">

                                            @error('date_from')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="secretary_to[]" class="form-control datepicker text-center" placeholder="@lang('Date To')" value="{{date('d.m.Y',strtotime($sec->date_to))}}">

                                            @error('date_to')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                        <div class="col-1 text-center">
                                            @if($loop->iteration==1)
                                            <button type="button" class="btn btn-info" onClick="add_more('secretary')">
                                                <i class="fa fa-plus"> </i>
                                            </button>
                                            @else
                                            <button type="button" class="btn btn-danger delete_me"> <i class="fa fa-times"> </i> </button>
                                            @endif

                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <select name="secretary_wing[]" class="@error('minister') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select Ministery Wings')</option>
                                                @foreach ($ministry_wing_list as $data)
                                                <option value="{{ $data->id }}" @if(isset($sec->wing_id) && $data->id==$sec->wing_id) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <select name="secretary[]" id="secretary" class="@error('secretary') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select State Minister')</option>
                                                @foreach ($profile_list as $data)
                                                <option value="{{ $data->user_id }}">{{ $data->name_bn }}</option>
                                                @endforeach
                                            </select>

                                            @error('secretary')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="secretary_from[]" class="form-control datepicker text-center " placeholder="@lang('Date From')" value="{{$session_from}}">

                                            @error('date_from')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="secretary_to[]" class="form-control datepicker text-center" placeholder="@lang('Date To')" value="{{$session_to}}">

                                            @error('date_to')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                        <div class="col-1 text-center">
                                            <button type="button" class="btn btn-info" onClick="add_more('secretary')">
                                                <i class="fa fa-plus"> </i>
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset>
                                <legend>@lang('Joint Secretary')</legend>
                                <div id="joint_secretary_container">

                                    @if(!$existing_joint_secretary->isEmpty())
                                    @foreach($existing_joint_secretary as $joint_sec)
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <select name="joint secretary_wing[]" class="@error('minister') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select Ministery Wings')</option>
                                                @foreach ($ministry_wing_list as $data)
                                                <option value="{{ $data->id }}" @if(isset($joint_sec->wing_id) && $data->id==$joint_sec->wing_id) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <select name="joint secretary[]" id="joint secretary" class="@error('joint secretary') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select Joint Secretary')</option>
                                                @foreach ($profile_list as $data)
                                                <option value="{{ $data->user_id }}" @if( $data->user_id==$joint_sec->profile_id) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                                @endforeach
                                            </select>

                                            @error('joint secretary')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="jointsecretary_from[]" class="form-control datepicker text-center" placeholder="@lang('Date From')" value="{{date('d.m.Y',strtotime($joint_sec->date_from))}}">
                                            @error('date_from')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="jointsecretary_to[]" class="form-control datepicker text-center" placeholder="@lang('Date To')" value="{{date('d.m.Y',strtotime($joint_sec->date_to))}}">

                                            @error('date_to')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                        <div class="col-1 text-center">
                                            @if($loop->iteration==1)
                                            <button type="button" class="btn btn-info" onClick="add_more('joint_secretary')">
                                                <i class="fa fa-plus"> </i>
                                            </button>
                                            @else
                                            <button type="button" class="btn btn-danger delete_me"> <i class="fa fa-times"> </i> </button>
                                            @endif

                                        </div>
                                    </div>
                                    @endforeach

                                    @else
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <select name="joint secretary_wing[]" class="@error('minister') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select Ministery Wings')</option>
                                                @foreach ($ministry_wing_list as $data)
                                                <option value="{{ $data->id }}" @if(isset($joint_sec->wing_id) && $data->id==$joint_sec->wing_id) {{'selected="selected"'}} @endif >{{ $data->name_bn }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <select name="joint secretary[]" id="joint secretary" class="@error('joint secretary') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select Joint Secretary')</option>
                                                @foreach ($profile_list as $data)
                                                <option value="{{ $data->user_id }}">{{ $data->name_bn }}</option>
                                                @endforeach
                                            </select>

                                            @error('joint secretary')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="jointsecretary_from[]" class="form-control datepicker text-center" placeholder="@lang('Date From')" value="{{$session_from}}">
                                            @error('date_from')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="jointsecretary_to[]" class="form-control datepicker text-center" placeholder="@lang('Date To')" value="{{$session_to}}">

                                            @error('date_to')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                        <div class="col-1 text-center">
                                            <button type="button" class="btn btn-info" onClick="add_more('joint_secretary')">
                                                <i class="fa fa-plus"> </i>
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                            </fieldset>
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
        $(".datepicker").datepicker({
            format: 'dd.mm.yyyy',
            autoclose: true,
            orientation: 'auto'
        });
        $(".select2").select2({});
        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $('#reservationdate2').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $('#state_minister').select2({
            placeholder: "@lang('Select State Minister')",
            allowClear: true,
            //multiple: true,
        });
        $('#deputy_minister').select2({
            placeholder: "@lang('Select Deputy Minister')",
            allowClear: true,
            //multiple: true,
        });
        $('#secretary').select2({
            placeholder: "@lang('Select Secretary')",
            allowClear: true,
            //multiple: true,
        });
        $('#joint_secretary').select2({
            placeholder: "@lang('Select Joint Secretary')",
            allowClear: true,
            //multiple: true,
        });

        $(document).on("click", ".delete_me", function() {
            $(this).closest('.form-group').remove();
        });


    });

    function add_more(type) {
        console.log('actor type: ' + type);
        if (type == 'minister') {
            var more_minister = '<div class="form-group row"> <div class="col-3"> <select name="minister_wing[]" class="@error("minister") is-invalid @enderror form-control form-control-sm select2"> <option value="">@lang("Select Ministery Wings")</option> @foreach ($ministry_wing_list as $data) <option value="{{$data->id}}">{{$data->name_bn}}</option> @endforeach </select> </div><div class="col-3"> <select name="minister[]" class="@error("minister") is-invalid @enderror form-control form-control-sm select2"> <option value="">@lang("Select Minister")</option> @foreach ($profile_list as $data) <option value="{{$data->user_id}}" >{{$data->name_bn}}</option> @endforeach </select> @error("minister") <span class="text-danger">{{$message}}</span> @enderror </div><div class="col-2"> <input type="text" name="minister_from[]" class="form-control datepicker text-center " placeholder="@lang("Date From")" value="{{$session_from}}"> @error("date_from") <span class="invalid-feedback" role="alert"> <strong>{{$message}}</strong> </span> @enderror </div><div class="col-2"> <input type="text" name="minister_to[]" class="form-control datepicker text-center " placeholder="@lang("Date To")" value="{{$session_to}}"> @error("date_to") <span class="invalid-feedback" role="alert"> <strong>{{$message}}</strong> </span> @enderror </div><div class="col-1 text-center"> <button type="button" class="btn btn-danger delete_me"> <i class="fa fa-times"> </i> </button> </div></div>';
            $("#minister_container").append(more_minister);

        }
        if (type == 'state_minister') {
            var more_state_minister = '<div class="form-group row">  <div class="col-3"> <select name="state_minister_wing[]" class="@error("state minister") is-invalid @enderror form-control form-control-sm select2"> <option value="">@lang("Select Ministery Wings")</option> @foreach ($ministry_wing_list as $data) <option value="{{$data->id}}">{{$data->name_bn}}</option> @endforeach </select> </div> <div class="col-3"> <select name="state_minister[]" class="@error("state_minister") is-invalid @enderror form-control form-control-sm select2"> <option value="">@lang("Select State Minister")</option> @foreach ($profile_list as $data) <option value="{{$data->user_id}}" >{{$data->name_bn}}</option> @endforeach </select> @error("state_minister") <span class="text-danger">{{$message}}</span> @enderror </div><div class="col-2"> <input type="text" name="stateminister_from[]" class="form-control datepicker text-center " placeholder="@lang("Date From")" value="{{$session_from}}"> @error("date_from") <span class="invalid-feedback" role="alert"> <strong>{{$message}}</strong> </span> @enderror </div><div class="col-2"> <input type="text" name="stateminister_to[]" class="form-control datepicker text-center " placeholder="@lang("Date To")" value="{{$session_to}}"> @error("date_to") <span class="invalid-feedback" role="alert"> <strong>{{$message}}</strong> </span> @enderror </div><div class="col-1 text-center"> <button type="button" class="btn btn-danger delete_me"> <i class="fa fa-times"> </i> </button> </div></div>';
            $("#state_minister_container").append(more_state_minister);

        }
        if (type == 'deputy_minister') {
            var more_deputy_minister = '<div class="form-group row">  <div class="col-3"> <select name="deputy_minister_wing[]" class="@error("Deputy minister") is-invalid @enderror form-control form-control-sm select2"> <option value="">@lang("Select Ministery Wings")</option> @foreach ($ministry_wing_list as $data) <option value="{{$data->id}}">{{$data->name_bn}}</option> @endforeach </select> </div> <div class="col-3"> <select name="deputy_minister[]" class="@error("deputy_minister") is-invalid @enderror form-control form-control-sm select2"> <option value="">@lang("Select Deputy Minister")</option> @foreach ($profile_list as $data) <option value="{{$data->user_id}}" >{{$data->name_bn}}</option> @endforeach </select> @error("deputy_minister") <span class="text-danger">{{$message}}</span> @enderror </div><div class="col-2"> <input type="text" name="deputyminister_from[]" class="form-control datepicker text-center " placeholder="@lang("Date From")" value="{{$session_from}}"> @error("date_from") <span class="invalid-feedback" role="alert"> <strong>{{$message}}</strong> </span> @enderror </div><div class="col-2"> <input type="text" name="deputyminister_to[]" class="form-control datepicker text-center " placeholder="@lang("Date To")" value="{{$session_to}}"> @error("date_to") <span class="invalid-feedback" role="alert"> <strong>{{$message}}</strong> </span> @enderror </div><div class="col-1 text-center"> <button type="button" class="btn btn-danger delete_me"> <i class="fa fa-times"> </i> </button> </div></div>';
            $("#deputy_minister_container").append(more_deputy_minister);

        }
        if (type == 'secretary') {
            var more_secretary = '<div class="form-group row"> <div class="col-3"> <select name="secretary_wing[]" class="@error("Secretary") is-invalid @enderror form-control form-control-sm select2"> <option value="">@lang("Select Ministery Wings")</option> @foreach ($ministry_wing_list as $data) <option value="{{$data->id}}">{{$data->name_bn}}</option> @endforeach </select> </div> <div class="col-3"> <select name="secretary[]" class="@error("secretary") is-invalid @enderror form-control form-control-sm select2"> <option value="">@lang("Select Secretary")</option> @foreach ($profile_list as $data) <option value="{{$data->user_id}}" >{{$data->name_bn}}</option> @endforeach </select> @error("secretary") <span class="text-danger">{{$message}}</span> @enderror </div><div class="col-2"> <input type="text" name="secretary_from[]" class="form-control datepicker text-center " placeholder="@lang("Date From")" value="{{$session_from}}"> @error("date_from") <span class="invalid-feedback" role="alert"> <strong>{{$message}}</strong> </span> @enderror </div><div class="col-2"> <input type="text" name="secretary_to[]" class="form-control datepicker text-center " placeholder="@lang("Date To")" value="{{$session_to}}"> @error("date_to") <span class="invalid-feedback" role="alert"> <strong>{{$message}}</strong> </span> @enderror </div><div class="col-1 text-center"> <button type="button" class="btn btn-danger delete_me"> <i class="fa fa-times"> </i> </button> </div></div>';
            $("#secretary_container").append(more_secretary);

        }
        if (type == 'joint_secretary') {
            var more_joint_secretary = '<div class="form-group row"> <div class="col-3"> <select name="joint secretary_wing[]" class="@error("Joint Secretary") is-invalid @enderror form-control form-control-sm select2"> <option value="">@lang("Select Ministery Wings")</option> @foreach ($ministry_wing_list as $data) <option value="{{$data->id}}">{{$data->name_bn}}</option> @endforeach </select> </div> <div class="col-3"> <select name="joint_secretary[]" class="@error("joint_secretary") is-invalid @enderror form-control form-control-sm select2"> <option value="">@lang("Select Joint Secretary")</option> @foreach ($profile_list as $data) <option value="{{$data->user_id}}" >{{$data->name_bn}}</option> @endforeach </select> @error("joint_secretary") <span class="text-danger">{{$message}}</span> @enderror </div><div class="col-2"> <input type="text" name="jointsecretary_from[]" class="form-control datepicker text-center " placeholder="@lang("Date From")" value="{{$session_from}}"> @error("date_from") <span class="invalid-feedback" role="alert"> <strong>{{$message}}</strong> </span> @enderror </div><div class="col-2"> <input type="text" name="jointsecretary_to[]" class="form-control datepicker text-center " placeholder="@lang("Date To")" value="{{$session_to}}"> @error("date_to") <span class="invalid-feedback" role="alert"> <strong>{{$message}}</strong> </span> @enderror </div><div class="col-1 text-center"> <button type="button" class="btn btn-danger delete_me"> <i class="fa fa-times"> </i> </button> </div></div>';
            $("#joint_secretary_container").append(more_joint_secretary);

        }
        $(".datepicker").datepicker({
            format: 'dd.mm.yyyy',
            autoclose: true,
            orientation: 'auto'
        });
        $(".select2").select2({});
    }

    function save_data(id, type) {
        $.ajax({
            url: "{{url('admin/master-setup/cabinet/save')}}",
            type: "POST",
            data: {
                _token: "{{csrf_token()}}",
                ministry_id: id,
                //minister_id: $("#minister_id").val(),
                minister: $("#ministers").val(),
                state_minister: $("#state_ministers").val(),
                deputy_minister: $("#deputy_minister").val(),
                secretary: $("#secretaries").val(),
                joint_secretary: $("#joint_secretaries").val(),
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