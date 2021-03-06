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
                <h4 class="card-title">@lang('Update Notice')</h4>
            </div>
            <div class="card-body">
                <!-- Form Start-->
                <form method="POST" action="{{ route('admin.notice_management.notices.update', $editData->id) }}" enctype="multipart/form-data">
                    @csrf
                    @if (isset($editData))
                    @method('PUT')
                    @endif

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <label class="control-label" for="subject">@lang('1'). @lang('Subject') <span class="text-danger"> *</span></label>
                            </div>
                            <div class="col-sm-12 col-md-10 col-lg-10">
                                <select name="subject" id="subject" readonly class="form-control">
                                    <option value="{{ $editData->rule_number }}">{{ $editData->rule_name }}</option>
                                </select>

                                @error('subject')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="rule_number" id="rule_number" value="{{ $editData->parliamentRule->rule_number }}">
                    <input type="hidden" name="notice_from" id="notice_from" value="{{ $editData->notice_from }}">


                    {{-- <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label class="control-label" for="notice_from">@lang('2'). @lang('From') <span class="text-danger"> *</span></label>
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <select name="notice_from" readonly id="notice_from" class="form-control">
                                            @foreach ($allProfileData as $data)
                                            @if($data->user_id == $editData->notice_from)
                                            <option selected value="{{ $data->user_id }}">{{ $data->name_bn }}</option>

                    @endif
                    @endforeach
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
            <label class="control-label" for="parliament_session">@lang('2'). @lang('Parliament Session')
                <span class="text-danger"> *</span></label>
        </div>
        <div class="col-sm-12 col-md-10 col-lg-10">
            <select id="parliament_session" name="parliament_session" class="@error('parliament_session') is-invalid @enderror form-control select2">
                <option value="">@lang('Select Parliament Session')</option>
                @foreach($parliament_sessions as $p)
                <option value="{{$p['id']}}" {{ ($editData->parliament_session== $p['id']) ? 'selected' : '' }}>{{$p['name']}}</option>
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
            {{old('topic') ?? $editData->topic ?? '' }}
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
            <br />

            @foreach($attachments as $file)
            <a href="{{ asset('public/backend/attachment/'.$file->attachment)  }}" target="_blank">View Previous Attachment - {{ $loop->iteration }}</a><br />
            @endforeach

            @error('attachment')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
@if(auth()->user()->usertype=='staff')
<div class="form-group">
    <div class="row">
        <div class="col-2">
            <label class="control-label" for="decision_proposal">???????????????????????????</label>
        </div>
        <div class="col-3">
            <select class="form-control select2" id="status_id" name="status_id">
                <option value="">??????????????????????????? ???????????????????????? ????????????</option>
                @foreach($status_list as $list)
                <option value="{{$list->status_id}}" @if($list->status_id==$editData->status) {{'selected="selected"'}} @endif>{{$list->name_bn}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-3 text-right acceptable_tag">
            <input type="radio" class="form-check-input" id="acceptable_with_correction" name="acceptance_tag" value="2" {{($editData->acceptance_tag==2)?'checked':'unchecked'}}>
            <label class="form-check-label" for="acceptable_with_correction">@lang('Acceptable with Correction')</label>
        </div>
        <div class="col-3 text-right acceptable_tag">
            <input type="radio" class="form-check-input" id="acceptable_without_correction" name="acceptance_tag" value="1" {{($editData->acceptance_tag==1)?'checked':'unchecked'}}>
            <label class="form-check-label" for="acceptable_without_correction">@lang('Acceptable')</label>
        </div>
    </div>
</div>
<!-- <div class="form-group @if($editData->comments=='') d-none @endif" id="comment_container"> -->
<div class="form-group" id="comment_container">
    <div class="row">
        <div class="col-sm-12 col-md-2 col-lg-2">
            <label class="control-label" for="decision_proposal">?????????????????????</label>
        </div>
        <div class="col-sm-12 col-md-10 col-lg-10">
            <textarea id="other_comments" name="comments" class="form-control">{{$editData->comments}}</textarea>
        </div>
    </div>
</div>
@endif
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group text-right">
            <button type="button" class="btn btn-secondary btn-sm white-text">
                <a href="{{ url()->previous() }}">@lang('Back')</a>
            </button>
            <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
            @if (auth()->user()->usertype == 'mp')
            <input type="submit" name="draft" value="@lang('Save as Draft')" class="btn btn-info btn-sm">
            @endif
            <button type="submit" class="btn btn-success btn-sm">@lang('Save')</button>
        </div>
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
    $(document).ready(function() {
        $("#status_id").on('change', function() {
            if ($(this).val() == 6) {
                $(".acceptable_tag").removeClass('d-none');
                $(".acceptable_tag").addClass('block');
            } else {
                $(".acceptable_tag").removeClass('block');
                $(".acceptable_tag").addClass('d-none');
            }
        });

        @php
        if ($editData->acceptance_tag != NULL) {
            @endphp
            $(".acceptable_tag").removeClass('d-none');
            $(".acceptable_tag").addClass('block');
            @php
        } else {
            @endphp
            $(".acceptable_tag").removeClass('block');
            $(".acceptable_tag").addClass('d-none');
            @php
        }
        @endphp


    });
</script>
@endsection