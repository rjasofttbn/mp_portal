@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Allotment Cancel Application')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.accommodation.hostel_application.index') }}">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Allotment Cancel Application')</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="content">
    <div class="col-md-12">
         <div class="card">
            <div class="card-body">
            <p>
                <Ul style=" line-height: 40px; font-size: 15px; list-style-type: square;">
                    <b>@lang('Application Type') : </b> {{ $data['ha'][0]->subject }}<br>
                    <b>@lang('Date') : </b>
                    {{ date('d-m-Y', strtotime($data['ha'][0]->date)) }}<br>
                    <b>@lang('Office Room') : </b> {{ $data['ha'][0]->hostel_ofr_bn }}<br>
                    <b>@lang('Cancel Reason') : </b> {{ $data['ha'][0]->description }}<br>
                    <b>@lang('Application Submited Date') : </b>
                    {{ date('d-m-Y h:i A', strtotime($data['ha'][0]->created_at)) }}<br>
                    <b>@lang('Status') : </b>  
                    @if($data['ha'][0]->status==1)
                                    Pending 
                    @elseif($data['ha'][0]->status==2)
                                    Rejected 
                    @elseif($data['ha'][0]->status==3)
                                    Acceptable
                    @elseif($data['ha'][0]->status==5)
                                    Approved
                    @endif
                </Ul>
            </p>
        </div>
        </div>
    </div>
    </div>
    @endsection
  

