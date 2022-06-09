@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Petition Committee Management')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Petition Committee Management')</li>
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
                            <a href="{{route('admin.petition_management.petition_committees.create') }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> @lang('Create Committee')</a>
                        </div>
                        <div class="card-body">
                            <table id="dataTable" class="table table-sm table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('Serial')</th>
                                    <th>@lang('Parliament No.')</th>
                                    <th>@lang('Member Name')</th>
                                    <th>@lang('Designations')</th>
                                    <th width="5%">@lang('Status')</th>
                                    <th>@lang('Date From')</th>
                                    <th>@lang('Date To')</th>
                                    <th width="5%">@lang('Status')</th>
                                    <th width="10%" class="text-center">@lang('Action')</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach ($committees as $data)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ Lang::get($data->parliamentInfo->parliament_number) }}</td>
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
                                            $designationList = json_decode($data->designation_id, true);
                                            for($i=0; $i<count($designationList); $i++){
                                                foreach($designations as $d){
                                                    if($designationList[$i]==$d->id){
                                                        if(session()->get('language') =='bn'){
                                                            echo '('.Lang::get($i+1).') ' .$d->name_bn.'<br>';
                                                        }else{
                                                            echo '('.Lang::get($i+1).') ' .$d->name.'<br>';
                                                        }
                                                    }
                                                }
                                            }

                                            @endphp
                                        </td>
                                        <td>
                                            @php 
                                            $memberStatusList = json_decode($data->member_status, true);
                                            for($i=0; $i<count($memberStatusList); $i++){
           
                                                if($memberStatusList[$i] == 1){
                                                    echo Lang::get('Active').'<br>';
                                                }elseif ($memberStatusList[$i] == 0) {
                                                    echo Lang::get('Inactive').'<br>';
                                                }
                                            }

                                            @endphp
                                            
                                        </td>
                                        <td>{{ digitDateLang(nanoDateFormat($data->date_from, 'd F Y')) }}</td>
                                        <td>{{ digitDateLang(nanoDateFormat($data->date_to, 'd F Y')) }}</td>
                                        <td class="text-center">{!! activeStatus($data->status) !!}</td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-info" href="{{route('admin.petition_management.petition_committees.edit', $data->id)}}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-sm btn-danger destroy"
                                            data-route="{{route('admin.petition_management.petition_committees.destroy' , $data->id)}}">
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