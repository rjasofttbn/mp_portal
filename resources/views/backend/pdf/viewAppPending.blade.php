@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('New Application for Allotment')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.accommodation.hostel_application.index') }}">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Cancel Allotment')</li>
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
                        <Ul style=" line-height: 40px; font-size: 15px; list-style-type: circle;">
                            <h4><u>@lang('Application Information')</u></h4>
                            <b>@lang('Application Type') : </b> {{$data['na'][0]->at_name_bn}}</br>
                           <b>@lang('Selected Date') : </b> {{
                            date('d-m-Y', strtotime($data['na'][0]->date))
                            }}</br>
                           
                                @foreach ($areaList as $lista)
                                @if($lista->id== $data['na'][0]->area_id)
                               <b>@lang('Selected Area') : </b> {{$lista->name_bn}}
                               
                                @endif
                                @endforeach
                        </Ul>
              
                </div>
                </div>
               
                    {{-- <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-secondary btn-sm white-text">
                                    <a href="{{ route('admin.accommodation.applications.index') }}">@lang('Back')</a>
                                </button>
                                @php
                                    $status = $data['na'][0]->status
                                @endphp
                            @if ($status ==0)
                                 <button type="submit"  name="submit"  value="@lang('Submit')"  class="btn btn-success btn-sm">@lang('Submit')</button>
                            @endif
                            </div>
                        </div>
                    </div> --}}
                
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

