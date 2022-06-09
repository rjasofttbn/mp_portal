@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Profile Management') </h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Profile Management')</li>
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

                <h4 class="card-title w-100">
                    @if(session()->get('language') =='bn')
                    {{ isset($editData) ? $editData->name_bn : __('Parliament Member Information') }}
                    @else
                    {{ isset($editData) ? $editData->name_eng : __('Parliament Member Information') }}
                    @endif
                    <a href="{{ route('admin.profile_activities.profiles.index') }}" class="btn btn-info float-right"><i class="fa fa-list mr-2"></i> @lang('Parliament Member List')</a>
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ isset($editData) ? route('admin.profile_activities.profiles.update',$editData->id) : route('admin.profile_activities.profiles.store') }}">
                    @csrf
                    @if (isset($editData))
                    @method('PUT')
                    @endif
                    <div class="form-row">
                        <div class="form-group col-sm-12 text-center">
                            <h5>@lang('User Information')</h5>
                            <hr>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Email')</label>
                            <input type="text" required name="email" value="{{ $editData['userInfo']->email ?? old('email') }}" class="form-control form-control-sm @error('email') is-invalid @enderror" placeholder="@lang('Enter Email')">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Password') <small> {{ isset($editData) ? __('(You can ignore password)') : '' }}</small></label>
                            <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" {{ isset($editData) ? '' : 'required' }} autocomplete="new-password" placeholder="@lang('Enter Password')">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Confirm Password')</label>
                            <input id="password-confirm" type="password" class="form-control form-control-sm" name="password_confirmation" {{ isset($editData) ? '' : 'required' }} autocomplete="new-password" placeholder="@lang('Enter Password Again')">
                        </div>
                        <div class="form-group col-sm-12 text-center">
                            <h5>@lang('Personal Information')</h5>
                            <hr>
                        </div>

                        <div class="form-group col-sm-12">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="" class="control-label ">@lang('ID No.')</label>
                                    <select name="" id="" class='form-control select2'>
                                        <option value="">@lang('Select Your ID')</option>
                                        <option value="">1234567</option>
                                        <option value="">1234567</option>
                                        <option value="">1234567</option>
                                        <option value="">1234567</option>
                                        <option value="">1234567</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4 mt-4">
                                    <input type="submit" name="submit" value="@lang('Add Your Information')" class="btn btn-success btn-sm mt-1">
                                    
                                </div>
                            </div>
                            <hr>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Name (Bangla)')</label>
                            <input type="text" required  name="name_bn" value="{{ $editData->name_bn ?? old('name_bn') }}" class="form-control form-control-sm @error('name_bn') is-invalid @enderror" placeholder="@lang('Enter Name in Bangla')">
                            @error('name_bn')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Name (English)')</label>
                            <input type="text"  required name="name_eng" value="{{ $editData->name_eng ?? old('name_eng') }}" class="form-control form-control-sm @error('name_eng') is-invalid @enderror" placeholder="@lang('Enter Name in English')">
                            @error('name_eng')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang("Father's Name")</label>
                            <input type="text" required  name="father_name" value="{{ $editData->father_name ?? old('father_name') }}" class="form-control form-control-sm @error('father_name') is-invalid @enderror" placeholder='@lang("Enter Father' s Name")'>
                            @error('father_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang("Mother's Name")</label>
                            <input type="text" required  name="mother_name" value="{{ $editData->mother_name ?? old('mother_name') }}" class="form-control form-control-sm @error('mother_name') is-invalid @enderror" placeholder='@lang("Enter Mother' s Name")'>
                            @error('mother_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Marital Status')</label>
                            <select name="merital_status" id="" class="form-control form-control-sm select2">
                                {!! maritalStatusDropdown($editData->merital_status ?? '') !!}
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Spouse Name (Bangla)')</label>
                            <input type="text" value="{{ $editData->spouse_name_bn ?? '' }}" name="spouse_name_bn"  class="form-control form-control-sm @error('spouse_name_bn') is-invalid @enderror" placeholder="@lang('Enter Spouse Name in Bangla')">
                            @error('spouse_name_bn')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Spouse Name (English)')</label>
                            <input type="text" value="{{ $editData->spouse_name_eng ?? '' }}" name="spouse_name_eng" class="form-control form-control-sm @error('spouse_name_eng') is-invalid @enderror" placeholder="@lang('Enter Spouse Name in English')">
                            @error('spouse_name_eng')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Spouse Date of Birth')</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control form-control-sm datetimepicker-input @error('spouse_dob') is-invalid @enderror" name="spouse_dob" id="datepicker" value="{{ $editData->spouse_dob ?? old('spouse_dob') }}" placeholder="@lang('Select Date')" data-target="#reservationdate" />
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>

                            {{-- <input type="text" value="{{ $editData->spouse_dob ?? '' }}" name="spouse_dob" class="form-control form-control-sm @error('spouse_dob') is-invalid @enderror" placeholder="@lang('Enter Spouse Date of Birth') "> --}}

                            @error('spouse_dob')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('NID')</label>
                            <input type="text" required value="{{ $editData->nid_no ?? old('nid_no') }}" name="nid_no" class="form-control form-control-sm @error('nid_no') is-invalid @enderror" placeholder="@lang('Enter NID No.') ">
                            @error('nid_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Spouse NID')</label>
                            <input type="text" value="{{ $editData->spouse_nid_no ?? '' }}" name="spouse_nid_no" class="form-control form-control-sm @error('spouse_nid_no') is-invalid @enderror" placeholder="@lang('Enter Spouse NID No.')">
                            @error('spouse_nid_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Religion')</label>
                            <select name="religion" id="religion" class="form-control form-control-sm select2">
                                {!! religionDropdown($editData->religion ?? '') !!}
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('PABX Number')</label>
                            <input type="text" value="{{ $editData->pabx_no ?? '' }}" name="pabx_no" class="form-control form-control-sm @error('pabx_no') is-invalid @enderror" placeholder="@lang('Enter PABX Number')">
                            @error('pabx_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Official Phone')</label>
                            <input type="text" value="{{ $editData->official_phone ?? '' }}" name="official_phone" class="form-control form-control-sm @error('official_phone') is-invalid @enderror" placeholder="@lang('Enter Official Phone No.')">
                            @error('official_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Residential Phone')</label>
                            <input type="text" value="{{ $editData->residential_phone ?? '' }}" name="residential_phone" class="form-control form-control-sm @error('residential_phone') is-invalid @enderror" placeholder="@lang('Enter Residential Phone No.')">
                            @error('residential_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Office Address')</label>
                            <textarea name="office_address" class="form-control form-control-sm @error('office_address') is-invalid @enderror" placeholder="@lang('Enter Office Address')">{{ $editData->office_address ?? '' }}</textarea>
                            @error('office_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Present Address')</label>
                            <textarea name="residential_address" class="form-control form-control-sm @error('residential_address') is-invalid @enderror" placeholder="@lang('Enter Present Address')">{{ $editData->residential_address ?? '' }}</textarea>
                            @error('residential_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Permanent Address')</label>
                            <textarea name="parmanent_address" class="form-control form-control-sm @error('parmanent_address') is-invalid @enderror" placeholder="@lang('Enter Permanent Address')">{{ $editData->parmanent_address ?? '' }}</textarea>
                            @error('parmanent_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Ministry')</label>
                            <select name="ministry_id" id="ministry_id" class="form-control form-control-sm select2 @error('ministry_id') is-invalid @enderror">
                                {!! ministryDropdown($editData->ministry_id ?? '') !!}
                            </select>
                            @error('ministry_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Designation')</label>
                            <select name="designation_id" id="designation_id" class="form-control form-control-sm select2 @error('designation_id') is-invalid @enderror">
                                {!! designationDropdown($editData->designation_id ?? '') !!}
                            </select>
                            @error('designation_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Parliament')</label>
                            <select name="parliament_id" id="parliament_id" class="form-control form-control-sm select2 @error('parliament_id') is-invalid @enderror">
                                {!! parliamentDropdown($editData->parliament_id ?? '') !!}
                            </select>
                            @error('parliament_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Political Party')</label>
                            <select name="political_parties_id" id="political_parties_id" class="form-control form-control-sm select2 @error('political_parties_id') is-invalid @enderror">
                                {!! politicalPartiesDropdown($editData->political_parties_id ?? '') !!}
                            </select>
                            @error('political_parties_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Birth District')</label>
                            <select name="birth_district_id" id="birth_district_id" class="form-control form-control-sm select2 @error('birth_district_id') is-invalid @enderror">
                                {!! districtDropdown($editData->birth_district_id ?? '') !!}
                            </select>
                            @error('birth_district_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Status')</label>
                            <select name="status" id="status" class="form-control form-control-sm">
                                {!! statusDropdown($editData->status ?? '') !!}
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Division')</label>
                            <select name="division_id" id="division_id" class="form-control form-control-sm select2">
                                {!! divisionDropdown($editData['constituency']->division_id ?? '') !!}
                            </select>
                            @error('dtn')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('District')</label>
                            <select name="district_id" id="district_id" class="form-control form-control-sm select2">
                                <option value="">@lang('Select District')</option>
                            </select>
                            @error('dtn')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="" class="control-label">@lang('Constituency')</label>
                            <select name="constituency_id" id="constituency_id" class="form-control form-control-sm select2 @error('constituency_id') is-invalid @enderror">
                                <option value="">@lang('Select Constituency')</option>
                            </select>
                            @error('constituency_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group col-sm-4 mt-3 mb-5">
                            <button class="btn btn-info"><i class="fa fa-save mr-2"></i> {{ isset($editData) ? __('Update Profile') : __('Save') }} </button>

                            <button class="btn btn-primary"><i class="fa fa-save mr-2"></i>@lang('Save & Send to PRP')</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $(function() {
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD',
        });
    })
</script>
@endsection
@push('page_scripts')
@include('backend.includes.location_scripts')
@endpush