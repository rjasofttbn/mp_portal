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
                                <label class="control-label" for="notice_from">@lang('2'). @lang('From') <span class="text-danger"> *</span></label>
                            </div>
                            <div class="col-sm-12 col-md-10 col-lg-10">
                                <!-- @if (auth()->user()->usertype == 'speaker')
                                <select name="notice_from" id="notice_from" class="form-control">
                                    <option value="">@lang('Select MP Name')</option>
                                    @if (isset($allProfileData) && count($allProfileData) > 0)
                                    @foreach ($allProfileData as $data)
                                    @if($data->user_id == $editData->notice_from)
                                    <option selected value="{{ $data->user_id }}">{{ $data->name_bn }}</option>
                    @else
                    <option value="{{ $data->user_id }}">{{ $data->name_bn }}</option>
                    @endif
                    @endforeach
                    @endif
                    </select>
                    @else -->
                    <select name="notice_from" id="notice_from" readonly class="form-control">
                        @foreach ($allProfileData as $data)
                        @if($data->user_id == $editData->notice_from)
                        <option selected value="{{ $data->user_id }}">{{ $data->name_bn }}</option>

                        @endif
                        @endforeach
                    </select>
                    <!-- @endif -->

                    @error('notice_from')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
            </div>
        </div>
    </div> --}}
    <div class="form-group">
        <div class="row">
            <div class="col-2">
                <label class="control-label" for="date">@lang('2'). @lang('Sitting Date') <span class="text-danger"> *</span></label>
            </div>
            <div class="col-4">
                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input @error('date') is-invalid @enderror" name="date" oninput="load_items('ministry')" id="notice_date" data-firstdate="{{ $parliamentSession->date_from ?? null }}" data-lastdate="{{ $parliamentSession->date_to ?? null }}" placeholder="@lang('Select Date')" />
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>

                @error('date')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <label class="control-label" for="to_ministry_id">@lang('3'). @lang('Ministry') <span class="text-danger"> *</span></label>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <select id="to_ministry_id" name="to_ministry_id" onchange="load_wings()" class="@error('to_ministry_id') is-invalid @enderror form-control form-control-sm select2">
                            @foreach($ministry_list as $m)
                            <option value="{{$m->id}}" {{ ($editData->to_ministry_id==$m->id)?'selected="selected"':''}}>{{$m->name_bn}}</option>
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
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <label class="control-label" for="question_type">@lang('5'). @lang('Question Type') <span class="text-danger"> *</span></label>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <select id="question_type" name="question_type" class="@error('question_type') is-invalid @enderror form-control form-control-sm select2">
                            <option value="">@lang('Select Question Type')</option>
                            @foreach($question_types as $q)
                            <option value="{{$q['id']}}" {{ ($editData->question_type== $q['id']) ? 'selected' : '' }}>{{$q['name']}}</option>
                            @endforeach
                        </select>
                        <div>
                            @error('question_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">

            <div class="form-group pr-1">
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4 pl-4">
                        <label class="control-label" for="parliament_session">@lang('6'). @lang('Parliament Session')
                            <span class="text-danger"> *</span></label>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <select id="parliament_session" name="parliament_session" class="@error('parliament_session') is-invalid @enderror form-control form-control-sm select2">
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
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12 col-md-2 col-lg-2">
                <label class="control-label" for="topic">@lang('7'). @lang('Question') <span class="text-danger"> *</span></label>
            </div>
            <div class="col-sm-12 col-md-10 col-lg-10">
                <textarea id="question" name="topic" class="textareaWithoutImgVideo form-control @error('topic') is-invalid @enderror">
                {{old('topic') ?? $editData->topic ?? '' }}
                </textarea>

                @error('topic')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    {{-- <div class="form-group">
        <div class="row">
            <div class="col-sm-12 col-md-2 col-lg-2">
                <label class="control-label" for="attachment">@lang('8'). @lang('Attachment (if any)')</label>
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
</div> --}}

<div class="row">
    <div class="col-sm-12">
        <div class="form-group text-right">
            <button type="button" class="btn btn-secondary btn-sm white-text">
                <a href="{{ route('admin.notice_management.notices.index') }}">@lang('Back')</a>
            </button>
            <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
            @if (auth()->user()->usertype == 'mp')
            <input type="submit" name="draft" value="@lang('Save as Draft')" class="btn btn-info btn-sm">
            @endif
            <button type="submit" class="btn btn-success btn-sm">@lang('Save')</button>
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
    $(function() {
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        $("#notice_date").val("{{date('d-m-Y',strtotime($editData->date))}}");

        $("#notice_date").on('change', function() {
            return false;
        });
    })

    function load_wings() {
        let ministry_id = $("#to_ministry_id").val();
        $('#to_wing_id').html('');
        load_items('wing', ministry_id);
    }

    function load_items(type, ministry = null) {
        var request_data = {};
        if (type == 'ministry') {
            $('#to_wing_id').html('');
            var selected_date = $("#notice_date").val();
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
                } else if (type == 'wing') {
                    $('#to_wing_id').html('');
                    $('#to_wing_id').append(result.data);
                }
            }
        });
    }
</script>
@endsection