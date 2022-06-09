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
                <form id="noticeCreateForm" onsubmit="return validateForm()" class="form-horizontal" action="{{route('admin.notice_management.notices.store')}}" method="POST" enctype="multipart/form-data">
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


 
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <label class="control-label" for="question_rights">@lang('2'). @lang('Question of Rights') <span class="text-danger"> *</span></label>
                            </div>
                            <div class="col-sm-12 col-md-10 col-lg-10">
                                <textarea id="question_rights" name="topic"  class="textareaWithoutImgVideo form-control @error('topic') is-invalid @enderror">
                                    {{old('topic')}}
                                    </textarea>

                                {{-- @error('topic')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                                <div id="questionRightsMsg" class="text-danger"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <label class="control-label" for="attachment_details">@lang('3'). @lang('Relevant Documents Attachment Details') <span class="text-danger"> *</span></label>
                            </div>
                            <div class="col-sm-12 col-md-10 col-lg-10">
                                <textarea id="attachment_details" name="description[attachment_details]"  class="textareaWithoutImgVideo form-control @error('description.attachment_details') is-invalid @enderror">
                                {{old('description.attachment_details')}}
                                </textarea>

                                {{-- @error('description.attachment_details')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                                <div id="attachmentDetailsMsg" class="text-danger"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <label class="control-label" for="attachment">@lang('4'). @lang('Attachment') <span class="text-danger"> *</span></label>
                            </div>
                            <div class="col-sm-12 col-md-10 col-lg-10">
                                <div class="file p-0">
                                    <input type="file" class="form-control @error('attachment') is-invalid @enderror attachment_upload pl-1" name="attachment[]" id="attachment" multiple accept=".png, .jpg, .jpeg, .pdf">
                                </div>

                                {{-- @error('attachment')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                                <div id="attachmentMsg" class="text-danger"></div>
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
        function validateForm() {
            var question_rights = document.getElementById("question_rights").value;
            var attachment_details = document.getElementById("attachment_details").value;
            var attachment = document.getElementById("attachment").value;

            if (question_rights == "") {
                $("#questionRightsMsg").html("This field is required.");
            return false;
            }
            if (attachment_details == "") {
                $("#attachmentDetailsMsg").html("This field is required.");
            return false;
            }
            if (attachment == "") {
                $("#attachmentMsg").html("This field is required.");
            return false;
            }
            return true;
        }
    </script>
    @endsection
