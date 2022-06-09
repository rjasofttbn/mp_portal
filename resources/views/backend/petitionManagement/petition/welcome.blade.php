@extends('backend.petitionManagement.layouts.app')
@section('content')
    <div class="container">
        <div class="row mt-5 pt-5">
            <div class="col-sm-12 m-auto">
                <div class=" p-5 text-center">
                    <h4 class="text-dark">@lang('পিটিশন আবেদন জমা দেওয়ার জন্য আপনাকে ধন্যবাদ।')</h4>
                    <p>সিস্টেম হতে আবেদনের সর্বশেষ অবস্থা জানতে এন আই ডি নম্বর ও মোবাইল নম্বর ব্যাবহার করুন।</p>
                    <a href="{{route('petitionsMonitoring') }}" class="btn btn-success mt-5">পিটিশন মনিটরিং</a>
                </div>
            </div>
        </div>
    </div>
@endsection