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
                    <p>আমি এতদ্বারা সংসদের বর্তমান অধিবেশনে বিবেচনার জন্য গ্রহণীয় জনাব,
                        <strong>{{ $to_whom }}</strong>
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
