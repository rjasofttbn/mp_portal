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

                    {{-- <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="notice_from">@lang('2'). @lang('From') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-10 col-lg-10"> --}}
                    {{-- @if (auth()->user()->usertype == 'speaker')
                                        <select name="notice_from" id="" class="form-control">
                                            <option value="">@lang('Select MP Name')</option>
                                            @if (isset($allProfileData) && count($allProfileData) > 0)
                                                @foreach ($allProfileData as $data)
                                                    @if($data->user_id == old('notice_from'))
                                                        <option selected value="{{ $data->user_id }}">{{ $data->name_bn }}</option>
                    @else
                    <option value="{{ $data->user_id }}">{{ $data->name_bn }}</option>
                    @endif
                    @endforeach
                    @endif
                    </select>
                    @else --}}
                    {{-- <select name="notice_from" id="notice_from" readonly class="form-control">
                                            <option value="{{ $mpProfile->user_id }}">{{ $mpProfile->name_bn }}</option>
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
                        <label class="control-label" for="question_type">@lang('2'). @lang('Question type was') <span class="text-danger"> *</span></label>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <select id="question_type" name="description[question_type]" class="@error('description.question_type') is-invalid @enderror form-control form-control-sm select2">
                            <option selected value="">@lang('Select Question Type')</option>
                            @foreach($question_types as $q)
                            <option value="{{$q['id']}}" {{ old('description.question_type') == $q['id'] ? 'selected' : '' }}>{{$q['name']}}</option>
                            @endforeach
                        </select>
                        <div>
                            @error('description.question_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <label class="control-label" for="previous_date">@lang('4'). @lang('Quastion date was') <span class="text-danger"> *</span></label>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                            <input type="text" id="previous_date" class="form-control datetimepicker-input @error('description.previous_date') is-invalid @enderror" name="description[previous_date]" value="{{old('description.previous_date')}}" placeholder="@lang('Select Date')" oninput="loadPreviousDate()" data-toggle="datetimepicker" data-target="#reservationdate2" />
                            {{-- <div id="previous_date_select" class="input-group-append" data-target="#reservationdate2"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text" onclick="load_rd()"><i class="fa fa-calendar"></i></div>
                                                </div> --}}
                        </div>

                        @error('description.previous_date')
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
                        <label class="control-label" for="date">@lang('3'). @lang('Sitting Date') <span class="text-danger"> *</span></label>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input @error('date') is-invalid @enderror" name="date" id="datepicker" data-firstdate="{{ $parliamentSession->date_from ?? null }}" data-lastdate="{{ $parliamentSession->date_to ?? null }}" value="{{old('date')}}" placeholder="@lang('Select Date')" data-target="#reservationdate" />
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

            <div class="form-group pr-1">
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4 pl-4">
                        <label class="control-label" for="question_no">@lang('5'). @lang('Question No. was') <span class="text-danger"> *</span></label>
                    </div>
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <select id="question_no" name="description[question_no]" class="@error('description.question_no') is-invalid @enderror form-control form-control-sm select2">
                            <option selected value="">@lang('Select RD No.')</option>
                            
                        </select>

                        {{-- <input type="number"
                                                   id="question_no"
                                                   name="description[question_no]"
                                                   value="{{old('description.question_no')}}"
                        class="form-control @error('description.question_no') is-invalid @enderror"
                        placeholder="@lang('Enter Question No.')" autocomplete="off" maxlength="30"> --}}
                        <div>
                            @error('description.question_no')
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
                <label class="control-label" for="topic">@lang('6'). @lang('Matter of Raising')<span class="text-danger"> *</span></label>
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
                <label class="control-label" for="question_reason">@lang('7'). @lang('Reason of Raise')<span class="text-danger"> *</span></label>
            </div>
            <div class="col-sm-12 col-md-10 col-lg-10">

                <textarea id="question_reason" name="description[question_reason]" class="textareaWithoutImgVideo form-control @error('description.question_reason') is-invalid @enderror">
                {{old('description.question_reason')}}
                </textarea>

                @error('description.question_reason')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-sm-12 col-md-2 col-lg-2">
                <label class="control-label" for="attachment">@lang('8'). @lang('Attachment (if any)')</label>
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
                <input type="submit" name="submit" value="@lang('Submit')" class="btn btn-success btn-sm">
                @else
                <input type="submit" name="submit" value="@lang('Submit')" class="btn btn-success btn-sm">
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
    $(function() {
        var elem = document.getElementById('datepicker');
        var firstDate = elem.getAttribute('data-firstdate');
        var lastDate = elem.getAttribute('data-lastdate');

        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD',
            minDate: firstDate,
            maxDate: lastDate,
        });

        $('#reservationdate2').datetimepicker({
            format: 'YYYY-MM-DD',
        });
    });

    function loadPreviousDate() {
        var selected_date = $("#previous_date").val();
        if (selected_date != '') {
            $.ajax({
                url: '{{url("admin/notice-management/discussed")}}',
                data: {
                    previous_date: selected_date
                },
                type: "GET",
                dataType: "json",
                success: function(result) {
                    $('#question_no').html('<option value="">@lang("Select RD No.")</option>');
                    $.each(result.data, function(k, val) {
                        $('#question_no').append('<option value="' + val.rd_no + '">' + val.rd_no_custom + '</option>');
                    });
                }
            });
        }
    }
</script>
@endsection