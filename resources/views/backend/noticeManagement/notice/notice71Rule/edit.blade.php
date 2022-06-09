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
                                    <option value="{{ $editData->rule_number }}">{{ $editData->name }}</option>
                                </select>

                                @error('subject')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="rule_number" id="rule_number" value="{{ $editData->parliamentRule->rule_number }}">
                    <input type="hidden" name="notice_from" id="notice_from" value="{{ $editData->notice_from }}">

                    {{-- <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="notice_from">@lang('2'). @lang('From') <span
                                            class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-10 col-lg-10"> --}}
                                {{-- @if (auth()->user()->usertype == 'speaker')
                                        <select name="notice_from" id="notice_from" class="form-control">
                                            <option value="">@lang('Select MP Name')</option>
                                            @if (isset($allProfileData) && count($allProfileData) > 0)
                                                @foreach ($allProfileData as $data)
                                                    @if($data->user_id == $editData->notice_from)
                                                        <option selected value="{{ $data->user_id }}">{{ $data->name_bn }} ({{ $data->voter_area }})</option>
                                                    @else
                                                    <option value="{{ $data->user_id }}">{{ $data->name_bn }} ({{ $data->voter_area }})</option>
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                    </select>
                                                    @else --}}
                                    {{-- <select name="notice_from" id="notice_from" readonly class="form-control">
                                                            <option value="{{ $editData->profileForNoticeFrom->user_id }}">{{ $editData->profileForNoticeFrom->name_bn }}</option>
                                    </select> --}}
                                    {{-- @endif --}}

                                    {{-- @error('notice_from')
                                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label class="control-label" for="to_ministry_id">@lang('3'). @lang('Ministry') <span class="text-danger"> *</span></label>
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <select id="to_ministry_id" name="to_ministry_id"  class="@error('to_ministry_id') is-invalid @enderror form-control form-control-sm select2">
                                            <option value="">@lang('Select Ministry Name')</option>
                                                @foreach ($ministries as $ministry)
                                                <option {{ ($editData->to_ministry_id == $ministry->id) ? 'selected' : ''}} value="{{ $ministry->id }}">
                                                    @if(session()->get('language') =='bn')
                                                        {{ $ministry->name_bn }}
                                                    @else
                                                        {{ $ministry->name }}
                                                    @endif
                                                </option>
                                                @endforeach
                                         
                                        </select>
                                        @error('to_ministry_id')
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
                                        <label class="control-label" for="to_wing_id">@lang('4'). @lang('Ministry Wings') <span class="text-danger"> *</span></label>
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <select id="to_wing_id" name="to_wing_id" class="@error('to_wing_id') is-invalid @enderror form-control form-control-sm select2">
                                            @foreach($wing_list as $w)
                                            <option value="{{$w->id}}" {{ ($editData->to_wing_id==$w->id)?'selected="selected"':''}}>{{$w->name_bn}}</option>
                                            @endforeach
                                        </select>
                                        @error('to_wing_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" id="notice_to" name="notice_to" value="{{$editData->notice_to}}">
                            </div>
                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <label class="control-label" for="notice_to">@lang('2'). @lang('To') <span class="text-danger"> *</span></label>
                            </div>

                            <div class="col-sm-12 col-md-10 col-lg-10">
                                <select id="notice_to" name="notice_to" class="@error('notice_to') is-invalid @enderror form-control form-control-sm select2">
                                    <option value="">@lang('Select the Recipient')</option>

                                    @foreach ($allProfileData as $data)
                                    @if($data->user_id == $editData->notice_to)
                                    <option selected value="{{ $data->user_id }}">{{ $data->name_bn }} ({{ $data->voter_area }})</option>
                                    @else
                                    <option value="{{ $data->user_id }}">{{ $data->name_bn }} ({{ $data->voter_area }})</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <label class="control-label" for="notice_from">@lang('2'). @lang('From') <span class="text-danger"> *</span></label>
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
                    <div class="form-group">
                        @if(auth()->user()->usertype=='staff')
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label class="control-label" for="decision_proposal">স্ট্যাটাস</label>
                                </div>
                                <div class="col-3">
                                    <select class="form-control select2" id="status_id" name="status_id">
                                        <option value="">স্ট্যাটাস নির্বাচন করুন</option>
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
                                    <label class="control-label" for="decision_proposal">মন্তব্য</label>
                                </div>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <textarea id="other_comments" name="comments" class="form-control">{{$editData->comments}}</textarea>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-secondary btn-sm white-text">
                                    <a href="{{ route('admin.notice_management.notices.index') }}">@lang('Back')</a>
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                <input type="submit" name="draft" value="@lang('Save as Draft')" class="btn btn-info btn-sm">
                                <button type="submit" class="btn btn-success btn-sm">@lang('Submit')</button>
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

    <script>
        $(function() {

            $("#to_ministry_id").on('change',function(){
                var ministry_id = $(this).val();
                if(ministry_id==''){
                    $('#to_wing_id').html('');
                }
                load_items('wing', ministry_id);
            });
        })
        
        function load_items(type, ministry = null) {
            var request_data = {};
            if (type == 'ministry') {
                $('#to_wing_id').html('');
                var selected_date = $("#datepicker").val();
                request_data = {
                    type: type,
                    circular_date: selected_date
                };

            } else if (type == 'wing') {
                request_data = {
                    type: type,
                    ministry_id: ministry
                };
            }

            $.ajax({
                url: '{{url("admin/notice-management/ministryitem")}}',
                data: request_data,
                type: "GET",
                dataType: "json",
                success: function(result) {
                    console.log(result);
                    if (type == 'ministry') {
                        $('#to_ministry_id').html('');
                        $('#to_ministry_id').append(result.data);
                    }
                    else if (type == 'wing') {
                        $('#to_wing_id').html('');
                        $('#to_wing_id').append(result.data);
                    }
                }
            });
        }
    </script>
    @endsection