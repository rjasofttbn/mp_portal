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
            </div>

        </div>

    </div>
</div>



@endsection