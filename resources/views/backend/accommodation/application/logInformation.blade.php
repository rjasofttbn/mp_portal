@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Log Information')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.accommodation.applications.index') }}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Log Information')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="col-md-12">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header text-right">
                            {{-- <a href="{{route('admin.accommodation.applications.index') }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> @lang('Add Application')</a> --}}
                        </div>
                        <div class="card-body">
                            <table id="dataTable" class="table table-sm table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('Serial')</th>                    
                                    <th>@lang('Application Subject')</th>
                                    <th>@lang('Applicant Information')</th>
                                    <th>@lang('Date')</th>                   
                                    <th>@lang('Action')</th>                   
                                </tr>
                                </thead>
                                <tbody>                   
                                    @php
                                    $i=1;
                                    $data='';
                                @endphp
                                @foreach($acc_app as $list)
                                @php
                                 $id = $list->id;
                                    $dat =$list->description;
                                    $requestData1 = json_decode($dat);
                                    $datas = explode(',', $requestData1) ;
                                @endphp  
                               
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$list->subject}}</td>
                                        <td>
                                         @php
                                             $array = array_slice($datas, 0, 2);
                                         @endphp
                                         @foreach($array as $data)
                                        {{$data}};</li>
                                          @endforeach   
                                        </td>
                                        <td>{{
                                        date('d-m-Y h:i A', strtotime($list->created_at))
                                        }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{route('admin.accommodation.applications.logInformationDetail',$id)}}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
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
</div>
 </div>
@endsection




