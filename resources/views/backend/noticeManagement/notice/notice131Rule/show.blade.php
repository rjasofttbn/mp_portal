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
                @foreach($notice_consent_data as $d)
                <p>{{ $d->user_name }} ({{$d->role_name}})  @if($d->user_consent==1) {!! ' <span class="badge badge-success px-2"> <i class="fa fa-check"></i> </span>'!!} @else {!! ' <span class="badge badge-danger px-2"><i class="fa fa-times"></i> </span>' !!} @endif </p>
                @endforeach
                @endif
                <div class="clearfix">&nbsp;</div>
                @if(authInfo()->usertype=='staff' && $total_stage!=$notices->stage_number)
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
                @if(authInfo()->usertype=='staff' && $total_stage==$notices->stage_number)
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
                <!-- end of Last Stage -->
            </div>
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
        </div>
    </div>
</div>
<script>
    var selected_consent = '';
    $(document).ready(function() {
        $(".consent_button").each(function() {
            $(this).on("click", function() {
                selected_consent = $(this).data('id');
                if(selected_consent==1){
                    $(this).removeClass('btn-secondary');
                    $(this).addClass('btn-success');
                    $('.consent_button').not(this).removeClass('btn-danger');
                    $('.consent_button').not(this).addClass('btn-secondary');
                }
                if(selected_consent==0){
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

    function giveConsent() {
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
                var _token = "{{csrf_token()}}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: _token,
                        type: 'stage_consent',
                        id: "{{$notices->id}}",
                        total_stage: "{{$total_stage}}",
                        stage_number: "{{$notices->stage_number}}",
                        user_consent: selected_consent,
                        stage_note: $("#stage_note").val()
                    },
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
</script>
@endsection