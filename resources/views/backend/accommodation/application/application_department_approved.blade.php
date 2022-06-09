

@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Approved Accommodation Applications')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Approved Accommodation Application')</li>
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
                    <div class="card">
                        <div class="card-header text-right">
                        </div>
                        <div class="card-body">
                            <table id="dataTable" class="table table-sm table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('Serial')</th>                    
                                    <th>@lang('Application Type')</th>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Date')</th>                   
                                    <th>@lang('Status')</th>
                                </tr>
                                </thead>
                                <tbody>                   
                                    @php
                                    $i=1;
                                @endphp
                                @foreach($acc_app as $list)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$list->subject}}</td>
                                        <td>{{$list->name_bn}}</td>
                                        <td>{{$list->created_at}}</td>
                                        <td>Approved</td>
                                    </tr>
                                @endforeach   
                                </tbody>
                                </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!--/. container-fluid -->
    </section>
@endsection




