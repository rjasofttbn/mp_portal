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
                <p><strong>বিষয়ঃ </strong> <span style="text-decoration:underline">কার্যপ্রণালী বিধির ৫৯ বিধি অনুসারে স্বল্পকাল নোটিশে / প্রশ্ন উত্থাপনের নোটিশ।</span></p>
                <p>মহোদয়,</p>
                <p>আমি এতদ্বারা নোটিশ দিতেছি যে, আমি সংসদ অধিবেশনের
                    {{ digitDateLang(nanoDateFormat($notices->date)) }}
                    তারিখে অনুষ্ঠিতব্য বৈঠকে আমি নিন্মলিখিত প্রশ্নটি স্বল্পকালীন নোটিশের প্রশ্ন হিসাবে উত্থাপন করিতে চাই।
                </p>

                <p class="my-5"></p>


                <p><strong>@lang('Sitting Date') : </strong> {{ digitDateLang(nanoDateFormat($notices->date)) }} </p>
                <p><strong>মৌখিক উত্তরঃ</strong>  {{ $notices->is_verbal == 1 ? 'হ্যাঁ' : 'না' }}</p>
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
                {{-- <p class="mt-5 mb-5">
                    @if(isset($attachments) && count($attachments) > 0)
                    @foreach($attachments as $file)
                    <a href="{{ asset('public/backend/attachment/'.$file->attachment)  }}" target="_blank" class="btn btn-success mr-2">View Attachment - {{ $loop->iteration }}</a>
                    @endforeach
                    @endif
                </p> --}}
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

            </div>
        </div>
    </div>
</div>

<script>
    /* change status from department for speaker */
    $(document).on('click', '#setStatus', function() {
        var btn = this;
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
            console.log(result);
            if (result.value) {
                var url = "{{url('/admin/notice-management/notices/notice/setdata')}}";
                var _token = "{{csrf_token()}}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: _token,
                        type: 'dept_status',
                        status: $("#status_id").val(),
                        comments: $("#other_comments").val(),
                        id: "{{$notices->id}}"
                    },
                    success: function(response) {
                        if (response == 1) {
                            Swal.fire({
                                title: 'এই বিজ্ঞপ্তি অনুমোদনযোগ্য',
                                //text: "এই নোটিশটি সংসদে আলোচনা হবে!",
                                type: 'success'
                            }).then((result) => {
                                window.location.href = "{{ url('/admin/notice-management/notices/index/1')}}";
                            });
                        } else {
                            Swal.fire('Error!!!', '', 'error');
                        }
                    }
                });
            } else {
                //Swal.fire('Your data is safe', '', 'success');
            }
        });
    });
</script>

@endsection