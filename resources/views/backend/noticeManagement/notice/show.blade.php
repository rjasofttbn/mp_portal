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
                <a class="btn btn-info btn-md d-inline-block float-right" href="{{ url()->previous() }}"><i class="fas fa-backward"></i> @lang('Back')</a>

            </div>
        </div>
        <div class="card">
            <div class="card-body" style="padding: 100px;">
                @if($notices->rule_number==42)
                @php
                $question_type_name = '';
                $q_types = comboList('question_types');
                foreach ($q_types as $q) {
                if ($notices->question_type == $q['id']) {
                $question_type_name = $q['name'];
                }
                }
                @endphp
                <h3 class="text-center mb-4"> বাংলাদেশ জাতীয় সংসদ</h3>
                <hr />
                <p class="mt-5">সচিব, </p>
                <p>বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>
                <p>ঢাকা। </p>
                <p><strong>বিষয়ঃ </strong> <span style="text-decoration:underline">কার্যপ্রণালী বিধির ৪২ বিধি অনুসারে প্রশ্ন উত্থাপনের নোটিশ।</span></p>
                <p>মহোদয়,</p>
                <p>আমি এতদ্বারা নোটিশ দিতেছি যে, আমি সংসদের <span> {{ $notices->parliament_session == 1 ? 'বর্তমান' : 'আসন্ন' }} </span> অধিবেশনের।
                    {{ digitDateLang(date('d F Y', strtotime($notices->date))) }} তারিখে অনুষ্ঠিতব্য বৈঠকে আমি নিন্মলিখিত প্রশ্নটি
                    {{ $question_type_name }} হিসাবে উত্থাপন করিতে চাই।
                </p>

                <p class="mt-5 mb-5"></p>

                <p><strong>@lang('Sitting Date') : </strong> {{ digitDateLang(date('d F Y', strtotime($notices->date))) }} </p>
                <p><strong>@lang('Question Type') : </strong>{{$question_type_name}}</p>
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


                <p class="mt-5 mb-5"></p>
                <p class="text-center my-4"><strong>প্রশ্নঃ</strong></p>
                <p> <strong>{{$to_whom}}</strong>, মন্ত্রী মহোদয় অনুগ্রহ করিয়া বলিবেন কি
                    <strong>{!! $notices->topic !!}</strong>
                </p>
                <p class="mt-5 mb-5"></p>
                <p class="mt-5 mb-5">
                    @if(isset($attachments) && count($attachments) > 0)
                    @foreach($attachments as $file)
                    <a href="{{ asset('public/backend/attachment/'.$file->attachment)  }}" target="_blank" class="btn btn-success mr-2">View Attachment - {{ $loop->iteration }}</a>
                    @endforeach
                    @endif
                </p>

                <div class="clearfix">&nbsp;</div>
                @if(auth()->user()->usertype=='staff')
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-2">
                            <label class="control-label" for="decision_proposal">স্ট্যাটাস</label>
                        </div>
                        <div class="col-sm-3 col-md-10 col-lg-3">
                            <select class="form-control select2" id="status_id" name="status_id">
                                <option value="">স্ট্যাটাস নির্বাচন করুন</option>
                                <option value="6">@lang('Waiting for Approval')</option>
                                <option value="2">@lang('Rejected')</option>

                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="comment_container">
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-2">
                            <label class="control-label" for="decision_proposal">@lang('Comments')</label>
                        </div>
                        <div class="col-sm-12 col-md-10 col-lg-10">
                            <textarea id="other_comments" name="comments" class="form-control">{{$notices->comments}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="comment_container">
                    <div class="row">
                        <button type="buton" class="btn btn-success btn-sm" data-route="{{url('/admin/notice-management/notices/notice/setdata')}}" id="setStatus">@lang('Submit')</button>
                    </div>
                </div>
                @endif
                @endif

                @if($notices->rule_number==59)
                <h3 class="text-center mb-4"> বাংলাদেশ জাতীয় সংসদ</h3>
                <hr />
                <p class="mt-5">সচিব, </p>
                <p>বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>
                <p>ঢাকা। </p>
                <p><strong>বিষয়ঃ </strong> <span style="text-decoration:underline">কার্যপ্রণালী বিধির ৫৯ বিধি অনুসারে স্বল্পকাল নোটিশে / প্রশ্ন উত্থাপনের নোটিশ।</span></p>
                <p>মহোদয়,</p>
                <p>আমি এতদ্বারা নোটিশ দিতেছি যে, আমি সংসদ অধিবেশনের
                    {{ digitDateLang(nanoDateFormat($notices->date)) }}
                    তারিখে অনুষ্ঠিতব্য বৈঠকে আমি নিন্মলিখিত প্রশ্নটি স্বল্পকালীন নোটিশের প্রশ্ন হিসাবে উত্থাপন করিতে চাই।
                </p>

                <p class="my-5"></p>


                <p><strong>@lang('Sitting Date') : </strong> {{ digitDateLang(nanoDateFormat($notices->date)) }} </p>
                <p><strong>মৌখিক উত্তরঃ</strong> {{ $notices->is_verbal == 1 ? 'হ্যাঁ' : 'না' }}</p>
                @if($notices->is_verbal == 1)
                <p><strong>ব্যাখ্যাঃ</strong> {{ $notices->explanation}}</p>
                @endif
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


                <p class="mt-5 mb-5"></p>
                <h4 class="text-center">স্বল্পকালীন নোটিশের কারণ:</h4>
                <p class="text-center my-4"><strong>প্রশ্নঃ</strong></p>
                <p> <strong>@if($notices->to_wing_id>0) {{ $notices->wing_name }} ({{$notices->ministry_name }}) @else {{$notices->ministry_name }} @endif</strong>, মন্ত্রী মহোদয় অনুগ্রহ করিয়া বলিবেন কি
                    <strong>{!! $notices->topic !!}</strong>
                </p>
                <p class="mt-5 mb-5"></p>
                <div class="clearfix">&nbsp;</div>
                @if(auth()->user()->usertype=='staff')
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-2">
                            <label class="control-label" for="decision_proposal">স্ট্যাটাস</label>
                        </div>
                        <div class="col-sm-3 col-md-10 col-lg-3">
                            <select class="form-control select2" id="status_id" name="status_id">
                                <option value="">স্ট্যাটাস নির্বাচন করুন</option>
                                <option value="6">@lang('Waiting for Approval')</option>
                                <option value="2">@lang('Rejected')</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="comment_container">
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-2">
                            <label class="control-label" for="decision_proposal">@lang('Comments')</label>
                        </div>
                        <div class="col-sm-12 col-md-10 col-lg-10">
                            <textarea id="other_comments" name="comments" class="form-control">{{$notices->comments}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="comment_container">
                    <div class="row">
                        <button type="buton" class="btn btn-success btn-sm" data-route="{{url('/admin/notice-management/notices/notice/setdata')}}" id="setStatus">@lang('Submit')</button>
                    </div>
                </div>
                @endif
                @endif

                @if($notices->rule_number==60)
                @php
                $question_type_name = '';
                $q_types = comboList('question_types');
                foreach ($q_types as $q) {
                if ($descriptions->question_type == $q['id']) {
                $question_type_name = $q['name'];
                }
                }
                @endphp
                <h3 class="text-center mb-4"> বাংলাদেশ জাতীয় সংসদ</h3>
                <hr />
                <p class="mt-5">সচিব, </p>
                <p>বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>
                <p>ঢাকা। </p>
                <p><strong>বিষয়ঃ </strong> <span style="text-decoration:underline">কার্যপ্রণালী বিধির ৬০ বিধি অনুসারে অর্ধ-ঘন্টা আলোচনার জন্য নোটিশ।</span></p>
                <p>মহোদয়,</p>
                <p>আমি এতদ্বারা নোটিশ দিতেছি যে, {{ digitDateLang(nanoDateFormat($descriptions->previous_date)) }} তারিখে সংসদে জিজ্ঞাসিত
                    {{ $descriptions->question_no }} নং {{ $question_type_name }}
                    প্রশ্নের উত্তরের পরিপ্রেক্ষিতে আমি নিন্মলিখিত জন-গুরুত্বসম্পন্ন বিষয় সম্পর্কে {{ digitDateLang(nanoDateFormat($notices->date)) }}
                    তারিখে সংসদে আলোচনা উত্থাপন করিতে চাই :-
                </p>
                <p class="mt-5 mb-5"></p>
                <p>(১) উত্থাপনীয় বিষয়ঃ </p>
                <p>{{ $notices->topic }}</p>

                <p class="mt-5 mb-5"></p>
                <p>(২) আলোচনা উত্থাপনের কারণ সম্পর্কে ব্যাখ্যা:</p>
                <p>{{ $descriptions->question_reason }}</p>

                <p class="mt-5 mb-5"></p>

                <p><strong>@lang('Question Type') : </strong>{{$question_type_name}}</p>
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

                <p class="mt-5 mb-5">
                    @if(isset($attachments) && count($attachments) > 0)
                    @foreach($attachments as $file)
                    <a href="{{ asset('public/backend/attachment/'.$file->attachment)  }}" target="_blank" class="btn btn-success mr-2">View Attachment - {{ $loop->iteration }}</a>
                    @endforeach
                    @endif
                </p>
                @endif

                @if($notices->rule_number==62)
                <h3 class="text-center mb-4"> বাংলাদেশ জাতীয় সংসদ</h3>
                <hr />
                <p class="mt-5">সচিব, </p>
                <p>বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>
                <p>ঢাকা। </p>
                <p><strong>বিষয়ঃ </strong> <span style="text-decoration:underline">কার্যপ্রণালী বিধির ৬২ বিধি অনুসারে জন-গুরুত্বসম্পন্ন বিষয়ে সংসদে মুলতবি প্রস্তাব উত্থাপনের নোটিশ।</span></p>
                <p>মহোদয়,</p>
                <p>আমি এতদ্বারা নোটিশ দিতেছি যে, আমি সংসদের
                    {{ digitDateLang(nanoDateFormat($notices->date)) }} তারিখের বৈঠকে নিন্মলিখিত মুলতবি প্রস্তাবটি উত্থাপন করিতে চাই।
                </p>

                <p class="mt-5 mb-5"></p>

                <p>অতএব, এই সম্পর্কে মাননীয় স্পীকারের সম্মতি লওয়ার জন্য আপনাকে অনুরোধ করিতেছি।</p>

                <p class="mt-5 mb-5"></p>

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


                <p class="mt-5 mb-5"></p>
                <p class="text-center my-4"><strong>মুলতবি প্রস্তাব</strong></p>
                <p> সাম্প্রতিক ও জন-গুরুত্বসম্পন্ন একটি সুনির্দিষ্ট বিষয় সম্পর্কে আলোচনা করার জন্য এই সংসদের কাজ এখন মুলতবি করা হউক, যথা :-
                    <strong>{{ $notices->topic }}</strong>
                </p>
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

                @if($notices->rule_number==68)
                <h3 class="text-center mb-4"> বাংলাদেশ জাতীয় সংসদ</h3>
                <hr />
                <p class="mt-5">সচিব, </p>
                <p>বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>
                <p>ঢাকা। </p>
                <p><strong>বিষয়ঃ </strong> <span style="text-decoration:underline">কার্যপ্রণালী বিধির ৬৮ বিধি অনুসারে জরুরি জন-গুরুত্বসম্পন্ন বিষয় সম্পর্কে সাম্প্রতিক আলোচনা।</span></p>
                <p>মহোদয়,</p>
                <p>সংসদে {{ digitDateLang(date('d F, Y', strtotime($notices->date))) }}
                    তারিখে নিম্নলিখিত জরুরী জন-গুরুত্বসম্পন্ন বিষয়ে আলোচনা করার নিমিত্তে আমি ৫ জন সদস্যসহ একটি নোটিশ প্রদান করিতেছি। </p>

                <p class="my-5"></p>
                <p><strong>(১) উত্থাপনের বিষয়ঃ</strong></p>
                <p>{{ $notices->topic }}</p>
                <p class="my-5"></p>
                <p><strong>(২) উত্থাপনের কারণঃ</strong></p>
                <p>{{ $descriptions->question_reason }}</p>
                <p class="my-5"></p>

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

                <p class="my-5"></p>
                <p><strong>এমপির তালিকাঃ</strong></p>
                @php $i = 0;
                $notices->mp_list = ($notices->mp_list!='')? explode(',',$notices->mp_list):[];
                @endphp
                @foreach ($allProfileData as $data)
                @if(in_array($data->user_id, $notices->mp_list))
                <div class="row">
                    <div style="width: 3%">
                        ({{ digitDateLang($i) }})
                    </div>
                    <div style="width: 97%">

                        <p class="mb-4">
                            <strong>নাম:</strong> {{ $data->name_bn }}<br />
                            <strong>সদস্য, নির্বাচনী এলাকা:</strong>
                            @if(session()->get('language') =='bn')
                            {{ '('.digitDateLang($data->constituency->number).') '.$data->constituency->bn_name }}
                            @else
                            {{ '('.digitDateLang($data->constituency->number).') '.$data->constituency->name }}
                            @endif
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

                @if($notices->rule_number==71)
                <h3 class="text-center mb-4"> বাংলাদেশ জাতীয় সংসদ</h3>
                <hr />
                <p class="mt-5">সচিব, </p>
                <p>বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>
                <p>ঢাকা। </p>
                <p><strong>বিষয়ঃ </strong> <span style="text-decoration:underline">কার্যপ্রণালী বিধির ৭১ বিধি অনুসারে জরুরি জন-গুরুত্বসম্পন্ন বিষয় সম্পর্কে মনোযোগ আকর্ষণের নোটিশ
                        ।</span></p>
                <p>মহোদয়,</p>
                <p>আমি এতদ্বারা নোটিশ দিতেছি যে, সংসদের অদ্যকার বৈঠকে আমি নিন্মলিখিত জরুরী জন-গুরুত্বসম্পন্ন বিষয়ের প্রতি
                    <strong>@if($notices->to_wing_id>0) {{ $notices->wing_name }} ({{$notices->ministry_name }}) @else {{$notices->ministry_name }} @endif </strong>, এর মনোযোগ আকর্ষণ করিতে চাই।
                </p>

                <p class="mt-5 mb-5"></p>
                <p>২। অতএব, এ বিষয়ের যথাযথ ব্যবস্থা গ্রহণের জন্য আপনাকে অনুরোধ করিতেছি। </p>
                <p class="mt-5 mb-5"></p>
                <p><strong>উত্থাপনীয় বিষয়:-</strong></p>
                {!! $notices->topic !!}
                <p class="mt-5 mb-5"><strong>@if($notices->to_wing_id>0) {{ $notices->wing_name }} ({{$notices->ministry_name }}) @else {{$notices->ministry_name }} @endif </strong>,</p>

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
                @endif

                @if($notices->rule_number==78)
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
                <p>আমি এতদ্বারা নোটিশ দিতেছি যে, {{ digitDateLang(nanoDateFormat($notices->date)) }} তারিখে অনুষ্ঠিতব্য সংসদের চলতি অধিবেশনে আমি জনাব
                    <strong>{{ $to_whom }}</strong>, কর্তৃক উত্থাপিত
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
                <p>{{ digitDateLang(nanoDateFormat($descriptions->public_opinion_verification_date)) }} তারিখের মধ্যে জনমত যাচাইয়ের জন্য বিলটি প্রচার করা হউক।
                </p>
                @endisset

                <p class="my-4"></p>

                @isset($standingCommittee)
                <p>বিলটি সম্পর্কে {{ digitDateLang(nanoDateFormat($descriptions->report_submit_date)) }} তারিখের মধ্যে রিপোর্ট পেশ করার জন্য বিলটি <strong>
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
                <p>বিলটি সম্পর্কে {{ digitDateLang(nanoDateFormat($descriptions->report_submit_date)) }} তারিখের মধ্যে রিপোর্ট পেশ করার জন্য বিলটি</p>
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
                @endif

                @if($notices->rule_number==82)
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
                <p>আমি এতদ্বারা সংসদের বর্তমান অধিবেশনে বিবেচনার জন্য গ্রহণীয় জনাব,
                    <strong>{{ $to_whom }}</strong>
                    এর উপরি-লিখিত বিলের বিধানসমূহে নিন্মোক্ত সংশোধনীর নোটিশ প্রদান করিতেছিঃ-
                </p>

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
                    "{{ $descriptions->exchange_paragraph }}" প্যারার পরিবর্তে নিম্নোক্ত প্যারাটি সন্নিবেশ করা হউক, যথাঃ-
                </p>
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
                @endif

                @if ($notices->rule_number == 131)
                <h3 class="text-center mb-4"> বাংলাদেশ জাতীয় সংসদ</h3>
                <hr />
                <p class="mt-5">সচিব, </p>
                <p>বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>
                <p>ঢাকা। </p>
                <p>মহোদয়,</p>
                <p>আমি এতদ্বারা নোটিশ দিতেছি যে, আমি সংসদের <span> {{ $notices->parliament_session == 1 ? 'বর্তমান' : 'আসন্ন' }} </span>
                    অধিবেশনে নিন্মলিখিত সিদ্ধান্ত প্রস্তাবটি উত্থাপন করিতে চাই। </p>

                <p class="mt-5 mb-5"></p>
                <p class="text-center my-4"><strong>সিদ্ধান্ত-প্রস্তাব</strong></p>
                <p>সংসদে অভিমত এই যে, <strong>{!! $notices->topic !!}</strong></p>

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
                @endif

                @if ($notices->rule_number == 164)
                <h3 class="text-center mb-4"> বাংলাদেশ জাতীয় সংসদ</h3>
                <hr />
                <p class="mt-5">সচিব, </p>
                <p>বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>
                <p>ঢাকা। </p>
                <p><strong>বিষয়ঃ </strong> <span style="text-decoration:underline">কার্যপ্রণালী বিধির ১৬৪ বিধি অনুসারে বিশেষ অধিকার প্রশ্নের নোটিশ।</span></p>
                <p>মহোদয়,</p>
                <p>আমি এতদ্বারা নোটিশ দিতেছি যে, আমি নিন্মলিখিত বিশেষ অধিকার প্রশ্নটি সংসদে উত্থাপন করিতে চাইঃ-
                </p>

                <p class="mt-5 mb-5"></p>
                <p>১। আমার অধিকার প্রশ্নের বিবরণ নিন্মরূপঃ</p>
                <p>{!! $notices->topic !!}</p>
                <p class="mt-5 mb-5"></p>
                <p>২। প্রশ্নের সহিত সংশ্লিষ্ট দলিল এতদসঙ্গে সংযোজিত করা হইলঃ </p>
                <p>{!! $descriptions->attachment_details !!}</p>
                <p class="mt-5 mb-5"></p>

                <p class="mb-5"><strong>তারিখঃ </strong> {{ date('d F, Y', strtotime($notices->created_at)) }} </p>
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

                <p class="mt-5 mb-5"></p>
                <p class="mt-5 mb-5">
                    @if(isset($attachments) && count($attachments) > 0)
                    @foreach($attachments as $file)
                    <a href="{{ asset('public/backend/attachment/'.$file->attachment)  }}" target="_blank" class="btn btn-success mr-2">View Attachment - {{ $loop->iteration }}</a>
                    @endforeach
                    @endif
                </p>
                @endif



                <!-- Stage start here  -->

                @if($user_type=='speaker')
                <p style="text-align:center;">
                    <a class="btn btn-lg btn-success" data-id="{{$notices->id}}" onClick="giveApproval(5)">
                        <i class="fa fa-check"> </i> APPROVE
                    </a>
                    &nbsp; &nbsp;
                    <a class="btn btn-lg btn-danger" data-id="{{$notices->id}}" onClick="giveApproval(2)">
                        <i class="fa fa-times"> </i> REJECT
                    </a>
                </p>
                @endif

                <!-- before Last Stage start here  -->
                @if(isset($notice_consent_data) && count($notice_consent_data)>0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>@lang('Serial')</th>
                            <th>@lang('Name')</th>
                            <th>@lang('Designation')</th>
                            <th>@lang('Consent')</th>
                            <th>@lang('Comments')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notice_consent_data as $d)
                        <tr>
                            <td>{{digitDateLang($loop->iteration)}}</td>
                            <td>{{ $d->user_name }} </td>
                            <td>{{$d->role_name}}</td>
                            <td> @if($d->user_consent==1) {!! ' <span class="badge badge-success px-2"> <i class="fa fa-check"></i> </span>'!!} @else {!! ' <span class="badge badge-danger px-2"><i class="fa fa-times"></i> </span>' !!} @endif </td>
                            <td>{!! $d->note !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif

                <div class="clearfix">&nbsp;</div>
                @if(authInfo()->usertype=='staff' && $notices->stage_number==1 && (!isset($my_consent_data->user_consent)))
                <div class="form-group">
                    <div class="row">
                        <div class="col-2">
                            <label class="control-label" for="decision_proposal">স্ট্যাটাস</label>
                        </div>
                        <div class="col-3">
                            <select class="form-control select2" id="notice_status_id" name="notice_status_id">
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
                @endif
                @if(authInfo()->usertype=='staff' && (!isset($my_consent_data->user_consent)))
                <div class="form-group" id="comment_container">
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-2">
                            <label class="control-label" for="stage_note">@lang('Comments')</label>
                        </div>
                        <div class="col-sm-12 col-md-10 col-lg-10">
                            <textarea id="stage_note" name="stage_note" class="form-control textareaWithoutImgVideo">
                            {{isset($my_consent_data->note)? $my_consent_data->note : '' }}
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <p style="text-align:center;">
                        <a class="btn btn-lg {{(isset($notice_consent_data->user_consent) && $notice_consent_data->user_consent==1)?'btn-success':'btn-secondary'}} consent_button" data-id="1">
                            <i class="fa fa-check"> </i> @lang('Agree')
                        </a>
                        &nbsp; &nbsp;
                        <a class="btn btn-lg {{(isset($notice_consent_data->user_consent) && $notice_consent_data->user_consent==0)?'btn-danger':'btn-secondary'}} consent_button" data-id="0">
                            <i class="fa fa-times"> </i> @lang('Disagree')
                        </a>
                    </p>
                </div>
                <div class="form-group" id="comment_container">
                    <div class="row">
                        <button type="buton" class="btn btn-success btn-sm" data-route="{{url('/admin/notice-management/notices/notice/setdata')}}" onClick="giveConsent()" style="margin:0 auto;">@lang('Submit')</button>
                    </div>
                </div>
                @endif

                <!-- Start last Stage -->
                <div class="clearfix">&nbsp;</div>
                @if(authInfo()->usertype=='staff' && $total_stage==$notices->stage_number && $notices->status==5 && $notices->priority>0)
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-2">
                            <label class="control-label" for="decision_proposal">মন্ত্রণালয়</label>
                        </div>
                        <div class="col-sm-3 col-md-10 col-lg-3">
                            <select class="form-control select2" id="ministry_id" name="ministry_id">
                                <option value="0">মন্ত্রণালয় নির্বাচন করুন</option>
                                @foreach($ministry_list as $list)
                                <option value="{{$list->id}}" @if($list->id==$notices->ministry_id) {{'selected="selected"'}} @endif>{{$list->name_bn}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="comment_container">
                    <div class="row">
                        <div class="col-sm-12 col-md-2 col-lg-2">
                            <label class="control-label" for="decision_proposal">@lang('Comments')</label>
                        </div>
                        <div class="col-sm-12 col-md-10 col-lg-10">
                            <textarea id="other_comments" name="comments" class="form-control textareaWithoutImgVideo">{{$notices->comments}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="comment_container">
                    <div class="row">
                        <button type="buton" class="btn btn-success btn-sm" data-route="{{url('/admin/notice-management/notices/notice/setdata')}}" onClick="notifyMinistry()" style="margin:0 auto;">@lang('Submit')</button>
                    </div>
                </div>
                @endif

                <!-- End of Last Stage -->
                @if(authInfo()->usertype=='mp' && $notices->comments!='')
                <div class="comment_section">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label class="control-label" for="decision_proposal">@lang('Comments')</label>
                            </div>
                            <div class="col-9">
                                {{$notices->comments}}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- Stage End here  -->
            </div>
        </div>
    </div>
</div>
<script>
    var selected_consent = '';
    var current_stage = "{{$notices->stage_number}}";

    $(document).ready(function() {
        $(".consent_button").each(function() {
            $(this).on("click", function() {
                selected_consent = $(this).data('id');
                if (selected_consent == 1) {
                    $(this).removeClass('btn-secondary');
                    $(this).addClass('btn-success');
                    $('.consent_button').not(this).removeClass('btn-danger');
                    $('.consent_button').not(this).addClass('btn-secondary');
                }
                if (selected_consent == 0) {
                    $(this).removeClass('btn-secondary');
                    $(this).addClass('btn-danger');
                    $('.consent_button').not(this).removeClass('btn-success');
                    $('.consent_button').not(this).addClass('btn-secondary');
                }
                console.log(selected_consent);
            });
        });
    });
    /* change status from speaker */
    function giveApproval(item) {
        Swal.fire({
            title: 'আপনি কি নিশ্চিত?',
            //text: "এই নোটিশটি সংসদে আলোচনা হবে!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'YES',
            cancelButtonText: 'NO'
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
                        id: "{{$notices->id}}",
                        approval_status: item
                    },
                    success: function(response) {
                        if (response == 1) {
                            Swal.fire({
                                title: (item == 5) ? 'এই নোটিশটি অনুমোদিত' : 'এই নোটিশটি প্রত্যাখ্যাত',
                                //text: "এই নোটিশটি সংসদে আলোচনা হবে!",
                                type: 'success'
                            }).then((result) => {
                                window.location.href = "{{ url('/admin/notice-management/notices/index/6')}}";
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

    function notifyMinistry() {
        Swal.fire({
            title: 'আপনি কি নিশ্চিত?',
            //text: "এই নোটিশটি সংসদে আলোচনা হবে!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'YES',
            cancelButtonText: 'NO'
        }).then((result) => {
            if (result.value) {
                var url = "{{url('/admin/notice-management/notices/notice/setdata')}}";
                var _token = "{{csrf_token()}}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: _token,
                        type: 'notify_ministry',
                        id: "{{$notices->id}}",
                        ministry_id: $("#ministry_id").val(),
                        comments: $("#other_comments").val()
                    },
                    success: function(response) {
                        if (response == 1) {
                            Swal.fire({
                                title: 'এই নোটিশটি মন্ত্রনালয়ে পাঠানো হয়েছে',
                                //text: "এই নোটিশটি সংসদে আলোচনা হবে!",
                                type: 'success'
                            }).then((result) => {
                                window.location.href = "{{ url('/admin/notice-management/notices/index/1')}}";
                            });
                        } else {
                            Swal.fire('কারিগরী সমস্যা', '', 'error');
                        }
                    }
                });
            } else {
                //Swal.fire('Your data is safe', '', 'success');
            }
        })
    }

    function giveConsent() {
        var request_data = {};
        var _token = "{{csrf_token()}}";
        if (current_stage == 1) {
            var notice_status;
            var acceptable_tag = $("input[name='acceptance_tag']:checked").val();
            if (acceptable_tag == undefined) {
                Swal.fire('you must choose any acceptance tag', '', 'info');
                return false;
            }
            request_data = {
                _token: _token,
                type: 'stage_consent',
                id: "{{$notices->id}}",
                total_stage: "{{$total_stage}}",
                stage_number: "{{ isset($my_consent_data->stage_number)? $my_consent_data->stage_number : $notices->stage_number}}",
                user_consent: selected_consent,
                stage_note: $("#stage_note").val(),
                notice_status: $("#notice_status_id").val(),
                acceptance_tag: acceptable_tag
            };
        } else {
            request_data = {
                _token: _token,
                type: 'stage_consent',
                id: "{{$notices->id}}",
                total_stage: "{{$total_stage}}",
                stage_number: "{{ isset($my_consent_data->stage_number)? $my_consent_data->stage_number : $notices->stage_number}}",
                user_consent: selected_consent,
                stage_note: $("#stage_note").val()
            };
        }


        Swal.fire({
            title: '@lang("Are You Sure?")',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'YES',
            cancelButtonText: 'NO'
        }).then((result) => {
            if (result.value) {
                var url = "{{url('/admin/notice-management/notices/notice/setdata')}}";

                $.ajax({
                    url: url,
                    type: "POST",
                    data: request_data,
                    success: function(response) {
                        if (response == 1) {
                            Swal.fire({
                                title: '@lang("Your Consent has been sent")',
                                type: 'success'
                            }).then((result) => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('কারিগরী সমস্যা', '', 'error');
                        }
                    }
                });
            } else {
                //Swal.fire('Your data is safe', '', 'success');
            }
        })
    }

    function changeNoticeStatus() {
        var acceptable_tag = $("input[name='acceptance_tag']:checked").val();
        if (acceptable_tag == undefined) {
            Swal.fire('you must choose any acceptance tag', '', 'info');
            return false;
        }
        console.log(acceptable_tag);
        //return false;
        Swal.fire({
            title: 'আপনি কি নিশ্চিত?',
            //text: "এই নোটিশটি সংসদে আলোচনা হবে!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'YES',
            cancelButtonText: 'NO'
        }).then((result) => {
            if (result.value) {
                var url = "{{url('/admin/notice-management/notices/notice/setdata')}}";
                var _token = "{{csrf_token()}}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: _token,
                        type: 'step_approval',
                        id: "{{$notices->id}}",
                        comments: $("#notice_comments").val(),
                        approval_status: $("#notice_status_id"),
                        acceptance_tag: acceptable_tag
                    },
                    success: function(response) {
                        if (response == 1) {
                            Swal.fire({
                                title: (item == 5) ? 'এই নোটিশটি অনুমোদিত' : 'এই নোটিশটি প্রত্যাখ্যাত',
                                //text: "এই নোটিশটি সংসদে আলোচনা হবে!",
                                type: 'success'
                            }).then((result) => {
                                //window.location.href = "{{ url('/admin/notice-management/notices/index/6')}}";
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
<script>
    $(document).ready(function() {
        $("#notice_status_id").on('change', function() {
            if ($(this).val() == 6) {
                $(".acceptable_tag").removeClass('d-none');
                $(".acceptable_tag").addClass('block');
            } else {
                $(".acceptable_tag").removeClass('block');
                $(".acceptable_tag").addClass('d-none');
            }
        });

        var notice_tag = "{{$notices->acceptance_tag}}";
        if (notice_tag != '') {
            $(".acceptable_tag").removeClass('d-none');
            $(".acceptable_tag").addClass('block');
        } else {
            $(".acceptable_tag").removeClass('block');
            $(".acceptable_tag").addClass('d-none');
        }

    });
</script>
@endsection