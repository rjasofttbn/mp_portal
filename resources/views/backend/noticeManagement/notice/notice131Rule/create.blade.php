@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Notice Management')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Notice Management')</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<div class="content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('Create Notice')</h4>
            </div>
            <div class="card-body">
                <form id="noticeCreateForm" class="form-horizontal" action="{{route('admin.notice_management.notices.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <label class="control-label" for="subject">@lang('1'). @lang('Subject') <span class="text-danger"> *</span></label>
                            </div>
                            <div class="col-sm-12 col-md-10 col-lg-10">
                                <select name="subject" id="subject" readonly class="form-control">
                                    <option value="{{ $ruleData->rule_number }}">{{ $ruleData->name }}</option>
                                </select>

                                @error('subject')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="rule_number" id="rule_number" value="{{ $ruleData->rule_number }}">
                    <input type="hidden" name="notice_from" id="notice_from" value="{{ $mpProfile->user_id }}">


                    {{-- <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label class="control-label" for="notice_from">@lang('2'). @lang('From') <span class="text-danger"> *</span></label>
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-8">

                                        <select name="notice_from" id="notice_from" readonly class="form-control">
                                            <option value="{{ $mpProfile->user_id }}">{{ $mpProfile->name_bn }}</option>
                    </select>

                    @error('notice_from')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
            </div>
        </div>
    </div>

</div> --}}

<div class="form-group">
    <div class="row">
        <div class="col-sm-12 col-md-2 col-lg-2">
            <label class="control-label" for="parliament_session">@lang('2'). @lang('Parliament Session') <span class="text-danger"> *</span></label>
        </div>
        <div class="col-sm-12 col-md-10 col-lg-10">
            <select id="parliament_session" name="parliament_session" class="@error('parliament_session') is-invalid @enderror form-control form-control-sm select2">
                <option value="">@lang('Select Parliament Session')</option>
                @foreach($parliament_sessions as $p)
                <option value="{{$p['id']}}" {{ old('parliament_session') == $p['id'] ? 'selected' : '' }}>{{$p['name']}}</option>
                @endforeach
            </select>
            <div>
                @error('parliament_session')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-sm-12 col-md-2 col-lg-2">
            <label class="control-label" for="topic">@lang('3'). @lang('Decision Proposal') <span class="text-danger"> *</span></label>
        </div>
        <div class="col-sm-12 col-md-10 col-lg-10">
            <textarea id="topic" name="topic" class="textareaWithoutImgVideo form-control @error('topic') is-invalid @enderror">
            {{old('topic')}}
            </textarea>

            @error('topic')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-sm-12 col-md-2 col-lg-2">
            <label class="control-label" for="attachment">@lang('4'). @lang('Attachment (if any)')</label>
        </div>
        <div class="col-sm-12 col-md-10 col-lg-10">
            <div class="file p-0">
                <input type="file" class="form-control attachment_upload pl-1" name="attachment[]" id="attachment" multiple accept=".png, .jpg, .jpeg, .pdf">
            </div>

            @error('attachment')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group text-right">
            <button type="button" class="btn btn-secondary btn-sm white-text">
                <a href="{{ route('admin.notice_management.notices.index') }}">@lang('Back')</a>
            </button>
            <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
            @if (auth()->user()->usertype != 'ps')
            <input type="submit" name="draft" value="@lang('Save as Draft')" class="btn btn-info btn-sm">
            <input type="submit" name="submit" value="@lang('Save')" class="btn btn-success btn-sm">
            @else
            <input type="submit" name="submit" value="@lang('Save')" class="btn btn-success btn-sm">
            @endif
        </div>
    </div>
</div>
</form>
</div>
</div>

</div>


@endsection
@section('script')
<script>

</script>
@endsection