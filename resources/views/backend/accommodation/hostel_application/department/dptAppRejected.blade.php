@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Manage Accommodation Rejected Application (Hostel)')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.accommodation.hostel_application.index') }}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Manage Accommodation Application (Hostel)')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @if (!empty($acc_app)) 
                    <div class="card">
                        {{-- <div class="card-header text-right">
                            <a href="{{route('admin.accommodation.hostel_application.index') }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> @lang('Add Application')</a>
                        </div> --}}
                        <div class="card-body">
                            <table id="dataTable" class="table table-sm table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('Serial')</th>                    
                                    <th>@lang('Subject')</th>
                                    <th>@lang('Date')</th>                   
                                    <th>@lang('Status')</th>
                                  
                                </tr>
                                </thead>
                                <tbody>                   
                                    @php
                                    $i=1;
                                    $at = '2';
                                @endphp
                                @foreach($acc_app as $list)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$list->subject}}</td>
                                        <td>{{$list->created_at}}</td>
                                        <td>@if($list->status==2)
                                            Rejected                        
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach   
                                </tbody>
                                </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    @else
                    <div class="card"style="margin-top: 171px; text-align:center;">
                      <div class="card-body">
                      <h3 style="color: red;">@lang('There is no data available.')</h3>
                  </div>
              </div>
              @endif 
                </div>
            </div>
        </div>
        <!--/. container-fluid -->
    </section>
@endsection




