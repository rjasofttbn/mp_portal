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
                    <form id="noticeCreateForm" class="form-horizontal" action="{{route('admin.notice_management.notices.store')}}"
                          method="POST" enctype="multipart/form-data">
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
                                                    <option selected value="{{ $data->user_id }}">{{ $data->name_bn }} ({{ $data->voter_area }})</option>
                                                @else
                                                    <option value="{{ $data->user_id }}">{{ $data->name_bn }} ({{ $data->voter_area }})</option>
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
                                            <label class="control-label" for="to_ministry_id">@lang('2'). @lang('Ministry') <span class="text-danger"> *</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8">
                                            <select id="to_ministry_id" name="to_ministry_id" class="@error('to_ministry_id') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select Ministry Name')</option>
                                                @foreach ($ministries as $ministry)
                                                <option value="{{ $ministry->id }}">
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
                                            <label class="control-label" for="to_wing_id">@lang('3'). @lang('Ministry Wings') <span class="text-danger"> *</span></label>
                                        </div>
                                        <div class="col-sm-12 col-md-8 col-lg-8">
                                            <select id="to_wing_id" name="to_wing_id" class="@error('to_wing_id') is-invalid @enderror form-control form-control-sm select2">
    
                                            </select>
                                            @error('to_wing_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" id="notice_to" name="notice_to">
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
                                        @if (isset($allProfileData) && count($allProfileData) > 0)
                                            @foreach ($allProfileData as $data)

                                                @if($data->user_id !== $mpProfile->user_id)
                                                    @if($data->user_id == old('notice_to'))
                                                        <option selected value="{{ $data->user_id }}">{{ $data->name_bn }}</option>
                                                    @else
                                                        <option value="{{ $data->user_id }}">{{ $data->name_bn }} ({{ $data->voter_area }})</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('notice_to')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="topic">@lang('4'). @lang('Matter of Raising') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <textarea id="topic" name="topic"
                                     class="textareaWithoutImgVideo form-control @error('topic') is-invalid @enderror">
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
                                    <label class="control-label" for="attachment">@lang('5'). @lang('Attachment (if any)')</label>
                                </div>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <div class="file p-0">
                                        <input type="file"
                                               class="form-control attachment_upload pl-1"
                                               name="attachment[]" id="attachment" multiple
                                               accept=".png, .jpg, .jpeg, .pdf">
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
