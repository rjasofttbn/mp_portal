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
                <form method="POST" action="{{ route('admin.notice_management.notices.update', $editData->id) }}"
                    enctype="multipart/form-data">
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

                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label class="control-label" for="to_ministry_id">@lang('2'). @lang('Ministry') <span class="text-danger"> *</span></label>
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
                                        <label class="control-label" for="to_wing_id">@lang('3'). @lang('Ministry Wings') <span class="text-danger"> *</span></label>
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
                                            <option selected value="{{ $data->user_id }}">{{ $data->name_bn }}</option>
                                        @elseif($data->user_id != auth()->user()->id)
                                            <option value="{{ $data->user_id }}">{{ $data->name_bn }} ({{ $data->voter_area }})</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('notice_to')
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
                                        <label class="control-label" for="bill_title">@lang('4'). @lang('Title of The Bill') <span class="text-danger"> *</span></label>
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <select id="bill_title" name="description[bill_title]" class="@error('description.bill_title') is-invalid @enderror form-control form-control-sm select2">
                                            <option value="">@lang('Select Bill Title')</option>
                                            @foreach ($bills as $bill)
                                                <option {{ $descriptions->bill_title == $bill->id ? 'selected' : '' }} value="{{ $bill->id }}" {{ old('description.bill_title') == $bill->id ? 'selected' : '' }}>
                                                    @if(session()->get('language') =='bn')
                                                    {{ $bill->name_bn }}
                                                    @else
                                                    {{ $bill->name }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        <div>
                                            @error('description.bill_title')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4 pl-4">
                                        <label class="control-label" for="date">@lang('5'). @lang('Bill Date') <span class="text-danger"> *</span></label>
                                    </div>
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input @error('date') is-invalid @enderror" name="date" id="datepicker" 
                                           
                                            data-firstdate="{{ $parliamentSession->date_from ?? null }}" 
                                            data-lastdate="{{ $parliamentSession->date_to ?? null }}"
                                            placeholder="@lang('Select Date')" data-target="#reservationdate" />
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
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <label class="control-label" for="bill_topic">@lang('6'). @lang('Raise the Amendment') <span class="text-danger"> *</span></label>
                            </div>
                            <div class="col-sm-12 col-md-10 col-lg-10">
                                <select id="raise_amendment" data-id="{{ $editData->bill_topic }}" name="bill_topic" class="@error('bill_topic') is-invalid @enderror form-control form-control-sm select2">
                                    <option value="">@lang('Select The Raise Amendment')</option>
                                    <option {{ $editData->bill_topic == 1 ? 'selected' : '' }} value="1">@lang('Promoting Bills for Public Opinion')</option>
                                    <option {{ $editData->bill_topic == 2 ? 'selected' : '' }} value="2">@lang('Sending Bills to the Standing/Assessment Committee')</option>
                                    <option {{ $editData->bill_topic == 3 ? 'selected' : '' }} value="3">@lang('Adding Names to The Assessment Committee')</option>
                                    <option {{ $editData->bill_topic == 4 ? 'selected' : '' }} value="4">@lang('Canceling Names from The Assessment Committee')</option>
                                    <option {{ $editData->bill_topic == 5 ? 'selected' : '' }} value="5">@lang('Exchanging Names in The Assessment Committee')</option>
                                </select>
                                <div>
                                    @error('bill_topic')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="publicOpinionVerificationDate" class="d-none">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="public_opinion_verification_date">@lang('Public Opinion Verification Date') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                        <input id='public_opinion_verification_date' type="text" class="form-control datetimepicker-input @error('public_opinion_verification_date') is-invalid @enderror" name="description[public_opinion_verification_date]"
                                        value="{{ old('public_opinion_verification_date') ?? $descriptions->public_opinion_verification_date ?? '' }}" placeholder="@lang('Select Date')" data-target="#reservationdate2" />
                                        <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>

                                    @error('public_opinion_verification_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="reportSubmitDate" class="d-none">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="report_submit_date">@lang('Report Submit Date') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">

                                    <div class="input-group date" id="reservationdate3" data-target-input="nearest">
                                        <input id='report_submit_date' type="text" class="form-control datetimepicker-input @error('report_submit_date') is-invalid @enderror" name="description[report_submit_date]"
                                        value="{{old('report_submit_date') ?? $descriptions->report_submit_date ?? ''}}" placeholder="@lang('Select Date')" data-target="#reservationdate3" />
                                        <div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>

                                    @error('report_submit_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="stangingAssessmentCommittee" class="d-none">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="select_committee">@lang('Committee Name') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <select id="select_committee" data-id="{{ isset($descriptions->select_committee) ? $descriptions->select_committee : ''}}" name="description[select_committee]" class="@error('description.select_committee') is-invalid @enderror form-control form-control-sm select2">
                                        <option value="">@lang('Select the Committee Name')</option>
                                        <option {{ (isset($descriptions->select_committee) && $descriptions->select_committee == 1) ? 'selected' : '' }} value="1">@lang('Standing Committee')</option>
                                        <option {{ (isset($descriptions->select_committee) && $descriptions->select_committee == 2) ? 'selected' : '' }} value="2">@lang('Assessment Committee')</option>
                                    </select>
                                    <div>
                                        @error('description.select_committee')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="standingCommittee" class="d-none">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-2 col-lg-2">
                                        <label class="control-label" for="standing_committee">@lang('Standing Committee') <span class="text-danger"> *</span></label>
                                    </div>
                                    <div class="col-sm-12 col-md-10 col-lg-10">
                                        @if (isset($descriptions->standing_committee))
                                        
                                            <select id="standing_committee" name="description[standing_committee]" class="@error('description.standing_committee') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select Standing Committee')</option>
                                                
                                                @foreach ($standingCommittees as $committee)
                                                    <option {{ $descriptions->standing_committee == $committee->id ? 'selected' : '' }} value="{{ $committee->id }}" {{ old('description.standing_committee') == $committee->id ? 'selected' : '' }}>
                                                        @if(session()->get('language') =='bn')
                                                        {{ $committee->ministryInfo->name_bn }}
                                                        @else
                                                        {{ $committee->ministryInfo->name }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                                
                                            </select>
                                            <div>
                                                @error('description.standing_committee')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        @else

                                            <select id="standing_committee" name="description[standing_committee]" class="@error('description.standing_committee') is-invalid @enderror form-control form-control-sm select2">
                                                <option value="">@lang('Select Standing Committee')</option>
                                                @foreach ($standingCommittees as $committee)
                                                    <option value="{{ $committee->id }}" {{ old('description.standing_committee') == $committee->id ? 'selected' : '' }}>
                                                        @if(session()->get('language') =='bn')
                                                        {{ $committee->ministryInfo->name_bn }}
                                                        @else
                                                        {{ $committee->ministryInfo->name }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div>
                                                @error('description.standing_committee')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="assessmentCommittee" class="d-none">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-2 col-lg-2">
                                        <label class="control-label" for="assessment_committee">@lang('Assessment Committee') <span class="text-danger"> *</span></label>
                                    </div>
                                    <div class="col-sm-12 col-md-10 col-lg-10">
                                        <div id="divAdd2">
                                        @if(isset($descriptions->assessment_committee))
                                            
                                            @php  $i = 0;  @endphp
                                            @foreach ($descriptions->assessment_committee as $committee)
                                                <div id="childDiv2" class="row mb-2">
                                                    <div class="col-sm-12 col-md-6 col-lg-6">                                                        
                                                        <select id="assessment_committee" name="description[assessment_committee][]"
                                                        class="@error('description.assessment_committee') is-invalid @enderror form-control form-control-sm select2">
                                                        @foreach ($allProfileData as $data)
                                                            <option {{$committee == $data->user_id ? 'selected' : '' }} value="{{ $data->user_id }}">
                                                                @if(session()->get('language') =='bn')
                                                                {{ $data->name_bn }}
                                                                @else
                                                                {{ $data->name_eng }}
                                                                @endif
                                                            </option>

                                                        @endforeach
                                                        </select>
                                                        @error('description.assessment_committee')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                                        <input id="committee_designation" value="{{ $descriptions->committee_designation[$i] }}" type="text" name="description[committee_designation][]" placeholder="@lang('Enter Designation')" class='form-control form-control-sm'>
                                                    </div>
                                                </div>

                                                @php  $i++ ;  @endphp

                                            @endforeach
    
                                        @else

                                            <div id="childDiv2" class="row mb-2">
                                                <div class="col-sm-12 col-md-6 col-lg-6">
                                                    <select id="assessment_committee" name="description[assessment_committee][]"
                                                    class="@error('description.assessment_committee') is-invalid @enderror form-control form-control-sm select2">
                                                        <option value="">@lang('Select the Name')</option>
                                                        @if (isset($allProfileData) && count($allProfileData) > 0)
                                                            @foreach ($allProfileData as $data)
                                                                @if($data->user_id == old('description.assessment_committee'))
                                                                    <option selected value="{{ $data->user_id }}">
                                                                        @if(session()->get('language') =='bn')
                                                                        {{ $data->name_bn }}
                                                                        @else
                                                                        {{ $data->name_eng }}
                                                                        @endif
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $data->user_id }}">
                                                                        @if(session()->get('language') =='bn')
                                                                        {{ $data->name_bn }}
                                                                        @else
                                                                        {{ $data->name_eng }}
                                                                        @endif
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('description.assessment_committee')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-6">
                                                    <input id="committee_designation" type="text" name="description[committee_designation][]" placeholder="@lang('Enter Designation')" class='form-control form-control-sm'>
                                                </div>
                                            </div>

                                            @endif
                                        </div>   
                                    </div>
                                    <div class="col-sm-12 col-md-2 col-lg-2"> </div>
                                    <div class="col-sm-12 col-md-2 col-lg-2">
                                        <input type="button" id="addMore2" class='btn btn-outline-info btn-sm' name="add" value="+ @lang('Add More')"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-2 col-lg-2">
                                        <label class="control-label" for="quorum"> @lang('Quorum')</label>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <input   id="quorum" type="number" name="description[quorum]" class="form-control form-control-sm @error('description.quorum') is-invalid @enderror " value="{{ isset($descriptions->quorum) ? $descriptions->quorum : '' }}" placeholder="@lang('Enter Quorum No.')">

                                        @error('description.quorum')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="assessmentCommitteeNameAdd" class="d-none">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="assessment_committee_name_add">@lang('Adding Names to The Assessment Committee') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <p class="mb-3"><strong>@lang('Current Assessment Committee')</strong></p>
                                    @if (isset($assessmentCommittees) && count($assessmentCommittees) > 0)
                                        @foreach ($assessmentCommittees as $data)
                                        <p> {!! $data->mp_name !!}</p>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span>@lang('Adding Names to The Assessment Committee')</span>
                                    <select id="assessment_committee_name_add_ids"  multiple='multiple'
                                    class="@error('description.assessment_committee_name_add') is-invalid @enderror form-control form-control-sm select2">
                                       
                                        @if (isset($assessmentCommittees) && count($assessmentCommittees) > 0)
                                            @foreach ($assessmentCommittees as $committee)
                                               
                                            {!! $committee->mp_name_without_committee !!}
                                            
                                            @endforeach
                                        @endif

                                    </select>

                                    <input name="description[assessment_committee_name_add]" value="{{ isset($descriptions->assessment_committee_name_add) ? $descriptions->assessment_committee_name_add : '' }}" type="hidden" id="assessment_committee_name_add">

                                    @error('description.assessment_committee_name_add')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="assessmentCommitteeNameCancel" class="d-none">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="assessment_committee_name_cancel">@lang('Canceling Names from The Assessment Committee') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <p class="mb-3"><strong>@lang('Current Assessment Committee')</strong></p>
                                    @if (isset($assessmentCommittees) && count($assessmentCommittees) > 0)
                                        @foreach ($assessmentCommittees as $data)
                                        <p> {!! $data->mp_name !!}</p>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <span>@lang('Canceling Names from The Assessment Committee')</span>
                                    <select id="assessment_committee_name_cancel_ids" multiple='multiple'
                                    class="@error('description.assessment_committee_name_cancel') is-invalid @enderror form-control form-control-sm select2">
                                        
                                        @if (isset($assessmentCommittees) && count($assessmentCommittees) > 0)
                                            @foreach ($assessmentCommittees as $committee)
                                               
                                            {!! $committee->mp_name_list !!}
                                            
                                            @endforeach
                                        @endif

                                    </select>
                                    <input name="description[assessment_committee_name_cancel]" value="{{ isset($descriptions->assessment_committee_name_cancel) ? $descriptions->assessment_committee_name_cancel : '' }}" type="hidden" id="assessment_committee_name_cancel">


                                    @error('description.assessment_committee_name_cancel')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="assessmentCommitteeNameExchange" class="d-none">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label class="control-label" for="assessment_committee_existing_name">@lang('Exchanging Names in The Assessment Committee') <span class="text-danger"> *</span></label>
                                </div>

                                <div class="col-sm-12 col-md-5 col-lg-5">
                                    <span>@lang('Select Existing Name')</span>
                                    <select id="assessment_committee_existing_name_from_ids" multiple='multiple'
                                    class="@error('description.assessment_committee_existing_name_from') is-invalid @enderror form-control form-control-sm select2">
                                        
                                        @if (isset($assessmentCommittees) && count($assessmentCommittees) > 0)
                                            @foreach ($assessmentCommittees as $committee)
                                               
                                            {!! $committee->mp_name_list !!}
                                            
                                            @endforeach
                                        @endif

                                    </select>
                                    <input name="description[assessment_committee_existing_name_from]" value="{{ isset($descriptions->assessment_committee_existing_name_from) ? $descriptions->assessment_committee_existing_name_from : '' }}" type="hidden" id="assessment_committee_existing_name_from">

                                    @error('description.assessment_committee_existing_name_from')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-5 col-lg-5">
                                    <span>@lang('Exchanging Names in The Assessment Committee')</span>
                                    <select id="assessment_committee_existing_name_to_ids" multiple='multiple'
                                    class="@error('description.assessment_committee_existing_name_to') is-invalid @enderror form-control form-control-sm select2">
                                       
                                        @if (isset($assessmentCommittees) && count($assessmentCommittees) > 0)
                                            @foreach ($assessmentCommittees as $committee)
                                               
                                            {!! $committee->mp_name_without_committee !!}
                                            
                                            @endforeach
                                        @endif
                                        
                                    </select>
                                    <input name="description[assessment_committee_existing_name_to]" value="{{ isset($descriptions->assessment_committee_existing_name_to) ? $descriptions->assessment_committee_existing_name_to : '' }}" type="hidden" id="assessment_committee_existing_name_to">
                                    @error('description.assessment_committee_existing_name_to')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <label class="control-label" for="attachment">@lang('7'). @lang('Attachment (if any)')</label>
                            </div>
                            <div class="col-sm-12 col-md-10 col-lg-10">
                                <div class="file p-0">
                                    <input type="file"
                                           class="form-control attachment_upload pl-1"
                                           name="attachment[]" id="attachment" multiple
                                           accept=".png, .jpg, .jpeg, .pdf">
                                </div>
                                <br/>

                                @foreach($attachments as $file)
                                    <a href="{{ asset('public/backend/attachment/'.$file->attachment)  }}"
                                       target="_blank">View Previous Attachment - {{ $loop->iteration }}</a><br/>
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
                                    <input type="hidden" id="acceptable_without_correction" name="acceptance_tag" value="1" >
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
                                @if(auth()->user()->usertype=='staff')
                                <button type="button" class="btn btn-secondary btn-sm white-text">
                                    <a href="{{ route('admin.notice_management.notices.index') }}/index/1">@lang('Back')</a>
                                </button>
                                <button type="submit" class="btn btn-success btn-sm">@lang('Submit')</button> 
                                @else
                                <button type="button" class="btn btn-secondary btn-sm white-text">
                                    <a href="{{ route('admin.notice_management.notices.index') }}">@lang('Back')</a>
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                                <input type="submit" name="draft" value="@lang('Save as Draft')" class="btn btn-info btn-sm">
                                <button type="submit" class="btn btn-success btn-sm">@lang('Submit')</button> 
                           @endif
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
        $(function () {

            var firstDate = $('#datepicker').data('firstdate');
            var lastDate = $('#datepicker').data('lastdate');


            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'DD-MM-YYYY',
                minDate: firstDate,
                maxDate: lastDate,
            });

            $('#reservationdate2').datetimepicker({
                format: 'DD-MM-YYYY',
            });

            $('#reservationdate3').datetimepicker({
                format: 'DD-MM-YYYY',
            });

            $("#datepicker").val("{{nanoDateFormat($editData->date)}}");

            // Assessment Committee Name Add
            var assessment_committee_name_add_set = '{{isset($descriptions->assessment_committee_name_add)}}';
            var assessment_committee_name_add = '{{ isset($descriptions->assessment_committee_name_add) ? $descriptions->assessment_committee_name_add : '' }}';
            
            if(assessment_committee_name_add_set){
                $('#assessment_committee_name_add_ids').val(assessment_committee_name_add.split(','));
                $('#assessment_committee_name_add_ids').trigger('change');
            }

            $('#assessment_committee_name_add_ids').on("change", function(e) {
                $("#assessment_committee_name_add").val($(this).val());
            });

            $('#assessment_committee_name_add_ids').select2({
                placeholder: '@lang('Select the Name')',
                allowClear: true,
                multiple: true,
            });

            // Assessment Committee Name Cancel
            var assessment_committee_name_cancel_set = '{{isset($descriptions->assessment_committee_name_cancel)}}';
            var assessment_committee_name_cancel = '{{ isset($descriptions->assessment_committee_name_cancel) ? $descriptions->assessment_committee_name_cancel : '' }}';
            if(assessment_committee_name_cancel_set){
                $('#assessment_committee_name_cancel_ids').val(assessment_committee_name_cancel.split(','));
                $('#assessment_committee_name_cancel_ids').trigger('change');
            }

            $('#assessment_committee_name_cancel_ids').on("change", function(e) {
                $("#assessment_committee_name_cancel").val($(this).val());
            });

            $('#assessment_committee_name_cancel_ids').select2({
                placeholder: '@lang('Select the Name')',
                allowClear: true,
                multiple: true,
            });

            // Assessment Committee Name Exchange
            var assessment_committee_existing_name_from_set = '{{isset($descriptions->assessment_committee_existing_name_from)}}';
            var assessment_committee_existing_name_from = '{{ isset($descriptions->assessment_committee_existing_name_from) ? $descriptions->assessment_committee_existing_name_from : '' }}';
            if(assessment_committee_existing_name_from_set){
                $('#assessment_committee_existing_name_from_ids').val(assessment_committee_existing_name_from.split(','));
                $('#assessment_committee_existing_name_from_ids').trigger('change');
            }
            $('#assessment_committee_existing_name_from_ids').on("change", function(e) {
                $("#assessment_committee_existing_name_from").val($(this).val());
            });

            var assessment_committee_existing_name_to_set = '{{isset($descriptions->assessment_committee_existing_name_to)}}';
            var assessment_committee_existing_name_to = '{{ isset($descriptions->assessment_committee_existing_name_to) ? $descriptions->assessment_committee_existing_name_to : '' }}';
            if(assessment_committee_existing_name_to_set){
                $('#assessment_committee_existing_name_to_ids').val(assessment_committee_existing_name_to.split(','));
                $('#assessment_committee_existing_name_to_ids').trigger('change');
            }
            $('#assessment_committee_existing_name_to_ids').on("change", function(e) {
                $("#assessment_committee_existing_name_to").val($(this).val());
            });

            $('#assessment_committee_existing_name_from_ids').select2({
                placeholder: '@lang('Select Existing Name')',
                allowClear: true,
                multiple: true,
            });

            $('#assessment_committee_existing_name_to_ids').select2({
                placeholder: '@lang('Select Exchange Name')',
                allowClear: true,
                multiple: true,
            });

            // Assessment Committee Create
            $('#addMore2').click(function(){
                var loadMp = '<div id="childDiv2" class="row mb-2"> <div class="col-sm-12 col-md-6 col-lg-6"> <select name="description[assessment_committee][]" class="@error("description.assessment_committee") is-invalid @enderror form-control form-control-sm select2"> <option value="">@lang("Select the Name")</option> @if (isset($allProfileData) && count($allProfileData) > 0) @foreach ($allProfileData as $data) @if($data->id==old("description.assessment_committee")) <option selected value="{{$data->user_id}}"> @if(session()->get("language")=="bn"){{$data->name_bn}}@else{{$data->name_eng}}@endif </option> @else <option value="{{$data->user_id}}"> @if(session()->get("language")=="bn"){{$data->name_bn}}@else{{$data->name_eng}}@endif </option> @endif @endforeach @endif </select> @error("description.assessment_committee") <span class="text-danger">{{$message}}</span> @enderror </div><div class="col-sm-12 col-md-6 col-lg-6"> <input id="committee_designation" type="text" name="description[committee_designation][]" placeholder="@lang("Enter Designation")" class="form-control form-control-sm"> </div></div>';

               $('#divAdd2').append(loadMp);
                $('.select2').select2();
            });






        });

        var raise_amendment = $('#raise_amendment').data('id');

        if(raise_amendment == 1){
            $("#publicOpinionVerificationDate").removeClass('d-none');
            $("#reportSubmitDate").addClass('d-none');
            $("#stangingAssessmentCommittee").addClass('d-none');
            $("#assessmentCommitteeNameAdd").addClass('d-none');
            $("#assessmentCommitteeNameCancel").addClass('d-none');
            $("#assessmentCommitteeNameExchange").addClass('d-none');

            $("#public_opinion_verification_date").prop('disabled', false);
            $("#report_submit_date").prop('disabled', true);
            $("#assessment_committee").prop('disabled', true);
            $("#committee_designation").prop('disabled', true);
            $("#assessment_committee_name_add").prop('disabled', true);
            $("#assessment_committee_name_cancel").prop('disabled', true);
            $("#assessment_committee_existing_name_from").prop('disabled', true);
            $("#assessment_committee_existing_name_to").prop('disabled', true);
            $("#select_committee").prop('disabled', true);
            $("#standing_committee").prop('disabled', true);
            $("#quorum").prop('disabled', true);

        }else if(raise_amendment == 2){
            $("#reportSubmitDate").removeClass('d-none');
            $("#stangingAssessmentCommittee").removeClass('d-none');
            $("#publicOpinionVerificationDate").addClass('d-none');
            $("#assessmentCommitteeNameAdd").addClass('d-none');
            $("#assessmentCommitteeNameCancel").addClass('d-none');
            $("#assessmentCommitteeNameExchange").addClass('d-none');

            $("#report_submit_date").prop('disabled', false);
            $("#select_committee").prop('disabled', false);
            $("#assessment_committee").prop('disabled', false);
            $("#committee_designation").prop('disabled', false);
            $("#quorum").prop('disabled', false);
            $("#assessment_committee_name_add").prop('disabled', true);
            $("#assessment_committee_name_cancel").prop('disabled', true);
            $("#assessment_committee_existing_name_from").prop('disabled', true);
            $("#assessment_committee_existing_name_to").prop('disabled', true);
            $("#public_opinion_verification_date").prop('disabled', true);

            var committee = $('#select_committee').data('id');
            if(committee == 1){
                $("#standingCommittee").removeClass('d-none');
                $("#assessmentCommittee").addClass('d-none');
                $("#standing_committee").prop('disabled', false);
                $("#assessment_committee").prop('disabled', true);
                $("#committee_designation").prop('disabled', true);
                $("#quorum").prop('disabled', true);

            }else if(raise_amendment == 2){
                $("#assessmentCommittee").removeClass('d-none');
                $("#standingCommittee").addClass('d-none');
                $("#standing_committee").prop('disabled', true);
                $("#assessment_committee").prop('disabled', false);
                $("#committee_designation").prop('disabled', false);
                $("#quorum").prop('disabled', false);
            }

            
                
        }else if(raise_amendment == 3){
            $("#assessmentCommitteeNameAdd").removeClass('d-none');
            $("#publicOpinionVerificationDate").addClass('d-none');
            $("#reportSubmitDate").addClass('d-none');
            $("#stangingAssessmentCommittee").addClass('d-none');
            $("#assessmentCommitteeNameCancel").addClass('d-none');
            $("#assessmentCommitteeNameExchange").addClass('d-none');

            $("#assessment_committee_name_add").prop('disabled', false);
            $("#assessment_committee_name_cancel").prop('disabled', true);
            $("#assessment_committee_existing_name_from").prop('disabled', true);
            $("#assessment_committee_existing_name_to").prop('disabled', true);
            $("#public_opinion_verification_date").prop('disabled', true);
            $("#report_submit_date").prop('disabled', true);
            $("#select_committee").prop('disabled', true);
            $("#standing_committee").prop('disabled', true);
            $("#quorum").prop('disabled', true);
            $("#assessment_committee").prop('disabled', true);
            $("#committee_designation").prop('disabled', true);

        }else if(raise_amendment == 4){
            $("#assessmentCommitteeNameCancel").removeClass('d-none');
            $("#assessmentCommitteeNameAdd").addClass('d-none');
            $("#publicOpinionVerificationDate").addClass('d-none');
            $("#reportSubmitDate").addClass('d-none');
            $("#stangingAssessmentCommittee").addClass('d-none');
            $("#assessmentCommitteeNameExchange").addClass('d-none');

            $("#assessment_committee_name_cancel").prop('disabled', false);
            $("#assessment_committee_name_add").prop('disabled', true);
            $("#assessment_committee_existing_name_from").prop('disabled', true);
            $("#assessment_committee_existing_name_to").prop('disabled', true);
            $("#public_opinion_verification_date").prop('disabled', true);
            $("#report_submit_date").prop('disabled', true);
            $("#select_committee").prop('disabled', true);
            $("#standing_committee").prop('disabled', true);
            $("#quorum").prop('disabled', true);
            $("#assessment_committee").prop('disabled', true);
            $("#committee_designation").prop('disabled', true);

        }else if(raise_amendment == 5){
            $("#assessmentCommitteeNameExchange").removeClass('d-none');
            $("#assessmentCommitteeNameCancel").addClass('d-none');
            $("#assessmentCommitteeNameAdd").addClass('d-none');
            $("#publicOpinionVerificationDate").addClass('d-none');
            $("#reportSubmitDate").addClass('d-none');
            $("#stangingAssessmentCommittee").addClass('d-none');

            $("#assessment_committee_existing_name_from").prop('disabled', false);
            $("#assessment_committee_existing_name_to").prop('disabled', false);
            $("#assessment_committee_name_add").prop('disabled', true);
            $("#assessment_committee_name_cancel").prop('disabled', true);
            $("#public_opinion_verification_date").prop('disabled', true);
            $("#report_submit_date").prop('disabled', true);
            $("#select_committee").prop('disabled', true);
            $("#standing_committee").prop('disabled', true);
            $("#quorum").prop('disabled', true);
            $("#assessment_committee").prop('disabled', true);
            $("#committee_designation").prop('disabled', true);

        }
       

        $(document).on('change', '#raise_amendment', function() {

            var raise_amendment = $(this).val();

            if(raise_amendment == 1){
                $("#publicOpinionVerificationDate").removeClass('d-none');
                $("#reportSubmitDate").addClass('d-none');
                $("#stangingAssessmentCommittee").addClass('d-none');
                $("#assessmentCommitteeNameAdd").addClass('d-none');
                $("#assessmentCommitteeNameCancel").addClass('d-none');
                $("#assessmentCommitteeNameExchange").addClass('d-none');

                $("#public_opinion_verification_date").prop('disabled', false);
                $("#report_submit_date").prop('disabled', true);
                $("#assessment_committee").prop('disabled', true);
                $("#committee_designation").prop('disabled', true);
                $("#assessment_committee_name_add").prop('disabled', true);
                $("#assessment_committee_name_cancel").prop('disabled', true);
                $("#assessment_committee_existing_name_from").prop('disabled', true);
                $("#assessment_committee_existing_name_to").prop('disabled', true);
                $("#select_committee").prop('disabled', true);
                $("#standing_committee").prop('disabled', true);
                $("#quorum").prop('disabled', true);

            }else if(raise_amendment == 2){
                $("#reportSubmitDate").removeClass('d-none');
                $("#stangingAssessmentCommittee").removeClass('d-none');
                $("#publicOpinionVerificationDate").addClass('d-none');
                $("#assessmentCommitteeNameAdd").addClass('d-none');
                $("#assessmentCommitteeNameCancel").addClass('d-none');
                $("#assessmentCommitteeNameExchange").addClass('d-none');

                $("#report_submit_date").prop('disabled', false);
                $("#select_committee").prop('disabled', false);
                $("#assessment_committee").prop('disabled', false);
                $("#committee_designation").prop('disabled', false);
                $("#quorum").prop('disabled', false);
                $("#assessment_committee_name_add").prop('disabled', true);
                $("#assessment_committee_name_cancel").prop('disabled', true);
                $("#assessment_committee_existing_name_from").prop('disabled', true);
                $("#assessment_committee_existing_name_to").prop('disabled', true);
                $("#public_opinion_verification_date").prop('disabled', true);

                $(document).on('change', '#select_committee', function() {
                    var committee = $(this).val();
                    if(committee == 1){
                        $("#standingCommittee").removeClass('d-none');
                        $("#assessmentCommittee").addClass('d-none');
                        $("#standing_committee").prop('disabled', false);
                        $("#assessment_committee").prop('disabled', true);
                        $("#committee_designation").prop('disabled', true);
                        $("#quorum").prop('disabled', true);

                    }else if(raise_amendment == 2){
                        $("#assessmentCommittee").removeClass('d-none');
                        $("#standingCommittee").addClass('d-none');
                        $("#standing_committee").prop('disabled', true);
                        $("#assessment_committee").prop('disabled', false);
                        $("#committee_designation").prop('disabled', false);
                        $("#quorum").prop('disabled', false);
                    }
                    $('.select2').select2();
                });
                
                    
            }else if(raise_amendment == 3){
                $("#assessmentCommitteeNameAdd").removeClass('d-none');
                $("#publicOpinionVerificationDate").addClass('d-none');
                $("#reportSubmitDate").addClass('d-none');
                $("#stangingAssessmentCommittee").addClass('d-none');
                $("#assessmentCommitteeNameCancel").addClass('d-none');
                $("#assessmentCommitteeNameExchange").addClass('d-none');

                $("#assessment_committee_name_add").prop('disabled', false);
                $("#assessment_committee_name_cancel").prop('disabled', true);
                $("#assessment_committee_existing_name_from").prop('disabled', true);
                $("#assessment_committee_existing_name_to").prop('disabled', true);
                $("#public_opinion_verification_date").prop('disabled', true);
                $("#report_submit_date").prop('disabled', true);
                $("#select_committee").prop('disabled', true);
                $("#standing_committee").prop('disabled', true);
                $("#quorum").prop('disabled', true);
                $("#assessment_committee").prop('disabled', true);
                $("#committee_designation").prop('disabled', true);

            }else if(raise_amendment == 4){
                $("#assessmentCommitteeNameCancel").removeClass('d-none');
                $("#assessmentCommitteeNameAdd").addClass('d-none');
                $("#publicOpinionVerificationDate").addClass('d-none');
                $("#reportSubmitDate").addClass('d-none');
                $("#stangingAssessmentCommittee").addClass('d-none');
                $("#assessmentCommitteeNameExchange").addClass('d-none');

                $("#assessment_committee_name_cancel").prop('disabled', false);
                $("#assessment_committee_name_add").prop('disabled', true);
                $("#assessment_committee_existing_name_from").prop('disabled', true);
                $("#assessment_committee_existing_name_to").prop('disabled', true);
                $("#public_opinion_verification_date").prop('disabled', true);
                $("#report_submit_date").prop('disabled', true);
                $("#select_committee").prop('disabled', true);
                $("#standing_committee").prop('disabled', true);
                $("#quorum").prop('disabled', true);
                $("#assessment_committee").prop('disabled', true);
                $("#committee_designation").prop('disabled', true);

            }else if(raise_amendment == 5){
                $("#assessmentCommitteeNameExchange").removeClass('d-none');
                $("#assessmentCommitteeNameCancel").addClass('d-none');
                $("#assessmentCommitteeNameAdd").addClass('d-none');
                $("#publicOpinionVerificationDate").addClass('d-none');
                $("#reportSubmitDate").addClass('d-none');
                $("#stangingAssessmentCommittee").addClass('d-none');

                $("#assessment_committee_existing_name_from").prop('disabled', false);
                $("#assessment_committee_existing_name_to").prop('disabled', false);
                $("#assessment_committee_name_add").prop('disabled', true);
                $("#assessment_committee_name_cancel").prop('disabled', true);
                $("#public_opinion_verification_date").prop('disabled', true);
                $("#report_submit_date").prop('disabled', true);
                $("#select_committee").prop('disabled', true);
                $("#standing_committee").prop('disabled', true);
                $("#quorum").prop('disabled', true);
                $("#assessment_committee").prop('disabled', true);
                $("#committee_designation").prop('disabled', true);

            }
            $('.select2').select2();

        });

        $(document).ready(function() {
            $("#status_id").on('change', function() {
                if ($(this).val() == 6) {
                    $(".acceptable_tag").removeClass('d-none');
                    $(".acceptable_tag").addClass('block');
                    $("#acceptable_without_correction").prop('disabled', false);
                } else {
                    $(".acceptable_tag").removeClass('block');
                    $(".acceptable_tag").addClass('d-none');
                    $("#acceptable_without_correction").prop('disabled', true);
                }
            });
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