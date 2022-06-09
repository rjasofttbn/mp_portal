@extends('backend.petitionManagement.layouts.app')
<style>
    .focusedInput {
        border-color: rgb(247 60 60) !important;
        outline: 0;
        outline: thin dotted \9;
        -moz-box-shadow: 0 0 3px rgba(255, 0, 0);
        box-shadow: 0 0 3px rgba(255,0,0) !important;
    }
</style>
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container text-center">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h4 class="my-3 text-dark">@lang('পিটিশন আবেদন ফরম (বিধি-১০২)')</h4>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <div class="container">
        <div class="col-md-12">
        <div class="card p-5">
            <p>মাননীয় চেয়ারম্যান<br/>
                পিটিশন কমিটি <br/>
                    বাংলাদেশ জাতীয় সংসদ<br/>
                        গণপ্রজাতন্ত্রী বাংলাদেশ সমীপেষু</p>

                <form method="POST" enctype="multipart/form-data" id="petitionCreateForm" class="form-horizontal mt-3"  action="javascript:void(0)">
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="control-label" for="applicant_name">@lang('আবেদনকারীর নাম') <span class="text-danger"> *</span></label>

                            <div class="input-group">
                                <input type="text" class="form-control formOnInput @error('applicant_name') is-invalid @enderror" name="applicant_name" id="applicant_name" value="{{old('applicant_name')}}" placeholder="@lang('আবেদনকারীর নাম লিখুন')" />
                                
                            </div>

                            @error('applicant_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="control-label" for="applicant_designation">@lang('আবেদনকারীর পদবি') <span class="text-danger"> *</span></label>

                            <div class="input-group">
                                <input type="text" required class="form-control formOnInput @error('applicant_designation') is-invalid @enderror" name="applicant_designation" id="applicant_designation" value="{{old('applicant_designation')}}" placeholder="@lang('আবেদনকারীর পদবি লিখুন')" />
                                
                            </div>

                            @error('applicant_designation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <label class="control-label" for="parliament_session">@lang('ঠিকানা') <span class="text-danger"> *</span></label>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-group">
                            <select id="applicant_division_id" name="applicant_division_id" class="form-control formOnSelect @error('applicant_division_id') is-invalid @enderror select2">
                                <option value="">@lang('Select Division')</option>
                                @foreach ($divisions as $data)
                                    @if($data['id']==old('applicant_division_id'))
                                        <option selected
                                                value="{{$data['id']}}">
                                                @if(session()->get('language') =='bn')
                                                    {{$data['bn_name']}}
                                                @else
                                                    {{$data['name']}}
                                                @endif
                                        </option>
                                    @else
                                        <option  value="{{$data['id']}}">
                                            @if(session()->get('language') =='bn')
                                                {{$data['bn_name']}}
                                            @else
                                                {{$data['name']}}
                                            @endif
                                        </option>
                                    @endif
                                @endforeach
                            </select>

                            @error('applicant_division_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-group">
                            <select id="applicant_district_id" name="applicant_district_id" class="form-control formOnSelect @error('applicant_district_id') is-invalid @enderror  select2">
                                <option value="">@lang('Select District')</option>

                            </select>

                            @error('applicant_district_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-group">
                            <select id="applicant_upazila_id" name="applicant_upazila_id" class="form-control formOnSelect @error('applicant_upazila_id') is-invalid @enderror  select2">
                                <option value="">@lang('Select Upazila')</option>

                            </select>

                            @error('applicant_upazila_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control formOnInput @error('applicant_union') is-invalid @enderror" name="applicant_union" id="applicant_union" value="{{old('applicant_union')}}" placeholder="@lang('ইউনিয়ন লিখুন')" />
                                
                            </div>

                            @error('applicant_union')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <textarea id="applicant_more_address" name="applicant_more_address" class="form-control @error('applicant_more_address') is-invalid @enderror" placeholder="@lang('আরো লিখুন')">
                                {{old('applicant_more_address')}} 
                                </textarea>

                            @error('applicant_more_address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="control-label" for="description">@lang('পিটিশনের বিষয়টির সংক্ষিপ্ত বিবরণী') <span class="text-danger"> *</span></label>
                        
                            <textarea rows="8" id="description" name="description" class="form-control formOnInput @error('description') is-invalid @enderror">
                            {{old('description')}}
                            </textarea>

                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="control-label" for="prayer">@lang('আবেদনকারীর প্রার্থনা') <span class="text-danger"> *</span></label>
                        
                            <textarea rows="8" id="prayer" name="prayer" class="form-control formOnInput @error('prayer') is-invalid @enderror">
                            {{old('prayer')}}
                            </textarea>

                            @error('prayer')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div id="applicant">
                    <div class="row mb-3">
                        <div class="col-sm-11 ml-2 p-3" style="background: #f7f7f7">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label class="control-label" for="parliament_session">@lang('আবেদনকারীর (দের) নাম, ঠিকানা ও স্বাক্ষর') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        
                                        <div class="input-group">
                                            <input type="text" class="form-control formOnInput @error('multi_name') is-invalid @enderror" name="applicant_list[name][]" id="multi_name_0" value="{{old('multi_name')}}" placeholder="@lang('আবেদনকারীর নাম লিখুন')" />
                                            
                                        </div>

                                        @error('multi_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control formOnInput @error('signature') is-invalid @enderror" name="applicant_list[signature][]" id="signature_0" value="{{old('signature')}}" placeholder="@lang('স্বাক্ষর')" />
                                            
                                        </div>

                                        @error('signature')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <select id="division_id_0" name="applicant_list[division][]" class="form-control division_id formOnSelect @error('division_id') is-invalid @enderror  select2">
                                            <option value="">@lang('Select Division')</option>
                                            @foreach ($divisions as $data)
                                                @if($data['id']==old('division_id'))
                                                    <option selected
                                                            value="{{$data['id']}}">
                                                            @if(session()->get('language') =='bn')
                                                                {{$data['bn_name']}}
                                                            @else
                                                                {{$data['name']}}
                                                            @endif
                                                    </option>
                                                @else
                                                    <option  value="{{$data['id']}}">
                                                        @if(session()->get('language') =='bn')
                                                            {{$data['bn_name']}}
                                                        @else
                                                            {{$data['name']}}
                                                        @endif
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @error('division_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <select id="district_id_0" name="applicant_list[district][]" class="form-control district_id formOnSelect @error('district_id') is-invalid @enderror  select2">
                                            <option value="">@lang('Select District')</option>

                                        </select>

                                        @error('district_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <select id="upazila_id_0"  name="applicant_list[upazila][]" class="form-control upazila_id formOnSelect @error('upazila_id') is-invalid @enderror  select2">
                                            <option value="">@lang('Select Upazila')</option>

                                        </select>

                                        @error('upazila_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control formOnInput @error('union') is-invalid @enderror" name="applicant_list[union][]" id="union_0" value="{{old('union')}}" placeholder="@lang('ইউনিয়ন লিখুন')" />
                                            
                                        </div>

                                        @error('union')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <textarea id="more_address_0" name="applicant_list[more_address][]" class="form-control @error('more_address') is-invalid @enderror" placeholder="@lang('আরো লিখুন')">
                                            {{old('more_address')}} 
                                            </textarea>

                                        @error('more_address')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-1" style="display: contents;">
                            <button type="button" class="btn btn-success addApplicant  btn-lg"> <i class="fa fa-plus"> </i> </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="control-label" for="mp_name">@lang('সংসদ সদস্যের তথ্য') <span class="text-danger"> *</span></label>
                        
                            <select id="mp_name" name="mp_name" class="@error('mp_name') is-invalid @enderror form-control formOnSelect select2">
                                <option value="">@lang('সংসদ সদস্যের নাম নির্বাচন করুন')</option>

                                @foreach ($profileDatas as $data)
                                    <option value="{{ $data->user_id }}">{{ $data->name_bn }}</option>
                                @endforeach

                            </select>
                            @error('mp_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="control-label" for="attachment">@lang('Attachment (if any)')</label>

                            <div class="file p-0">
                                <input type="file" class="form-control attachment_upload pl-1" name="attachment[]" id="attachment" multiple accept=".png, .jpg, .jpeg, .pdf">
                            </div>

                            @error('attachment')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                

                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group text-center mt-4">
                            <button type="button" id="modalBtn" class="btn btn-success mt-2">@lang('পরবর্তী ধাপ')</button>                                    
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="petitionModal" tabindex="-1" role="dialog" aria-labelledby="petitionModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div id="modalBtn" class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="petitionModalLabel">আবেদনকারীর</h5>
                            <h5 class="modal-title d-none" id="otpModalLabel">আপনার প্রদত্ত মোবাইল নম্বরে প্রেরিত ও টি পি নির্ধারিত সময়ের মধ্যে দিন</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="input-group contactInfo">
                                        <input type="text" class="form-control formOnInput @error('applicant_nid') is-invalid @enderror" name="applicant_nid" id="applicant_nid" value="{{old('applicant_nid')}}" placeholder="@lang('এন আই ডি নম্বর লিখুন')" />
                                        
                                    </div>
                                    @error('applicant_nid')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group contactInfo">
                                    <div class="input-group">
                                        <input type="text" class="form-control formOnInput @error('applicant_mobile') is-invalid @enderror" name="applicant_mobile" id="applicant_mobile" value="{{old('applicant_mobile')}}" placeholder="@lang('মোবাইল নম্বর লিখুন')" />
                                        
                                    </div>
                                    @error('applicant_mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group contactInfo">
                                    <div class="input-group">
                                        <input type="email" class="form-control formOnInput @error('applicant_email') is-invalid @enderror" name="applicant_email" id="applicant_email" value="{{old('applicant_email')}}" placeholder="@lang('ইমেইল লিখুন')" />
                                        
                                    </div>
                                    @error('applicant_email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group otpInfo d-none">
                                    <div class="input-group">
                                        <input type="text" class="form-control formOnInput @error('otp_number') is-invalid @enderror" name="otp_number" id="otp_number" value="{{old('otp_number')}}" placeholder="@lang('ও টি পি লিখুন ')" />
                                        
                                    </div>
                                    @error('otp_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group otpView d-none">

                                    <button type="button" id="otpViewBtn" class="btn btn-success">@lang('View OTP')</button>

                                    <div style="float: right;
                                    font-weight: 700;
                                    border: 1px solid;
                                    padding: 5px 15px;" id="otpView"></div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" id="backBtn" class="btn btn-dark d-none">@lang('পিছনে')</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('বাতিল করুন')</button>
                                <button type="button" id="submitBtn" class="btn btn-success">@lang('পরবর্তী ধাপ')</button>
                                
                                
                                <button type="submit" id="finalSubmitBtn" class="btn btn-success d-none">@lang('জমা দিন')</button>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- Modal -->
            </form> 
        </div>
        </div>
    </div>

    <script>
        $(function(){

            $('.formOnInput').on('keyup', function () {
                if ($.trim($('.formOnInput').val()).length) {
                    $(this).removeClass('focusedInput');
                }
            });

            $('.formOnSelect').on('change', function () {
                $('.select2-selection').removeClass('focusedInput');
            });

            $('#modalBtn').on('click', function () {
                var applicant_name          = $('#applicant_name').val();
                var applicant_designation   = $('#applicant_designation').val();
                var applicant_division_id   = $('#applicant_division_id').val();
                var applicant_district_id   = $('#applicant_district_id').val();
                var applicant_upazila_id    = $('#applicant_upazila_id').val();
                var applicant_union         = $('#applicant_union').val();
                var description             = $('#description').val();
                var prayer                  = $('#prayer').val();
                var multi_name_0            = $('#multi_name_0').val();
                var signature_0             = $('#signature_0').val();
                var division_id_0           = $('#division_id_0').val();
                var district_id_0           = $('#district_id_0').val();
                var upazila_id_0            = $('#upazila_id_0').val();
                var union_0                 = $('#union_0').val();
                var mp_name                 = $('#mp_name').val();

                if(applicant_name.length==0){
                    toastr.error('The Name Field is Required!');
                    $('#applicant_name').addClass('focusedInput');
                }else if(applicant_designation.length==0){
                    toastr.error('The Designation Field is Required!');
                    $('#applicant_designation').addClass('focusedInput');
                }else if(applicant_division_id.length==0){
                    toastr.error('The Division Field is Required!');
                    $('[aria-labelledby="select2-applicant_division_id-container"]').addClass('focusedInput');
                }else if(applicant_district_id.length==0){
                    toastr.error('The District Field is Required!');
                    $('[aria-labelledby="select2-applicant_district_id-container"]').addClass('focusedInput');
                }else if(applicant_upazila_id.length==0){
                    toastr.error('The Upazila Field is Required!');
                    $('[aria-labelledby="select2-applicant_upazila_id-container"]').addClass('focusedInput');
                }else if(applicant_union.length==0){
                    toastr.error('The Union Field is Required!');
                    $('#applicant_union').addClass('focusedInput');
                }else if(description.length==0){
                    toastr.error('The Description Field is Required!');
                    $('#description').addClass('focusedInput');
                }else if(prayer.length==0){
                    toastr.error('The Prayer Field is Required!');
                    $('#prayer').addClass('focusedInput');
                }else if(multi_name_0.length==0){
                    toastr.error('The Name Field is Required!');
                    $('#multi_name_0').addClass('focusedInput');
                }else if(signature_0.length==0){
                    toastr.error('The Signature Field is Required!');
                    $('#signature_0').addClass('focusedInput');
                }else if(division_id_0.length==0){
                    toastr.error('The Division Field is Required!');
                    $('[aria-labelledby="select2-division_id_0-container"]').addClass('focusedInput');
                }else if(district_id_0.length==0){
                    toastr.error('The District Field is Required!');
                    $('[aria-labelledby="select2-district_id_0-container"]').addClass('focusedInput');
                }else if(upazila_id_0.length==0){
                    toastr.error('The Upazila Field is Required!');
                    $('[aria-labelledby="select2-upazila_id_0-container"]').addClass('focusedInput');
                }else if(union_0.length==0){
                    toastr.error('The Union Field is Required!');
                    $('#union_0').addClass('focusedInput');
                }else if(mp_name.length==0){
                    toastr.error('The Upazila Field is Required!');
                    $('[aria-labelledby="select2-mp_name-container"]').addClass('focusedInput');
                }else{
                    $('#petitionModal').modal('show');
                }
                
            });

            $('#submitBtn').on('click', function () {
                
                var applicant_nid       = $('#applicant_nid').val();
                var applicant_mobile    = $('#applicant_mobile').val();
                var applicant_email     = $('#applicant_email').val();

                if(applicant_nid.length==0){
                    toastr.error('The NID Field is Required!');
                    $('#applicant_nid').addClass('focusedInput');
                }else if(applicant_mobile.length==0){
                    toastr.error('The Mobile Field is Required!');
                    $('#applicant_mobile').addClass('focusedInput');
                }else if(applicant_email.length==0){
                    toastr.error('The E-mail Field is Required!');
                    $('#applicant_email').addClass('focusedInput');
                }else if(IsEmail(applicant_email)==false){
                    toastr.error('Enter valid E-mail!');
                    $('#applicant_email').addClass('focusedInput');
                }else{
                    $.ajax({
                        url: "{{url('petitionsContactInfo')}}",
                        type: "POST",
                        data: {
                            _token: "{{csrf_token()}}",
                            applicant_mobile: applicant_mobile
                        }
                    });

                    $(this).addClass('d-none');
                    $('.contactInfo').addClass('d-none');
                    $('#petitionModalLabel').addClass('d-none');

                    $('#otpModalLabel').removeClass('d-none');
                    $('#backBtn').removeClass('d-none');
                    $('#finalSubmitBtn').removeClass('d-none');
                    $('.otpInfo').removeClass('d-none');
                    $('.otpView').removeClass('d-none');
                }
            });

            function IsEmail(email) {
                var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if(!regex.test(email)) {
                    return false;
                }else{
                    return true;
                }
            }

            $('#backBtn').on('click', function () {
                $('#submitBtn').removeClass('d-none');
                $('#petitionModalLabel').removeClass('d-none');
                $('.contactInfo').removeClass('d-none');
                $('.otpInfo').addClass('d-none');
                $('#backBtn').addClass('d-none');
                $('#finalSubmitBtn').addClass('d-none');
                $('#otpModalLabel').addClass('d-none');
                $('.otpView').addClass('d-none');
            });




            $('#otpViewBtn').on('click', function () {

                var applicant_mobile    = $('#applicant_mobile').val();
                $.ajax({
                    url: '{{url("petitionOtpView")}}',
                    data:{applicant_mobile:applicant_mobile},
                    type: "GET",
                    dataType: "json",

                    success: function (response) {
                        $('#otpView').html(response.data.otp_number)
                        
                    }
                })
                
            });




            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });

            $('#petitionCreateForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('petitionInsert')}}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .then(function(response) {
                    if (response == 1) {
                        $('#petitionModal').modal('hide');
                        Swal.fire({
                            text: 'পিটিশন আবেদন জমা দেওয়ার জন্য আপনাকে ধন্যবাদ। সিস্টেম হতে আবেদনের সর্বশেষ অবস্থা জানতে এন আই ডি নম্বর ও মোবাইল নম্বর ব্যাবহার করুন।',
                            type: 'success'
                        }).then((result) => {
                            location.replace("{{url('/petition/welcome')}}");
                        });
                    } else {
                        Swal.fire('Error!!!', '', 'error');
                    }
                })
                .catch(function(error) {
                    Swal.fire('Error!!!', '', 'error');
                });
            });

            $('#division_id_0').on('change', function () {
                var division_id = $(this).val();
 
                $('#district_id_0').empty();
                $('#district_id_0').append('<option value="">@lang('Select District')</option>');

                $.ajax({
                    url: '{{url("districtByDivision")}}',
                    data:{division_id:division_id},
                    type: "GET",
                    dataType: "json",
                    success: function (result) {
                        $.each(result.data, function (k, val) {
                            '<?php if(session()->get('language') =='bn'){ ?>'
                            $('#district_id_0').append('<option value="' + val.id + '">' + val.bn_name + '</option>');
                            '<?php }else{ ?>'
                            $('#district_id_0').append('<option value="' + val.id + '">' + val.name + '</option>');
                            '<?php } ?>'
                        });
                    }
                });

            });

            $('#district_id_0').on('change', function () {
                var district_id = $(this).val();

                $('#upazila_id_0').empty();
                $('#upazila_id_0').append('<option value="">@lang('Select Upazila')</option>');

                $.ajax({
                    url: '{{url("upazilaByDistric")}}',
                    data:{district_id:district_id},
                    type: "GET",
                    dataType: "json",
                    success: function (result) {
                        $.each(result.data, function (k, val) {
                            '<?php if(session()->get('language') =='bn'){ ?>'
                            $('#upazila_id_0').append('<option value="' + val.id + '">' + val.bn_name + '</option>');
                            '<?php }else{ ?>'
                            $('#upazila_id_0').append('<option value="' + val.id + '">' + val.name + '</option>');
                            '<?php } ?>'
                        });
                    }
                });

            });

            var incrementValue = 1;

            $('select[id="division_id_'+incrementValue+'"]').on('change', function () {
                var division_id = $(this).val();
 

                $('select[id="district_id_'+incrementValue+'"]').empty();
                $('select[id="district_id_'+incrementValue+'"]').append('<option value="">@lang('Select District')</option>');


                $.ajax({
                    url: '{{url("districtByDivision")}}',
                    data:{division_id:division_id},
                    type: "GET",
                    dataType: "json",
                    success: function (result) {
                        $.each(result.data, function (k, val) {
                            '<?php if(session()->get('language') =='bn'){ ?>'
                            $('select[id="district_id_'+incrementValue+'"]').append('<option value="' + val.id + '">' + val.bn_name + '</option>');
                            '<?php }else{ ?>'
                            $('select[id="district_id_'+incrementValue+'"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                            '<?php } ?>'
                        });
                    }
                });

            });

            $('select[id="district_id_'+incrementValue+'"]').on('change', function () {
                var district_id = $(this).val();

                $('select[id="upazila_id_'+incrementValue+'"]').empty();
                $('select[id="upazila_id_'+incrementValue+'"]').append('<option value="">@lang('Select Upazila')</option>');


                $.ajax({
                    url: '{{url("upazilaByDistric")}}',
                    data:{district_id:district_id},
                    type: "GET",
                    dataType: "json",
                    success: function (result) {
                        $.each(result.data, function (k, val) {
                            '<?php if(session()->get('language') =='bn'){ ?>'
                            $('select[id="upazila_id_'+incrementValue+'"]').append('<option value="' + val.id + '">' + val.bn_name + '</option>');
                            '<?php }else{ ?>'
                            $('select[id="upazila_id_'+incrementValue+'"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                            '<?php } ?>'
                        });
                    }
                });


            });

            //Add Applicant
            $('.addApplicant').click(function(){

                incrementValue++;

                var loadMember = '<div class="row mb-3 applicantRow"><div class="col-sm-11 ml-2 p-3" style="background: #f7f7f7"><div class="row"><div class="col-sm-12 col-md-6 col-lg-6"><div class="form-group"><div class="input-group"> <input type="text" id="multi_name_'+incrementValue+'" class="form-control @error("multi_name") is-invalid @enderror" name="applicant_list[name][]" value="{{old("multi_name")}}" placeholder="@lang("আবেদনকারীর নাম লিখুন")" /></div>@error("multi_name") <span class="text-danger">{{ $message }}</span> @enderror</div></div><div class="col-sm-12 col-md-6 col-lg-6"><div class="form-group"><div class="input-group"> <input type="text" class="form-control @error("signature") is-invalid @enderror" name="applicant_list[signature][]" id="signature_'+incrementValue+'" value="{{old("signature")}}" placeholder="@lang("স্বাক্ষর")" /></div>@error("signature") <span class="text-danger">{{ $message }}</span> @enderror</div></div><div class="col-sm-12 col-md-3 col-lg-3"><div class="form-group"> <select id="division_id_'+incrementValue+'" name="applicant_list[division][]" class="form-control @error("division_id") is-invalid @enderror select2"><option value="">@lang("Select Division")</option> @foreach ($divisions as $data) @if($data["id"]==old("division_id"))<option selected value="{{$data["id"]}}"> @if(session()->get("language") =="bn") {{$data["bn_name"]}} @else {{$data["name"]}} @endif</option> @else<option value="{{$data["id"]}}"> @if(session()->get("language") =="bn") {{$data["bn_name"]}} @else {{$data["name"]}} @endif</option> @endif @endforeach </select>@error("division_id") <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror</div></div><div class="col-sm-12 col-md-3 col-lg-3"><div class="form-group"> <select id="district_id_'+incrementValue+'" name="applicant_list[district][]" class="form-control @error("district_id") is-invalid @enderror select2"><option value="">@lang("Select District")</option> </select>@error("district_id") <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror</div></div><div class="col-sm-12 col-md-3 col-lg-3"><div class="form-group"> <select id="upazila_id_'+incrementValue+'" name="applicant_list[upazila][]" class="form-control @error("upazila_id") is-invalid @enderror select2"><option value="">@lang("Select Upazila")</option></select>@error("upazila_id") <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror</div></div><div class="col-sm-12 col-md-3 col-lg-3"><div class="form-group"><div class="input-group"> <input type="text" class="form-control @error("union") is-invalid @enderror" name="applicant_list[union][]" id="union_'+incrementValue+'" value="{{old("union")}}" placeholder="@lang("ইউনিয়ন লিখুন")" /></div>@error("union") <span class="text-danger">{{ $message }}</span> @enderror</div></div><div class="col-sm-12 col-md-12 col-lg-12"><div class="form-group"><textarea id="more_address_'+incrementValue+'" name="applicant_list[more_address][]" class="form-control @error("more_address") is-invalid @enderror" placeholder="@lang("আরো লিখুন")"> {{old("more_address")}} </textarea>@error("more_address") <span class="text-danger">{{ $message }}</span> @enderror</div></div></div></div><div class="col-sm-1" style="display: contents;"> <button type="button" class="btn btn-danger removeApplicant btn-lg"> <i class="fa fa-times"> </i> </button></div></div>';

                $('#applicant').append(loadMember);

                $(".select2").select2({});

                $('select[id="division_id_'+incrementValue+'"]').on('change', function () {
                    var division_id = $(this).val();
    

                    $('select[id="district_id_'+incrementValue+'"]').empty();
                    $('select[id="district_id_'+incrementValue+'"]').append('<option value="">@lang('Select District')</option>');

                    $.ajax({
                        url: '{{url("districtByDivision")}}',
                        data:{division_id:division_id},
                        type: "GET",
                        dataType: "json",
                        success: function (result) {
                            $.each(result.data, function (k, val) {
                                '<?php if(session()->get('language') =='bn'){ ?>'
                                $('select[id="district_id_'+incrementValue+'"]').append('<option value="' + val.id + '">' + val.bn_name + '</option>');
                                '<?php }else{ ?>'
                                $('select[id="district_id_'+incrementValue+'"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                                '<?php } ?>'
                            });
                        }
                    });


                });

                $('select[id="district_id_'+incrementValue+'"]').on('change', function () {
                    var district_id = $(this).val();

                    $('select[id="upazila_id_'+incrementValue+'"]').empty();
                    $('select[id="upazila_id_'+incrementValue+'"]').append('<option value="">@lang('Select Upazila')</option>');


                    $.ajax({
                        url: '{{url("upazilaByDistric")}}',
                        data:{district_id:district_id},
                        type: "GET",
                        dataType: "json",
                        success: function (result) {
                            $.each(result.data, function (k, val) {
                                '<?php if(session()->get('language') =='bn'){ ?>'
                                $('select[id="upazila_id_'+incrementValue+'"]').append('<option value="' + val.id + '">' + val.bn_name + '</option>');
                                '<?php }else{ ?>'
                                $('select[id="upazila_id_'+incrementValue+'"]').append('<option value="' + val.id + '">' + val.name + '</option>');
                                '<?php } ?>'
                            });
                        }
                    });

                });
            });

            //Remove Applicant
            $(document).on("click", ".removeApplicant", function() {
                $(this).closest('.applicantRow').remove();
            });


            $('#applicant_division_id').on('change', function () {
                var division_id = $(this).val();

                $('#applicant_district_id').empty();
                $('#applicant_district_id').append('<option value="">@lang('Select District')</option>');

                $.ajax({
                    url: '{{url("districtByDivision")}}',
                    data:{division_id:division_id},
                    type: "GET",
                    dataType: "json",
                    success: function (result) {
                        $.each(result.data, function (k, val) {
                            '<?php if(session()->get('language') =='bn'){ ?>'
                            $('#applicant_district_id').append('<option value="' + val.id + '">' + val.bn_name + '</option>');
                            '<?php }else{ ?>'
                            $('#applicant_district_id').append('<option value="' + val.id + '">' + val.name + '</option>');
                            '<?php } ?>'
                        });
                    }
                });

            });

            $('#applicant_district_id').on('change', function () {
                var district_id = $(this).val();

                $('#applicant_upazila_id').empty();
                $('#applicant_upazila_id').append('<option value="">@lang('Select Upazila')</option>');

                $.ajax({
                    url: '{{url("upazilaByDistric")}}',
                    data:{district_id:district_id},
                    type: "GET",
                    dataType: "json",
                    success: function (result) {
                        $.each(result.data, function (k, val) {
                            '<?php if(session()->get('language') =='bn'){ ?>'
                            $('#applicant_upazila_id').append('<option value="' + val.id + '">' + val.bn_name + '</option>');
                            '<?php }else{ ?>'
                            $('#applicant_upazila_id').append('<option value="' + val.id + '">' + val.name + '</option>');
                            '<?php } ?>'
                        });
                    }
                });

            });

        });

    </script>

    @endsection


    