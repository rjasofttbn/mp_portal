@extends('backend.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('MP Book Management')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('MP Book Management')</li>
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

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.profile_activities.mpbooks.index') }}">
                                @csrf
                                <div class="form-row">

                                    <div class="form-group col-sm-2">
                                        <label for="" class="control-label">@lang('Designation')</label>
                                        <select name="designation_id" id="" class="form-control form-control-sm @error('designation_id') is-invalid @enderror">
                                            {!! designationDropdown() !!}
                                        </select>
                                        @error('designation_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group col-sm-2">
                                        <label for="" class="control-label">@lang('Division')</label>
                                        <select name="division_id" id="division_id" class="form-control form-control-sm @error('division_id') is-invalid @enderror">
                                            {!! divisionDropdown() !!}
                                        </select>
                                        @error('division_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group col-sm-2">
                                        <label for="" class="control-label">@lang('District')</label>
                                        <select name="district_id" id="district_id" class="form-control form-control-sm @error('district_id') is-invalid @enderror">
                                            <option value="">@lang('Select District')</option>
                                        </select>
                                        @error('district_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-sm-2">
                                        <label for="" class="control-label">@lang('Constituency')</label>
                                        <select name="constituency_id" id="constituency_id" class="form-control form-control-sm @error('constituency_id') is-invalid @enderror">
                                            <option value="">@lang('Select Constituency')</option>
                                        </select>
                                        @error('constituency_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-sm-2">
                                        <label for="" class="control-label">@lang('Search by Name')</label>
                                        <input type="text" name="search_by" class="form-control form-control-sm @error('search_by') is-invalid @enderror" placeholder="@lang('Enter Name')">

                                        @error('search_by')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-sm-2 mt-4">
                                        <button type="submit" class="btn btn-success btn-sm mt-2 px-4">@lang('Search')</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    @if(isset($data))
                        <div class="card-body">
                            <table id="dataTable" class="table table-sm table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="5%">@lang('Serial')</th>
                                    <th width="20%">@lang('Name and Rank')</th>

                                    <th width="15%">@lang('PABX No.')</th>
                                    <th width="15%">@lang('Official Telephone')</th>
                                    <th width="15%">@lang('Residential Telephone')</th>

                                    <th width="15%">@lang('Official Address')</th>
                                    <th width="15%">@lang('Residential Address')</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($data as $list)

                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>Mr/Mrs. {{$list->name_eng}} <br/>( {{$list->designation->name}} )</td>

                                        <td>{{$list->pabx_no}}</td>
                                        <td>{{$list->official_phone}}</td>
                                        <td>{{$list->residential_phone}}</td>

                                        <td>{{$list->office_address}}</td>
                                        <td>{{$list->residential_address}}</td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    @endif
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!--/. container-fluid -->
    </section>
    

@endsection

@push('page_scripts')
    @include('backend.includes.location_scripts')
@endpush
