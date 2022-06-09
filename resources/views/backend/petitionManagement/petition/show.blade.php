@extends('backend.petitionManagement.layouts.app')
@section('content')

<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="d-inline-block float-left pt-2 mb-0">পিটিশন প্রতিবেদন</h5>
                <a class="btn btn-info btn-md d-inline-block float-right" href="{{ url()->previous() }}"><i class="fas fa-backward"></i> @lang('Back')</a>

            </div>
        </div>
        <div class="card">
            <div class="card-body" style="padding: 100px;">
                
                <p class="mt-5">মাননীয় চেয়ারম্যান</p>
                <p>পিটিশন কমিটি </p>
                <p>বাংলাদেশ জাতীয় সংসদ </p>
                <p>গণপ্রজাতন্ত্রী  বাংলাদেশ সমীপেষু। </p>
                

                <p class="my-5"></p>
                <p><strong>আবেদনকারীর (দের) নামঃ</strong> {{ $petitions->applicant_name }}</p>
                <p><strong>পদবিঃ</strong> {{ $petitions->applicant_designation }}</p>
                <p><strong>ঠিকানাঃ</strong> ইউনিয়ন: {{ $petitions->applicant_union }}, 
                    উপজেলা: {{ $petitions->applicantUpazila->bn_name }}, 
                    জেলা: {{ $petitions->applicantDistrict->bn_name }}, 
                    বিভাগ: {{ $petitions->applicantDivision->bn_name }} <br/>
                    {{ $petitions->applicant_more_address }}</p>
               
                <p class="mt-5"><strong>পিটিশনের বিষয়টির সংক্ষিপ্ত বিবরণী</strong></p>
                <p>আরজ এই যে, {{ $petitions->description }}</p>
                
                <p class="mt-5"><strong>আবেদনকারীর (দের) প্রার্থনা</strong></p>
                <p>প্রার্থনা এই যে, {{ $petitions->prayer }}</p>

                <table class="table table-sm table-bordered table-striped mt-5">
                    <thead>
                    <tr>
                        <th width="5%" class="text-center">ক্রমিক</th>
                        <th width="45%" class="text-center">আবেদনকারীর (দের) নাম</th>
                        <th width="50%" class="text-center">ঠিকানা</th>
                    </tr>
                    </thead>
                    <tbody id="petition_table">
                        @foreach ($allData as $data)
                        
                                <tr>
                                    <td>{{ $loop->iteration }} </td>
                                    <td>{{ $data[0] }} </td>
                                    <td>ইউনিয়ন: {{ $data[1] }}, 
                                        উপজেলা: {{ $data[2] }}, <br/>
                                        জেলা: {{ $data[3] }}, 
                                        বিভাগ: {{ $data[4] }}, <br/>
                                        {{ $data[5] }}
                                    </td>
                                </tr>

                        @endforeach
                    </tbody>
                </table>

                {{-- <p class="my-5"><strong>তারিখঃ </strong> {{ date('d F, Y', strtotime($petitions->created_at)) }} </p> --}}
                

                <p class="mt-5"> <strong>উপস্থাপনকারী সংসদ সদস্যের প্রতিস্বাক্ষর </strong></p>
                <p>{{ $petitions->profileInfo->name_bn }} ({{$petitions->profileInfo->constituency->bn_name }})</p>
                
                <p class="mt-5">
                    @if(isset($attachments) && count($attachments) > 0)
                        @foreach($attachments as $file)
                        <a href="{{ asset('public/backend/petition/'.$file->attachment)  }}" target="_blank" class="btn btn-success mr-2">View Attachment - {{ $loop->iteration }}</a>
                        @endforeach
                    @endif
                </p>
            </div>

        </div>

    </div>
</div>



@endsection