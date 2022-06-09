<!-- /.content-header -->
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
<div class="content pb-1">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="d-inline-block float-left pt-2 mb-0">{{ $notices->parliamentRule->name }}</h5>
                <a class="btn btn-info btn-md d-inline-block float-right" onClick="go_back()"><i class="fas fa-backward"></i> @lang('Back')</a>
            </div>
        </div>
        <div class="card">

            @if($notices->acceptance_tag==1) {!! '<span class="badge status_span badge-info">'.\Lang::get('Acceptable').'</span>' !!}
            @elseif($notices->acceptance_tag==2)
            {!! '<span class="badge status_span badge-primary">'.\Lang::get('Acceptable with Correction').'</span>' !!}
            @endif

            <div class="card-body" style="padding: 25px;">
                @if($rule_number==42)
                    <h3 class="text-center mb-4"> বাংলাদেশ জাতীয় সংসদ</h3>
                    <hr />
                    <p class="mt-5">সচিব, </p>
                    <p>বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>
                    <p>ঢাকা। </p>
                    <p><strong>বিষয়ঃ </strong> <span style="text-decoration:underline">কার্যপ্রণালী বিধির ৪২ বিধি অনুসারে প্রশ্ন উত্থাপনের নোটিশ।</span></p>
                    <p>মহোদয়,</p>
                    <p>আমি এতদ্বারা নোটিশ দিতেছি যে, আমি সংসদের <span> {{ $notices->parliament_session_id == 1 ? 'বর্তমান' : 'আসন্ন' }} </span> অধিবেশনের।
                        {{ date('d F, Y', strtotime($notices->date)) }} তারিখে অনুষ্টিতব্য় বৈঠকে আমি নিন্মলিখিত প্রশ্নটি
                        {{ $descriptions->question_type == 1 ? 'তারকাচিহ্নিত' : 'তারকাচিহ্নিত  বিহীন' }} প্রশ্ন হিসাবে উত্থাপন করিতে চাই।
                    </p>

                    <p class="mt-5 mb-5"></p>

                    <p class="mb-5"><strong>তারিখঃ </strong> {{ date('d F, Y', strtotime($notices->created_at)) }} </p>
                    <p>আপনার আস্থাভাজন</p>
                    <p><strong>সদস্যের নামঃ</strong> {{ $notices->profileForNoticeFrom->name_bn }} </p>
                    <p><strong>নির্বাচনী এলাকাঃ </strong> {{ $notices->profileForNoticeFrom->constituency->name }} </p>
                    <p>সদস্য, বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>


                    <p class="mt-5 mb-5"></p>
                    <p class="text-center my-4"><strong>প্রশ্নঃ</strong></p>
                    <p> <strong>@if($notices->to_wing_id>0) {{ $notices->wing_name }} ({{$notices->ministry_name }}) @else {{$notices->ministry_name }} @endif</strong>, মন্ত্রী মহোদয় অনুগ্রহ করিয়া বলিবেন কি
                        <strong>{!! $notices->question !!}</strong>
                    </p>
                    <p class="mt-5 mb-5"></p>
                    <p class="mt-5 mb-5">
                        @if(isset($attachments) && count($attachments) > 0)
                        @foreach($attachments as $file)
                        <a href="{{ asset('public/backend/attachment/'.$file->attachment)  }}" target="_blank" class="btn btn-success mr-2">View Attachment - {{ $loop->iteration }}</a>
                        @endforeach
                        @endif
                    </p>
                @endif

                @if($rule_number==59)
                    <h3 class="text-center mb-4"> বাংলাদেশ জাতীয় সংসদ</h3>
                    <hr />
                    <p class="mt-5">সচিব, </p>
                    <p>বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>
                    <p>ঢাকা। </p>
                    <p><strong>বিষয়ঃ </strong> <span style="text-decoration:underline">কার্যপ্রণালী বিধির ৫৯ বিধি অনুসারে স্বল্পকাল নোটিশে / প্রশ্ন উত্থাপনের নোটিশ।</span></p>
                    <p>মহোদয়,</p>
                    <p>আমি এতদ্বারা নোটিশ দিতেছি যে, আমি সংসদের
                        {{ $notices->parliament_session_id == 1 ? 'চলতি' : 'আসন্ন' }} অধিবেশনের
                        {{ date('d F, Y', strtotime($notices->date)) }}
                        তারিখে অনুষ্টিতব্য় বৈঠকে আমি নিন্মলিখিত প্রশ্নটি স্বল্পকালীন নোটিশের প্রশ্ন হিসাবে উত্থাপন করিতে চাই।
                    </p>

                    <p class="mt-5 mb-5"></p>

                    <p class="mb-5"><strong>তারিখঃ </strong> {{ date('d F, Y', strtotime($notices->created_at)) }} </p>
                    <p>আপনার আস্থাভাজন</p>
                    <p><strong>সদস্যের নামঃ</strong> {{ $notices->profileForNoticeFrom->name_bn }} </p>
                    <p><strong>নির্বাচনী এলাকাঃ </strong> {{ $notices->profileForNoticeFrom->constituency->name }} </p>
                    <p>সদস্য, বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>


                    <p class="mt-5 mb-5"></p>
                    <h4 class="text-center">স্বল্পকালীন নোটিশের কারণ:</h4>
                    <p class="text-center my-4"><strong>প্রশ্নঃ</strong></p>
                    <p> <strong>@if($notices->to_wing_id>0) {{ $notices->wing_name }} ({{$notices->ministry_name }}) @else {{$notices->ministry_name }} @endif</strong>, মন্ত্রী মহোদয় অনুগ্রহ করিয়া বলিবেন কি
                        <strong>{!! $notices->question !!}</strong>
                    </p>
                    <p class="mt-5 mb-5"></p>
                    <p class="mt-5 mb-5">
                        @if(isset($attachments) && count($attachments) > 0)
                        @foreach($attachments as $file)
                        <a href="{{ asset('public/backend/attachment/'.$file->attachment)  }}" target="_blank" class="btn btn-success mr-2">View Attachment - {{ $loop->iteration }}</a>
                        @endforeach
                        @endif
                    </p>
                @endif

                @if($rule_number==60)
                    <h3 class="text-center mb-4"> বাংলাদেশ জাতীয় সংসদ</h3>
                    <hr/>
                    <p class="mt-5">সচিব, </p>
                    <p>বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>
                    <p>ঢাকা। </p>
                    <p><strong>বিষয়ঃ </strong> <span style="text-decoration:underline">কার্যপ্রণালী বিধির ৬০ বিধি অনুসারে অর্ধ-ঘন্টা আলোচনার জন্য নোটিশ।</span></p>
                    <p>মহোদয়,</p>
                    <p>আমি এতদ্বারা নোটিশ দিতেছি যে, {{ date('d F, Y', strtotime($descriptions->previous_date)) }} তারিখে সংসদে জিজ্ঞাসিত
                        {{ $descriptions->question_no }} নং {{ $descriptions->question_type == 1 ? 'তারকাচিহ্নিত' : 'তারকাচিহ্নিত  বিহীন' }}
                        প্রশ্নের উত্তরের পরিপ্রেক্ষিতে আমি নিন্মলিখিত জন-গুরুত্বসম্পন্ন বিষয় সম্পর্কে {{ date('d F, Y', strtotime($notices->date)) }}
                        তারিখে সংসদে আলোচনা উত্থাপন করিতে চাই :-</p>
                    <p class="mt-5 mb-5"></p>
                    <p>(১) উত্থাপনীয় বিষয়ঃ </p>
                    <p>{{ $descriptions->question_subject }}</p>

                    <p class="mt-5 mb-5"></p>
                    <p>(২) আলোচনা উত্থাপনের কারণ সম্পর্কে ব্যাখ্যা:</p>
                    <p>{{ $descriptions->question_reason }}</p>

                    <p class="mt-5 mb-5"></p>

                    <p class="mb-5"><strong>তারিখঃ </strong>  {{ date('d F, Y', strtotime($notices->created_at)) }} </p>
                    <p>আপনার আস্থাভাজন</p>
                    <p><strong>সদস্যের নামঃ</strong> {{ $notices->profileForNoticeFrom->name_bn }} </p>
                    <p><strong>নির্বাচনী এলাকাঃ </strong> 
                        @if(session()->get('language') =='bn')
                        {{ $notices->profileForNoticeFrom->constituency->bn_name }} 
                        @else
                        {{ $notices->profileForNoticeFrom->constituency->name }} 
                        @endif
                    </p>

                    <p class="mt-5 mb-5">
                        @if(isset($attachments) && count($attachments) > 0)
                            @foreach($attachments as $file)
                                <a href="{{ asset('public/backend/attachment/'.$file->attachment)  }}" target="_blank" class="btn btn-success mr-2">View Attachment - {{ $loop->iteration }}</a>
                            @endforeach
                        @endif
                    </p>
                @endif

                @if($rule_number==62)
                    <h3 class="text-center mb-4"> বাংলাদেশ জাতীয় সংসদ</h3>
                    <hr/>
                    <p class="mt-5">সচিব, </p>
                    <p>বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>
                    <p>ঢাকা। </p>
                    <p><strong>বিষয়ঃ </strong> <span style="text-decoration:underline">কার্যপ্রণালী বিধির ৬২ বিধি অনুসারে জন-গুরুত্বসম্পন্ন বিষয়ে সংসদে মুলতবি প্রস্তাব উত্থাপনের নোটিশ।</span></p>
                    <p>মহোদয়,</p>
                    <p>আমি এতদ্বারা নোটিশ দিতেছি যে, আমি সংসদের
                        {{ date('d F, Y', strtotime($notices->date)) }} তারিখের বৈঠকে নিন্মলিখিত মুলতবি প্রস্তাবটি উত্থাপন করিতে চাই। </p>
                        
                    <p class="mt-5 mb-5"></p>

                    <p>অতএব, এই সম্পর্কে মাননীয় স্পীকারের সম্মতি লওয়ার জন্য আপনাকে অনুরোধ করিতেছি।</p>

                    <p class="mt-5 mb-5"></p>

                    <p class="mb-5"><strong>তারিখঃ </strong>  {{ date('d F, Y', strtotime($notices->created_at)) }} </p>
                    <p>আপনার আস্থাভাজন</p>
                    <p><strong>সদস্যের নামঃ</strong> {{ $notices->profileForNoticeFrom->name_bn }} </p>
                    <p><strong>নির্বাচনী এলাকাঃ </strong> 
                        @if(session()->get('language') =='bn')
                        {{ $notices->profileForNoticeFrom->constituency->bn_name }} 
                        @else
                        {{ $notices->profileForNoticeFrom->constituency->name }} 
                        @endif
                    </p>
                    <p>সদস্য, বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>


                    <p class="mt-5 mb-5"></p>
                    <p class="text-center my-4"><strong>মুলতবি প্রস্তাব</strong></p>
                    <p> সাম্প্রতিক ও জন-গুরুত্বসম্পন্ন একটি সুনির্দিষ্ট বিষয় সম্পর্কে আলোচনা করার জন্য এই সংসদের কাজ এখন মুলতবি করা হউক, যথা :-
                        <strong>{{ $notices->topic }}</strong></p>
                    <p class="mt-5 mb-5"></p>
                    <p class="text-center my-4"><strong>আলোচ্য বিষয়টির সংক্ষিপ্ত বিবৃতি</strong></p>
                    <p>{{ $descriptions->brief_statement }}</p>
                    <p class="mt-5 mb-5">
                        @if(isset($attachments) && count($attachments) > 0)
                            @foreach($attachments as $file)
                                <a href="{{ asset('public/backend/attachment/'.$file->attachment)  }}" target="_blank" class="btn btn-success mr-2">View Attachment - {{ $loop->iteration }}</a>
                            @endforeach
                        @endif
                    </p>
                @endif

                

                @if($rule_number==71)
                    @lang('Comments') &raquo;
                    <code>
                        {{$notices->comments}}
                    </code>
                    <hr>
                    <h3 class="text-center mb-4"> বাংলাদেশ জাতীয় সংসদ</h3>
                    <hr />
                    <p class="mt-5">সচিব, </p>
                    <p>বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>
                    <p>ঢাকা। </p>
                    <p><strong>বিষয়ঃ </strong> <span style="text-decoration:underline">কার্যপ্রণালী বিধির ৭১ বিধি অনুসারে জরুরি জন-গুরুত্বসম্পন্ন বিষয় সম্পর্কে মনোযোগ আকর্ষণের নোটিশ
                            ।</span></p>
                    <p>মহোদয়,</p>
                    <p>আমি এতদ্বারা নোটিশ দিতেছি যে, সংসদের অদ্যকার বৈঠকে আমি নিন্মলিখিত জরুরী জন-গুরুত্বসম্পন্ন বিষয়ের প্রতি
                        <strong>@if($notices->to_wing_id>0) {{ $notices->wing_name }} ({{$notices->ministry_name }}) @else {{$notices->ministry_name }} @endif</strong>, মন্ত্রীর মনোযোগ আকর্ষণ করিতে চাই।
                    </p>

                    <p class="mt-5 mb-5"></p>
                    <p>২। অতএব, এ বিষয়ের যথাযথ ব্যবস্থা গ্রহণের জন্য আপনাকে অনুরোধ করিতেছি। </p>
                    <p class="mt-5 mb-5"></p>
                    <p><strong>উত্থাপনীয় বিষয়:-</strong></p>
                    {!! $notices->topic !!}
                    <p class="mt-5 mb-5"></p>

                    <p class="mb-5"><strong>তারিখঃ </strong> {{ date('d F, Y', strtotime($notices->created_at)) }} </p>
                    <p>আপনার আস্থাভাজন</p>
                    <p><strong>সদস্যের নামঃ</strong> {{ $notices->profileForNoticeFrom->name_bn }} </p>
                    <p><strong>নির্বাচনী এলাকাঃ </strong>
                        @if(session()->get('language') =='bn')
                        {{ $notices->profileForNoticeFrom->constituency->bn_name }}
                        @else
                        {{ $notices->profileForNoticeFrom->constituency->name }}
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
                    <div class="form-group row text-center" style="margin-bottom: 40px;">
                        <div class="col-7 text-center acceptable_duration">
                            <input type="radio" class="form-check-input big_checkbox" id="accept_for_30_mins" name="acceptance_duration" value="30" {{($notices->acceptance_duration==30)?'checked':'unchecked'}}>
                            <label class="form-check-label big_label" for="accept_for_30_mins">@lang('Accept for 30 Mins')</label>
                        </div>
                        <div class="col-4 text-left acceptable_duration">
                            <input type="radio" class="form-check-input big_checkbox" id="accept_for_2_mins" name="acceptance_duration" value="2" {{($notices->acceptance_duration==2 || $notices->acceptance_duration==0)?'checked':'unchecked'}}>
                            <label class="form-check-label big_label" for="accept_for_2_mins">@lang('Accept for 2 Mins')</label>
                        </div>
                    </div>
                @endif

                @if($rule_number==78)
                    <h3 class="text-center mb-4"> বাংলাদেশ জাতীয় সংসদ</h3>
                    <hr />
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
                    <p>আমি এতদ্বারা নোটিশ দিতেছি যে, {{ date('d F, Y', strtotime($notices->date)) }} তারিখে অনুষ্ঠিতব্য সংসদের চলতি অধিবেশনে আমি জনাব
                        <strong>@if($notices->to_wing_id>0) {{ $notices->wing_name }} ({{$notices->ministry_name }}) @else {{$notices->ministry_name }} @endif</strong>, কর্তৃক উত্থাপিত
                        <strong>
                            @if(session()->get('language') =='bn')
                            {{ $bill->name_bn }}
                            @else
                            {{ $bill->name }}
                            @endif
                        </strong>
                        মর্মে প্রস্তাবের জন্য নিম্নলিখিত সংশোধনী উত্থাপন করিতে চাই।
                    </p>

                    <p class="my-4"></p>

                    @isset($descriptions->public_opinion_verification_date)
                    <p>{{ date('d F, Y', strtotime($descriptions->public_opinion_verification_date)) }} তারিখের মধ্যে জনমত যাচাইয়ের জন্য বিলটি প্রচার করা হউক।
                    </p>
                    @endisset

                    <p class="my-4"></p>

                    @isset($standingCommittee)
                    <p>বিলটি সম্পর্কে {{ date('d F, Y', strtotime($descriptions->report_submit_date)) }} তারিখের মধ্যে রিপোর্ট পেশ করার জন্য বিলটি <strong>
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
                    <p>বিলটি সম্পর্কে {{ date('d F, Y', strtotime($descriptions->report_submit_date)) }} তারিখের মধ্যে রিপোর্ট পেশ করার জন্য বিলটি</p>
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <p><strong>

                                    @php
                                    $committeeList = $descriptions->assessment_committee;
                                    for($i=0; $i<count($committeeList); $i++){ foreach($allProfileData as $d){ if($committeeList[$i]==$d->user_id){
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
                                    {{ $item }}<br />
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

                    <p class="mb-4"><strong>তারিখঃ </strong> {{ date('d F, Y', strtotime($notices->created_at)) }} </p>
                    <p>আপনার আস্থাভাজন</p>
                    <p><strong>সদস্যের নামঃ</strong> {{ $notices->profileForNoticeFrom->name_bn }} </p>
                    <p><strong>নির্বাচনী এলাকাঃ </strong>
                        @if(session()->get('language') =='bn')
                        {{ $notices->profileForNoticeFrom->constituency->bn_name }}
                        @else
                        {{ $notices->profileForNoticeFrom->constituency->name }}
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
                    @endif
                    @if($rule_number==68)
                    <h3 class="text-center mb-4"> বাংলাদেশ জাতীয় সংসদ</h3>
                    <hr />
                    <p class="mt-5">সচিব, </p>
                    <p>বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>
                    <p>ঢাকা। </p>
                    <p><strong>বিষয়ঃ </strong> <span style="text-decoration:underline">কার্যপ্রণালী বিধির ৬৮ বিধি অনুসারে জরুরি জন-গুরুত্বসম্পন্ন বিষয় সম্পর্কে সাম্প্রতিক আলোচনা।</span></p>
                    <p>মহোদয়,</p>
                    <p>সংসদে {{ date('d F, Y', strtotime($notices->date)) }}
                        তারিখে নিম্নলিখিত জরুরী জন-গুরুত্বসম্পন্ন বিষয়ে আলোচনা করার নিমিত্তে আমি ৫ জন সদস্যসহ একটি নোটিশ প্রদান করিতেছি। </p>

                    <p class="my-5"></p>
                    <p><strong>(১) উত্থাপনের বিষয়ঃ</strong></p>
                    <p>{{ (isset($descriptions->question_subject))?$descriptions->question_subject:'' }}</p>
                    <p class="my-5"></p>
                    <p><strong>(২) উত্থাপনের কারণঃ</strong></p>
                    <p>{{ $descriptions->question_reason }}</p>
                    <p class="my-5"></p>

                    <p class="mb-5"><strong>তারিখঃ </strong> {{ date('d F, Y', strtotime($notices->created_at)) }} </p>
                    <p>আপনার আস্থাভাজন</p>
                    <p><strong>সদস্যের নামঃ</strong> {{ $notices->profileForNoticeFrom->name_bn }} </p>
                    <p><strong>নির্বাচনী এলাকাঃ </strong>
                        @if(session()->get('language') =='bn')
                        {{ $notices->profileForNoticeFrom->constituency->bn_name }}
                        @else
                        {{ $notices->profileForNoticeFrom->constituency->name }}
                        @endif
                    </p>
                    <p>সদস্য, বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>

                    <p class="my-5"></p>
                    <p><strong>এমপির তালিকাঃ</strong></p>
                    @php $i = 0;
                    $notices->mp_list = ($notices->mp_list!='')? explode(',',$notices->mp_list):[];
                    @endphp
                    @foreach ($allProfileData as $data)
                    @if(in_array($data->user_id, $notices->mp_list))
                    <div class="row">
                        <div style="width: 3%">
                            ({{ $i+1 }})
                        </div>
                        <div style="width: 97%">
                            <p class="mb-4">
                                <strong>নাম:</strong> {{ $data->name_bn }}<br />
                                <strong>সদস্য, নির্বাচনী এলাকা:</strong> {{ $data->constituency->name }}
                            </p>
                        </div>
                    </div>
                    @endif
                    @php $i++; @endphp
                    @endforeach

                    <p class="my-5">
                        @if(isset($attachments) && count($attachments) > 0)
                        @foreach($attachments as $file)
                        <a href="{{ asset('public/backend/attachment/'.$file->attachment)  }}" target="_blank" class="btn btn-success mr-2">View Attachment - {{ $loop->iteration }}</a>
                        @endforeach
                        @endif
                    </p>
                    @endif

                    @if($user_type=='speaker' && $notices->approval_date=='')
                    <p style="text-align:center;">
                        <a class="btn btn-lg btn-success" data-id="{{$notices->id}}" onClick="giveApproval(5)">
                            <i class="fa fa-check"> </i> @lang('Approved')
                        </a>
                        &nbsp; &nbsp;
                        <a class="btn btn-lg btn-danger" data-id="{{$notices->id}}" onClick="giveApproval(2)">
                            <i class="fa fa-times"> </i> @lang('Rejected')
                        </a>
                    </p>
                @endif
                
                @if($rule_number==82)
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
                    <p>আমি এতদ্বারা সংসদের বর্তমান অধিবেশনে বিবেচনার জন্য গ্রহণীয় জনাব,
                        <strong>@if($notices->to_wing_id>0) {{ $notices->wing_name }} ({{$notices->ministry_name }}) @else {{$notices->ministry_name }} @endif</strong>
                        এর উপরি-লিখিত বিলের বিধানসমূহে নিন্মোক্ত সংশোধনীর নোটিশ প্রদান করিতেছিঃ-</p>

                    <p class="my-4"></p>

                    @isset($descriptions->exchange_clause_add)
                        <p>{{ Lang::get($descriptions->bill_clause) }} দফার পরিবর্তে নিম্নোক্ত দফাটি সন্নিবেশ করা হউক, যথাঃ-</p>
                        <p> {{ $descriptions->exchange_clause_add }} </p>
                    @endisset
                                        
                    <p class="my-4"></p>

                    @isset($descriptions->new_clause_add)
                        <p>{{ Lang::get($descriptions->bill_clause) }} দফাটির পরে নিম্নোক্ত নূতন দফাটি/দফাসমূহ সন্নিবেশ/সংযোজন করা হউক, যথাঃ-</p>
                        <p> {{ $descriptions->new_clause_add }} </p>
                    @endisset

                    <p class="my-4"></p>

                    @isset($descriptions->conditional_clause_add)
                        <p>{{ Lang::get($descriptions->bill_clause) }} দফাটির পরে নিম্নোক্ত শর্ত-দফাটি সংযোজন করা হউক, যথাঃ-</p>
                        <p> {{ $descriptions->conditional_clause_add }} </p>
                    @endisset

                    <p class="my-4"></p>

                    @isset($descriptions->elimination_words_line)
                        <p>{{ Lang::get($descriptions->bill_clause) }} দফার 
                           {{ $descriptions->elimination_words_line }} পংক্তিতে অবস্থিত 
                           "{{ $descriptions->elimination_words }}" শব্দটি/শব্দাবলী বর্জন করা হউক। 
                        </p>
                    @endisset
                                    
                    <p class="my-4"></p>

                    @isset($descriptions->new_words_line)
                        <p>{{ Lang::get($descriptions->bill_clause) }} দফার
                           {{ Lang::get($descriptions->bill_sub_clause) }} উপ-দফার
                           {{ $descriptions->new_words_line }} পংক্তিতে অবস্থিত
                           "{{ $descriptions->new_words_add_after }}" শব্দাবলীর পরে 
                           "{{ $descriptions->new_words_add }}" শব্দাবলী সন্নিবেশ করা হউক। 
                        </p>
                    @endisset 

                    <p class="my-4"></p>

                    @isset($descriptions->exchange_paragraph)
                        <p>{{ Lang::get($descriptions->bill_clause) }} দফার
                           {{ Lang::get($descriptions->bill_sub_clause) }} উপ-দফার
                           "{{ $descriptions->exchange_paragraph }}" প্যারার পরিবর্তে নিম্নোক্ত প্যারাটি সন্নিবেশ করা হউক, যথাঃ- </p>
                        <p> {{ $descriptions->exchange_paragraph_add }} </p>
                    @endisset
                        
                    <p class="my-4"></p>

                    @isset($descriptions->exchange_words_para)
                        <p>{{ Lang::get($descriptions->bill_clause) }} দফার
                           {{ Lang::get($descriptions->bill_sub_clause) }} উপ-দফার
                           {{ $descriptions->exchange_words_para }} প্যারার
                           {{ $descriptions->exchange_words_line }} পংক্তিতে অবস্থিত
                           "{{ $descriptions->exchange_words_elimination }}" শব্দাবলীর বর্জন করা হউক এবং 
                           "{{ $descriptions->exchange_words_change }}" শব্দাবলীর পরিবর্তে
                           "{{ $descriptions->exchange_words_add }}" শব্দাবলী সন্নিবেশ করা হউক।
                        </p>
                    @endisset
                        
                    <p class="my-4"></p>

                    <p class="mb-4"><strong>তারিখঃ </strong>  {{ date('d F, Y', strtotime($notices->created_at)) }} </p>
                    <p>আপনার আস্থাভাজন</p>
                    <p><strong>সদস্যের নামঃ</strong> {{ $notices->profileForNoticeFrom->name_bn }} </p>
                    <p><strong>নির্বাচনী এলাকাঃ </strong> 
                        @if(session()->get('language') =='bn')
                        {{ $notices->profileForNoticeFrom->constituency->bn_name }} 
                        @else
                        {{ $notices->profileForNoticeFrom->constituency->name }} 
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
                @endif

                @if($rule_number==131)
                    <h3 class="text-center mb-4"> বাংলাদেশ জাতীয় সংসদ</h3>
                    <hr />
                    <p class="mt-5">সচিব, </p>
                    <p>বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>
                    <p>ঢাকা। </p>
                    <p>মহোদয়,</p>
                    <p>আমি এতদ্বারা নোটিশ দিতেছি যে, আমি সংসদের <span> {{ $notices->parliament_session_id == 1 ? 'বর্তমান' : 'আসন্ন' }} </span>
                        অধিবেশনে নিন্মলিখিত সিদ্ধান্ত প্রস্তাবটি উত্থাপন করিতে চাই। </p>

                    <p class="mt-5 mb-5"></p>
                    <p class="text-center my-4"><strong>সিদ্ধান্ত-প্রস্তাব</strong></p>
                    <p>সংসদে অভিমত এই যে, <strong>{!! $notices->topic !!}</strong></p>

                    <p class="my-5"><strong>তারিখঃ </strong> {{ date('d F, Y', strtotime($notices->created_at)) }} </p>
                    <p>আপনার আস্থাভাজন</p>
                    <p><strong>সদস্যের নামঃ</strong> {{ $notices->profileForNoticeFrom->name_bn }} </p>
                    <p><strong>নির্বাচনী এলাকাঃ </strong> {{ $notices->profileForNoticeFrom->constituency->name }} </p>
                    <p>সদস্য, বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>

                    <p class="mt-5 mb-5">
                        @if(isset($attachments) && count($attachments) > 0)
                        @foreach($attachments as $file)
                        <a href="{{ asset('public/backend/attachment/'.$file->attachment)  }}" target="_blank" class="btn btn-success mr-2">View Attachment - {{ $loop->iteration }}</a>
                        @endforeach
                        @endif
                    </p>
                @endif

            </div>
        </div>
    </div>
</div>
<script>
    /* change status from speaker */
    function giveApproval(item) {
        var acceptance_duration_limit = 0;

        if ($('#accept_for_30_mins').is(':checked')) {
            acceptance_duration_limit = $("#accept_for_30_mins").val();
        } else if ($('#accept_for_2_mins').is(':checked')) {
            acceptance_duration_limit = $("#accept_for_2_mins").val();
        } else {
            acceptance_duration_limit = 0;
        }
        Swal.fire({
            title: 'আপনি কি নিশ্চিত?',
            //text: "এই নোটিশটি সংসদে আলোচনা হবে!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '@lang("Yes")',
            cancelButtonText: '@lang("No")'
        }).then((result) => {
            if (result.value) {
                var url = "{{url('/admin/notice-management/notices/notice/setdata')}}";
                var _token = "{{csrf_token()}}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: _token,
                        type: 'approval',
                        id: ["{{$notices->id}}"],
                        approval_status: item,
                        acceptance_duration: acceptance_duration_limit
                    },
                    success: function(response) {
                        if (response == 1) {
                            Swal.fire({
                                title: (item == 5) ? 'এই নোটিশটি অনুমোদিত' : 'এই নোটিশটি প্রত্যাখ্যাত',
                                //text: "এই নোটিশটি সংসদে আলোচনা হবে!",
                                type: 'success'
                            }).then((result) => {
                                go_back();
                                load_data($("#item_type").val());
                            });
                        } else {
                            Swal.fire('Status Can not be set', '', 'error');
                        }
                    }
                });
            } else {
                //Swal.fire('Your data is safe', '', 'success');
            }
        })
    }
</script>