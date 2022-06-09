@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Standing Committee')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Standing Committee')</li>
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
                            <a href="{{route('admin.master_setup.standing_committees.create') }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> @lang('Create Committee')</a>
                        </div>
                        <div class="card-body">
                            <table id="dataTable" class="table table-sm table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('Serial')</th>
                                    <th>@lang('Member Name')</th>
                                    <th>@lang('Designations')</th>
                                    <th>@lang('Parliament')</th>
                                    <th width="10%">@lang('Ministry')</th>
                                    <th>@lang('Date From')</th>
                                    <th>@lang('Date To')</th>
                                    <th width="5%">@lang('Status')</th>
                                    <th width="10%" class="text-center">@lang('Action')</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach ($committees as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @php 
                                                $committeeList = json_decode($data->user_id, true);
                                                for($i=0; $i<count($committeeList); $i++){
                                                    foreach($profiles as $d){
                                                        if($committeeList[$i]==$d->user_id){
                                                            if(session()->get('language') =='bn'){
                                                                echo '('.Lang::get($i+1).') ' .$d->name_bn.'<br>';
                                                            }else{
                                                                echo '('.Lang::get($i+1).') ' .$d->name_eng.'<br>';
                                                            }
                                                        }
                                                    }
                                                }
                                                @endphp
                                            </td>
                                            <td>
                                                @php 
                                                $designationList = json_decode($data->designation, true);
                                               
                                                    foreach($designationList as $designation){
                                                        echo Lang::get($designation).'<br>';
                                                    }
                                       
                                                @endphp
                                            </td>

                                            <td>{{ Lang::get($data->parliamentInfo->parliament_number) }}</td>
                                            <td>
                                                @if(session()->get('language') =='bn')
                                                {{ $data->ministryInfo->name_bn }}
                                                @else
                                                {{ $data->ministryInfo->name }}
                                                @endif
                                            </td>
                                            <td>{{ digitDateLang(date('d F Y', strtotime($data->date_from))) }}</td>
                                            <td>{{ digitDateLang(date('d F Y', strtotime($data->date_to))) }}</td>

                                            <td>{!! activeStatus($data->status) !!}</td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-info" href="{{route('admin.master_setup.standing_committees.edit', $data->id)}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-sm btn-danger destroy"
                                                data-route="{{route('admin.master_setup.standing_committees.destroy' , $data->id)}}">
                                                    <i class="fa fa-trash"></i>
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


@endsection