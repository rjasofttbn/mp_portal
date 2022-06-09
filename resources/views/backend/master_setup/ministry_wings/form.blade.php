@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Ministry Wings Management')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Ministry Wings Management')</li>
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
                <h4 class="card-title">@lang('Update Ministry Wings')</h4>
                @else
                <h4 class="card-title">@lang('Create Ministry Wings')</h4>
                @endif
            </div>
            <!-- Form Start-->
            <form id="ministrywingsForm" name="ministrywingsForm" method="POST" @if($data->id)
                action="{{ route('admin.master_setup.ministry_wings.update', $data->id) }}">
                <input name="_method" type="hidden" value="PUT">
                @else
                action="{{ route('admin.master_setup.ministry_wings.store') }}">
                @endif
                @csrf

                <input type="hidden" id="id" name="id" value="{{$data->id}}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="ministry_id">@lang('Ministry')<span style="color: red;"> *</span></label>
                                <select id="ministry_id" name="ministry_id" class="form-control select2 @error('ministry_id') is-invalid @enderror" >
                                    <option value="">@lang('Select Ministry')</option>
                                    @foreach ($ministry_list as $list)
                                    <option value="{{$list->id}}" {{($data->ministry_id==$list->id)? 'selected':''}}>
                                        @if(session()->get('language') =='bn')
                                        {{$list['name_bn']}}
                                        @else
                                        {{$list['name_eng']}}
                                        @endif
                                    </option>
                                   
                                    @endforeach
                                </select>

                                @error('ministry_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="name_eng">@lang('Name (English)')<span style="color: red;"> *</span></label>
                                <input type="text" id="name_eng" name="name_eng" value="{{old('name_eng', $data->name_eng)}}" class="form-control @error('name_eng') is-invalid @enderror" placeholder="@lang('Enter Name in English')" autocomplete="off">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="name_bn">@lang('Name (Bangla)')<span style="color: red;"> *</span></label>
                                <input type="text" id="name_bn" name="name_bn" value="{{old('name_bn', $data->name_bn)}}" class="form-control @error('name_bn') is-invalid @enderror" placeholder="@lang('Enter Name in Bangla')" autocomplete="off">

                                @error('name_bn')
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
                                    <a href="{{route('admin.master_setup.ministries.index') }}">@lang('Back')</a>
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