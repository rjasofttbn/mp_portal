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
                    <p class="mt-5">সচিব, </p>
                    <p>বাংলাদেশ জাতীয় সংসদ সচিবালয় </p>
                    <p>ঢাকা। </p>
                    <p><strong>বিষয়ঃ </strong> <span style="text-decoration:underline">কার্যপ্রণালী বিধির ৬২ বিধি অনুসারে জন-গুরুত্বসম্পন্ন বিষয়ে সংসদে মুলতবি প্রস্তাব উত্থাপনের নোটিশ।</span></p>
                    <p>মহোদয়,</p>
                    <p>আমি এতদ্বারা নোটিশ দিতেছি যে, আমি সংসদের
                         {{ digitDateLang(nanoDateFormat($notices->date)) }} তারিখের বৈঠকে নিন্মলিখিত মুলতবি প্রস্তাবটি উত্থাপন করিতে চাই। </p>
                         
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
                </div>
            </div>
        </div>
    </div>

@endsection
