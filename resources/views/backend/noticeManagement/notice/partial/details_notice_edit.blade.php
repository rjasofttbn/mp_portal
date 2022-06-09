<style>
    .big_checkbox {
        height: 30px;
        width: 30px;
    }

    .big_label {
        padding-left: 22px;
        line-height: 40px;
        font-size: 20px;
        cursor: pointer;
    }
</style>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5 class="d-inline-block float-left pt-2 mb-0">{{ $notices->parliamentRule->name }}</h5>
            <a class="btn btn-info btn-md d-inline-block float-right" onClick="go_back()"><i class="fas fa-backward"></i> @lang('Back')</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">@lang('Update Notice')</h4>
        </div>
        <div class="card-body">
            <!-- Form Start-->
            <form method="POST" action="{{ route('admin.notice_management.notices.update', $notices->id) }}" enctype="multipart/form-data">
                @csrf
                @if (isset($notices))
                @method('PUT')
                @endif

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-2">
                            <label class="control-label" for="subject">@lang('1'). @lang('Subject') <span class="text-danger"> *</span></label>
                        </div>
                        <div class="col-sm-12 col-md-10 col-lg-10">
                            <select name="subject" id="subject" readonly class="form-control">
                                <option value="{{ $ruleData->id }}">{{ $ruleData->name }}</option>
                            </select>

                            @error('subject')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <input type="hidden" name="rule_id" id="rule_id" value="{{ $notices->parliamentRule->id }}">
                <input type="hidden" name="notice_from" id="notice_from" value="{{ $notices->notice_from }}">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-2">
                            <label class="control-label" for="notice_to">@lang('2'). @lang('To') <span class="text-danger"> *</span></label>
                        </div>

                        <div class="col-sm-12 col-md-10 col-lg-10">
                            <select id="notice_to" name="notice_to" class="@error('notice_to') is-invalid @enderror form-control form-control-sm select2">
                                <option value="">@lang('Select the Recipient')</option>

                                @foreach ($allProfileData as $data)
                                @if($data->user_id == $notices->notice_to)
                                <option selected value="{{ $data->user_id }}">{{ $data->name_bn }}</option>
                                @else
                                <option value="{{ $data->user_id }}">{{ $data->name_bn }}</option>
                                @endif
                                @endforeach

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                            <label class="control-label" for="notice_from">@lang('2'). @lang('From') <span class="text-danger"> *</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-10 col-lg-10">
                                            <textarea id="bill_topic" name="bill_topic" class="textareaWithoutImgVideo form-control @error('bill_topic') is-invalid @enderror">
                                            {{old('bill_topic') ?? $notices->bill_topic ?? '' }}
                                            </textarea>

                                            @error('bill_topic')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
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
                                </div> -->

                                @if(auth()->user()->usertype==='staff')
                                <!-- @if($notices->rule_id==2 || $notices->rule_id==6 || $notices->rule_id==7) -->
                                <!-- @endif -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-2">
                                            <label class="control-label" for="decision_proposal">স্ট্যাটাস</label>
                                        </div>
                                        <div class="col-3">
                                            <select class="form-control select2" id="status_id" name="status_id">
                                                <option value="">স্ট্যাটাস নির্বাচন করুন</option>
                                                @foreach($status_list as $list)
                                                <option value="{{$list->status_id}}" @if($list->status_id==$notices->status) {{'selected="selected"'}} @endif>{{$list->name_bn}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3 text-right acceptable_tag">
                                            <input type="radio" class="form-check-input" id="acceptable_with_correction" name="acceptance_tag" value="2" {{($notices->acceptance_tag==2)?'checked':'unchecked'}}>
                                            <label class="form-check-label" for="acceptable_with_correction">@lang('Acceptable with Correction')</label>
                                        </div>
                                        <div class="col-3 text-right acceptable_tag">
                                            <input type="radio" class="form-check-input" id="acceptable_without_correction" name="acceptance_tag" value="1" {{($notices->acceptance_tag==1)?'checked':'unchecked'}}>
                                            <label class="form-check-label" for="acceptable_without_correction">@lang('Acceptable')</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group @if($notices->comments=='') d-none @endif" id="comment_container"> -->
                                <div class="form-group" id="comment_container">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                            <label class="control-label" for="decision_proposal">মন্তব্য</label>
                                        </div>
                                        <div class="col-sm-12 col-md-10 col-lg-10">
                                            <textarea id="other_comments" name="comments" class="form-control">{{$notices->comments}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                @endif

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

        $(".select2").select2({

        });

        "@if($notices->acceptance_tag != NULL)";
        $(".acceptable_tag").removeClass('d-none');
        $(".acceptable_tag").addClass('block');
        "@else"
        $(".acceptable_tag").removeClass('block');
        $(".acceptable_tag").addClass('d-none');
        "@endif"

    });

    function go_back() {
        $('#main_content').show();
        $('#details_content').hide();
    }
</script>