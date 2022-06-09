@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Block Or Office Room SetUp')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.accommodation-management.setup.office_rooms.index') }}">@lang('Office Room')</a></li>
                        <li class="breadcrumb-item active">@lang('Block Or Office Room SetUp')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
{{-- {{ dd($totalOfficeRoom) }} --}}
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header text-right">
                            <a href="{{route('admin.accommodation-management.setup.office_rooms.create')}}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> @lang('Add Office Room')</a>
                        </div>
                        <div class="card-body">
                            <table id="dataTable" class="table table-sm table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="8%">@lang('Serial')</th>
                                    <th>@lang('Building Name')</th>
                                    <th>@lang('Floor Name')</th>
                                    <th>@lang('Total Office Room')</th>
                                    {{-- <th width="10%">@lang('Status')</th> --}}
                                    <th width="10%" class="text-center">@lang('Action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i=1;
                                    $j=0;
                                @endphp
                                @foreach($data as $list)
                                {{-- {{ dd($list->hb_id) }} --}}
                                    <tr>
                                        <td>{{ Lang::get($loop->iteration) }}</td>
                                        <td>{{$list->hb_b_name}}</td>
                                        <td>{{$list->hf_b_name}}</td>
                                        <td>
                                            {{
                                             $fg=   $totalOfficeRoom[$j++]}}
                                        </td>
                                      
                                        {{-- <td>
                                            {!! activeStatus($list->hf_status) !!}
                                        </td> --}}
                                        <td class="text-center">
                                            @if ($fg==0)
                                          @lang('No Office Room Available')
                                        @else
                                        <a class="btn btn-sm btn-success" href="{{route('admin.accommodation-management.setup.office_rooms.edit',$list->hf_id)}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @endif
                                              
                                            {{-- <a class="btn btn-sm btn-danger destroy" data-route="{{route('admin.accommodation-management.setup.office_rooms.destroy', $list->hf_id)}}">
                                                <i class="fa fa-trash"></i>
                                            </a> --}}
                                            
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


