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
    <div class="content pb-1">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="d-inline-block float-left pt-2 mb-0">{{ $notices->parliamentRule->name }}</h5>
                    <a class="btn btn-info btn-md d-inline-block float-right" href="{{ route('admin.notice_management.notices.index') }}"><i class="fas fa-backward"></i> @lang('Back')</a>

                </div>
            </div>
            <div class="card">
                <div class="card-body" style="padding: 100px;">
                    <h3 class="text-center mb-4"> বাংলাদেশ জাতীয় সংসদ</h3>
                    <hr/>
                    <p>সংশোধনী প্রস্তাবকারী সদস্যের নাম <strong>{{ $notices->profileForNoticeFrom->name_bn }}</strong>, যে বিলের সংশোধনী প্রস্তাব করা হইবে তাহার সংক্ষিপ্ত শিরোনাম <strong>
                        @if(session()->get('language') =='bn')
                        {{ $bill->name_bn }}
                        @else
                        {{ $bill->name }}
                        @endif
                    </strong></p>
                    <p class="mt-5">সচিব, </p>
                    <p>বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>
                    <p>ঢাকা। </p>
                    
                    
                    <p>মহোদয়,</p>
                    <p>আমি এতদ্বারা নোটিশ দিতেছি যে, {{ digitDateLang(nanoDateFormat($notices->date)) }}  তারিখে অনুষ্ঠিতব্য সংসদের চলতি অধিবেশনে আমি জনাব 
                        <strong>{{ $to_whom }}</strong>, কর্তৃক উত্থাপিত 
                        <strong>
                            @if(session()->get('language') =='bn')
                            {{ $bill->name_bn }}
                            @else
                            {{ $bill->name }}
                            @endif
                        </strong> 
                        মর্মে প্রস্তাবের জন্য নিম্নলিখিত সংশোধনী উত্থাপন করিতে চাই। </p>

                    <p class="my-4"></p>

                    @isset($descriptions->public_opinion_verification_date)
                        <p>{{ digitDateLang(nanoDateFormat($descriptions->public_opinion_verification_date)) }} তারিখের মধ্যে জনমত যাচাইয়ের জন্য বিলটি প্রচার করা হউক। 
                        </p>
                    @endisset
                                        
                    <p class="my-4"></p>
                                    
                    @isset($standingCommittee)
                    <p>বিলটি সম্পর্কে  {{ digitDateLang(nanoDateFormat($descriptions->report_submit_date)) }} তারিখের মধ্যে রিপোর্ট পেশ করার জন্য বিলটি <strong>
                            @if(session()->get('language') =='bn')
                                {{ $standingCommittee->ministryInfo->name_bn }}
                            @else
                                {{ $standingCommittee->ministryInfo->name }}
                            @endif
                        </strong> সম্পর্কিত স্থায়ী কমিটিতে প্রেরণ করা হউক। 
                    </p>
                    @endisset

                    <p class="my-4"></p>

                    @empty(!$proposedAssessmentCommittees)
                        <p>বিলটি সম্পর্কে  {{ digitDateLang(nanoDateFormat($descriptions->report_submit_date)) }} তারিখের মধ্যে রিপোর্ট পেশ করার জন্য বিলটি</p>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <p><strong>
                                    
                                    @php 
                                    $committeeList = $descriptions->assessment_committee;
                                    for($i=0; $i<count($committeeList); $i++){
                                        foreach($allProfileData as $d){
                                            if($committeeList[$i]==$d->user_id){
                                                echo $d->name_bn.'<br>';
                                            }
                                        }
                                    }
                                    @endphp

                                </strong></p>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <p><strong>
                                    @foreach ($descriptions->committee_designation as $item)
                                        {{ $item }}<br/>
                                    @endforeach
                                </strong></p>
                            </div>
                        </div>
                        
                        <p>উল্লেখিত সদস্যদের সমন্বয়ে গঠিত একটি বাছাই কমিটিতে প্রেরণ করা হউক এবং এই বাছাই কমিটির কোরাম 
                            ({{ Lang::get($descriptions->quorum) }}) 
                            নির্ধারণ করা হউক। </p>
                        <p class="my-5"></p>
                    @endempty


                    @empty(!$nameAddAssessmentCommittees)
                        <p>বাছাই কমিটিতে নিম্নলিখিত নামগুলি সংযোজন করা হউক</p>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <p><strong>@lang('Current Assessment Committee')</strong></p>
                                @foreach ($assessmentCommittees as $committee)
                                    <p> {!! $committee->mp_name !!}</p>
                                @endforeach
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <p><strong>@lang('Adding Names to The Assessment Committee')</strong></p>
                                {!! $nameAddAssessmentCommittees !!}
                            </div>

                        </div>
                        <p class="my-5"></p>
                    @endempty

                    @empty(!$nameCancelAssessmentCommittees)
                        <p>বাছাই কমিটিতে নিম্নলিখিত নামগুলি বর্জন করা হউক</p>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <p><strong>@lang('Current Assessment Committee')</strong></p>
                                @foreach ($assessmentCommittees as $committee)
                                    <p> {!! $committee->mp_name !!}</p>
                                @endforeach
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <p><strong>@lang('Canceling Names from The Assessment Committee')</strong></p>
                                {!! $nameCancelAssessmentCommittees !!}
                            </div>

                        </div>
                        <p class="my-5"></p>
                    @endempty

                    @empty(!$nameExchangeAssessmentCommitteeFrom)
                        <p>বাছাই কমিটির</p>
                        {!! $nameExchangeAssessmentCommitteeFrom !!}
                        <p class="my-4">এই নামগুলির পরিবর্তে নিম্নলিখিত নামগুলি সন্নিবেশ করা হউক</p>
                        {!! $nameExchangeAssessmentCommitteeTo !!}
                        <p class="my-5"></p>
                    @endempty

                    <p><strong>@lang('Submission Date') : </strong> {{ digitDateLang(nanoDateFormat($notices->created_at,null,true)) }} </p>
                    <p>&nbsp;</p>
                    <p>আপনার আস্থাভাজন</p>
                    <p><strong>সদস্যের নামঃ</strong> {{ $notices->profileForNoticeFrom->name_bn }} </p>
                    <p><strong>নির্বাচনী এলাকাঃ </strong> 
                        @if(session()->get('language') =='bn')
                        {{ '('.digitDateLang($notices->profileForNoticeFrom->constituency->number).') '.$notices->profileForNoticeFrom->constituency->bn_name }} 
                        @else
                        {{ '('.digitDateLang($notices->profileForNoticeFrom->constituency->number).') '.$notices->profileForNoticeFrom->constituency->name }} 
                        @endif
                    </p>
                    <p>সদস্য, বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>
                    
                    <p class="mt-5 mb-5">
                        @if(isset($attachments) && count($attachments) > 0)
                            @foreach($attachments as $file)
                                <a href="{{ asset('public/backend/attachment/'.$file->attachment)  }}" target="_blank" class="btn btn-success mr-2">View Attachment - {{ $loop->iteration }}</a>
                            @endforeach
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection
