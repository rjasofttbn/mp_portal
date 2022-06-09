@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('High Official Application Management')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.accommodation.hostel_application.index') }}">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('High Official Application Management')</li>
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
                   
                    <h4><u>@lang('Application Information')</u></h4>
                    <p>
                        <Ul style=" line-height: 40px; font-size: 15px; list-style-type: circle;">
                           <b>@lang('Application Type') : </b> {{$data['na'][0]->subject}}</br>
                           <b>@lang('Selected Date') : </b> {{
                            date('d-m-Y', strtotime($data['na'][0]->date))
                            }}</br>
                           
                          <b>@lang('Cancel Reason') : </b> {{$data['na'][0]->description}}
                        </Ul>
                </p>
                </div>
                </div>               
    </div>
    @endsection
    @section('script')
    <script>
        $(function() {
            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'YYYY-MM-DD',
            });
        })
    </script>
    @endsection

