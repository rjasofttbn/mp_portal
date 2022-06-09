@extends('backend.layouts.app')
@push('page_css')
    @livewireStyles
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('Parliamentary Bill Management')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Parliamentary Bill Management')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title w-100">@lang('Update Parliamentary Bill')
                        <a href="{{ route('admin.master_setup.parliament_bills.index') }}"
                            class="btn btn-info float-right"><i class="fa fa-list mr-2"></i> @lang('Parliamentary Bill list')</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.master_setup.parliament_bills.update', $editData->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="control-label">@lang('Name (English)') <span class="text-danger">*</span></label>
                                <input type="text" name="name"
                                    class="form-control form-control-sm @error('name') is-invalid @enderror"
                                    value="{{ old('name') ?? ($editData->name ?? '') }}" placeholder="@lang('Enter Name in English')">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">@lang('Name (Bangla)') <span class="text-danger">*</span></label>
                                <input type="text" name="name_bn"
                                    class="form-control form-control-sm @error('name_bn') is-invalid @enderror"
                                    value="{{ old('name_bn') ?? ($editData->name_bn ?? '') }}" placeholder="@lang('Enter Name in Bangla')">
                                @error('name_bn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-12">
                                <label class="control-label">@lang('Attachment')  @if ($editData->attachment)
                                    <a href="{{ url('/public/backend/attachment/parliament_bills', $editData->attachment) }}" class="btn btn-sm btn-info" target="_blank">View attachment</a>
                                @endif</label>
                                <input type="file" name="attachment" id="attachment"
                                    class="form-control form-control-sm @error('attachment') is-invalid @enderror"
                                    value="{{ old('attachment') ?? ($editData->attachment ?? '') }}"
                                    placeholder="Write User Email" autocomplete="off">
                                @error('attachment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                <div class="callout callout-info">
                                    <h5> Clause </h5>
                                    <div class="clause-main">
                                       @livewire('parliament-bill.more-clause', ['editData' => $editData])
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-4 mt-auto">
                                <button class="btn btn-sm btn-info"><i class="fa fa-save mr-2"></i> @lang('Update')</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('page_scripts')
    @livewireScripts
    
@endpush