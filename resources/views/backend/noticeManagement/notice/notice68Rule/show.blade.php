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
                    <p><strong>বিষয়ঃ </strong> <span style="text-decoration:underline">কার্যপ্রণালী বিধির ৬৮ বিধি অনুসারে জরুরি জন-গুরুত্বসম্পন্ন বিষয় সম্পর্কে সাম্প্রতিক আলোচনা।</span></p>
                    <p>মহোদয়,</p>
                    <p>সংসদে {{ date('d F, Y', strtotime($notices->date)) }} 
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
                                    ({{ $i+1 }})
                                </div>
                                <div style="width: 97%">
                                    <p class="mb-4">
                                        <strong>নাম:</strong>  {{ $data->name_bn }}<br/>
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
                </div>
            </div>
        </div>
    </div>

@endsection
