@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">@lang('Furniture/Electrical Goods Managment')</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.accommodation-asset-management.setup.furniture_electronic_goods.index') }}">@lang('Home')</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('Furniture/Electrical Goods Add')</li>
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
                            <a href="{{ route('admin.accommodation-asset-management.setup.furniture_electronic_goods.create') }}"
                                class="btn btn-sm btn-info"><i class="fas fa-plus"></i> @lang('Furniture/Electrical Goods Add')</a>
                        </div>

                        <div class="card-body">
                            {{-- <div class="card"> --}}
                            <div class=" text-left">
                                <h5>@lang('Search Criteria')</h5>
                            </div>
                            {{-- </div> --}}
                            <form id="areaForm" name="areaForm" method="get"
                                action="{{ route('admin.accommodation-asset-management.setup.furniture_electronic_goods.index') }}">

                                @csrf
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <select id="accommodation_type_id" name="accommodation_type_id"
                                                class="form-control form-control-sm @error('accommodation_type_id') is-invalid @enderror accommodation_type_id">
                                                <option value="">@lang('Select Accommodation Type')</option>
                                                @foreach ($acc_type_list as $list)

                                                    <option value="{{ $list['id'] }}" {{(request()->accommodation_type_id == $list['id'])?('selected'):''}}>
                                                        @if (session()->get('language') == 'bn')
                                                            {{ $list['name_bn'] }}
                                                        @else
                                                            {{ $list['name'] }}
                                                        @endif
                                                    </option>

                                                @endforeach
                                            </select>
                                            @error('accommodation_type_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <select id="accommodation_building_id" name="accommodation_building_id"
                                                class="form-control form-control-sm @error('accommodation_building_id') is-invalid @enderror accommodation_building_id">
                                                <option value="">@lang('Select Building/High Accommodation')</option>
                                                @foreach ($acc_buil_list as $list)

                                                    <option value="{{ $list['id'] }}" {{(request()->accommodation_building_id == $list['id'])?('selected'):''}}>
                                                        @if (session()->get('language') == 'bn')
                                                            {{ $list['name_bn'] }}
                                                        @else
                                                            {{ $list['name'] }}
                                                        @endif
                                                    </option>

                                                @endforeach
                                            </select>
                                            @error('accommodation_building_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <select id="accommodation_asset_type_id" name="accommodation_asset_type_id"
                                                class="form-control form-control-sm @error('accommodation_asset_type_id') is-invalid @enderror accommodation_asset_type_id">
                                                <option value="">@lang('Select Furniture/Electrical Goods Type')</option>
                                                @foreach ($acc_ass_type_list as $list)

                                                    <option value="{{ $list['id'] }}" {{(request()->accommodation_asset_type_id == $list['id'])?('selected'):''}}>
                                                        @if (session()->get('language') == 'bn')
                                                            {{ $list['name_bn'] }}
                                                        @else
                                                            {{ $list['name'] }}
                                                        @endif
                                                    </option>

                                                @endforeach
                                            </select>
                                            @error('accommodation_asset_type_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

{{-- {{ dd($acc_ass) }} --}}
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <select id="accommodation_asset_id" name="accommodation_asset_id"
                                                class="form-control form-control-sm @error('accommodation_asset_id') is-invalid @enderror accommodation_asset_id">
                                                <option value="">@lang('Select Furniture/Electrical Goods Name')</option>
                                                @foreach ($acc_ass as $list)

                                                    <option value="{{ $list['id'] }}" {{(request()->accommodation_asset_id == $list['id'])?('selected'):''}}>
                                                        @if (session()->get('language') == 'bn')
                                                            {{ $list['name_bn'] }}
                                                        @else
                                                            {{ $list['name'] }}
                                                        @endif
                                                    </option>

                                                @endforeach
                                            </select>
                                            @error('accommodation_asset_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-2">
                                <div class="form-group">
                         <button type="submit" class="btn btn-success btn-sm">@lang('Find')</button>
                        </div>
                        </div> --}}

                                </div>
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-sm">@lang('Find')</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header text-left">
                            <h5>@lang('Furniture/Electrical Goods List')</h5>
                        </div>
                        {{-- {{ dd($data) }} --}}
                        <div class="card-body">
                            <table id="dataTable" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="8%">@lang('Serial')</th>
                                        <th>@lang('Area Name')</th>
                                        <th>@lang('Accommodation Type')</th>
                                        <th>@lang('Building Name')</th>
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
                                    @foreach ($furniture_electronic_goods as $list)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ @$list['area']['name_bn'] }}</td>
                                            <td>{{ @$list['accommodation_type']['name_bn'] }}</td>
                                            <td>{{ @$list['accommodation_building']['name_bn'] }}</td>
                                            <td>{{ @$list['accommodation_asset_type']['name_bn'] }}</td>
                                            <td>{{ @$list['accommodation_asset']['name_bn'] }}</td>
                                            <td>
                                                {{ @$list->total_no }}
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-success"
                                                    href="{{ route('admin.accommodation-asset-management.setup.furniture_electronic_goods.edit', $list->id) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a class="btn btn-sm btn-danger destroy"
                                                    data-route="{{ route('admin.accommodation-asset-management.setup.furniture_electronic_goods.destroy', $list->id) }}">
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
    <script>
        $(document).ready(function () {

            // Author M. Atoar Rahman: Ceated date: 24-01-2021
            // Get District List By Division Id:

            $('select[name="accommodation_asset_type_id"]').on('change', function () {
                var accommodation_asset_type_id = $(this).val();

                $('select[name="accommodation_asset_id"]').empty();
                $('select[name="accommodation_asset_id"]').append('<option value="">@lang('Select Furniture/Electrical Goods Name')</option>');


                if (accommodation_asset_type_id > 0) {
                    $.ajax({
                        url: '{{url("assListByAccAssTypeId")}}',
                        data:{accommodation_asset_type_id:accommodation_asset_type_id},
                        type: "GET",
                        dataType: "json",
                        beforeSend: function () {
                            //$('#loader').css("visibility", "visible");
                        },
                        success: function (result) {
                            $.each(result.data, function (k, val) {
                                '<?php if(session()->get('language') =='bn'){ ?>'
                                $('select[name="accommodation_asset_id"]').append('<option value="' + val.id + '">' + val.name_bn + '</option>');
                                '<?php }else{ ?>'
                                $('select[name="accommodation_asset_id"]').append('<option value="' + val.id + '">' + val.name_bn + '</option>');
                                '<?php } ?>'
                            });
                        },
                        complete: function () {
                            //$('#loader').css("visibility", "hidden");
                        }
                    });
                } else {
                    $('select[name="accommodation_asset_id"]').empty();
                    $('select[name="accommodation_asset_id"]').append('<option value="">@lang('Select Furniture/Electrical Goods Name')</option>');
                }
            });

        });

        
    </script>
@endsection
