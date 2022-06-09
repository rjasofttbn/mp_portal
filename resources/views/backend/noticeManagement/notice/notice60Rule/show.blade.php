@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Notice</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Create Notice</li>
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
                <h5 class="d-inline-block float-left pt-2 mb-0">{{ $notices->parliamentRule->name }}</h5>
                <a class="btn btn-info btn-md d-inline-block float-right" href="{{ route('admin.notice_management.notices.index') }}"><i class="fas fa-backward"></i> @lang('Back')</a>

            </div>
        </div>
        <div class="card">
            <div class="card-body" style="padding: 100px;">
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
            </div>
        </div>
    </div>
</div>

@endsection