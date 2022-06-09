@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
   <!-- Content Header (Page header) -->
   <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="m-0 text-dark">@lang('Furniture/Electrical Goods Package Managment')</h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.accommodation-asset-management.setup.accommodation-asset-package.index') }}">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Furniture/Electrical Goods Package Managment')</li>
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
                                <a href="{{ route('admin.accommodation-asset-management.setup.accommodation-asset-package.create') }}"
                                    class="btn btn-sm btn-info"><i class="fas fa-plus"></i> @lang('Furniture/Electrical Goods Package Add')</a>
                            </div>
                            <div class="card-header">
                                <h5>@lang('Furniture/Electrical Goods Package List')</h5>
                            </div> 
                        <div class="card-body">
                            <table id="dataTable" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="8%">@lang('Serial')</th>                                       
                                        <th>@lang('Accommodation Type')</th>
                                        <th>@lang('Accommodation Size')</th>
                                        <th>@lang('Furniture/Goods Type')</th>
                                        <th>@lang('Furniture/Goods Name')</th>
                                        <th width="10%">@lang('Total No.')</th>
                                        <th width="10%" class="text-center">@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($acc_ass_pack as $data)
                                        <tr>
                                            <td>{{ Lang::get($loop->iteration) }}</td>
                                            <td> 
                                                @foreach ($acc_type_list as $list)
                                                @if($list['id']==$data->accommodation_type_id or $list['id']==old('accommodation_type_id'))
                                                    @if (session()->get('language') =='bn')
                                                    {{$list->name_bn}}
                                                    @else
                                                         {{$list->name}}
                                                   @endif
                                                @endif
                                            @endforeach
                                            </td>
                                            <td> 
                                                @foreach ($flat_type_list as $list)
                                                    @if($list['id']==$data->flat_type_id or $list['id']==old('flat_type_id'))
                                                    @if (session()->get('language') =='bn')
                                                     {{$list->name_bn}}
                                                    @else
                                                         {{$list->name}}
                                                   @endif
                                                   
                                                    @endif
                                                @endforeach
                                            </td>

                                            <td>
                                                @php 
                                                $asspackList = json_decode($data->accommodation_asset_type_id, true);
                                                for($i=0; $i<count($asspackList); $i++){
                                                    foreach($acc_ass_type_list as $d){
                                                        if($asspackList[$i]==$d->id){
                                                                if(session()->get('language') =='bn'){
                                                                echo $d->name_bn.'<hr>';
                                                            }else{
                                                                echo $d->name.'<hr>';
                                                            }
                                                        }
                                                    }
                                                }
                                                @endphp
                                            </td>
                                            <td>
                                                @php 
                                                $asspackList = json_decode($data->accommodation_asset_id, true);
                                                for($i=0; $i<count($asspackList); $i++){
                                                    
                                                    foreach($acc_ass_list as $d){
                                                      
                                                            if($asspackList[$i]==$d->id){
                                                            if(session()->get('language') =='bn'){
                                                                echo $d->name_bn.'<hr>';
                                                            }else{
                                                                echo $d->name.'<hr>';
                                                            }
                                                        }
                                                    }
                                                }
                                                @endphp
                                            </td>
                                            <td>
                                                @php 
                                                $asspackList = json_decode($data->total_no, true);
                                                    foreach($asspackList as $d){
                                                        echo Lang::get($d).'<hr>';
                                                    }
                                                
                                                @endphp
                                            </td>
                                           
                                            <td class="text-center">
                                                {{-- {{ dd($data['id']) }} --}}
                                                <a class="btn btn-sm btn-success"
                                                    href="{{ route('admin.accommodation-asset-management.setup.accommodation-asset-package.edit',$data['id']) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-sm btn-danger destroy"
                                                    data-route="{{ route('admin.accommodation-asset-management.setup.accommodation-asset-package.destroy',$data['id']) }}">
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
