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
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>@lang('Create Committee')</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.petition_management.petition_committees.update', $editData->id) }}" enctype="multipart/form-data">
                        @csrf
                        @if (isset($editData))
                        @method('PUT')
                        @endif    
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label class="control-label" for="parliament_id">@lang('1'). @lang('Parliament') <span class="text-danger"> *</span></label>

                                    <select name="parliament_id" id="parliament" class="@error('parliament_id') is-invalid @enderror form-control select2">
                                        <option selected value="{{ $parliaments->id }}">{{ Lang::get($parliaments->parliament_number) }}</option>  

                                    </select>

                                    @error('parliament_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label class="control-label" for="date_from">@lang('2'). @lang('Date From') <span class="text-danger"> *</span></label>

                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text"
                                            class="form-control datetimepicker-input @error('date_from') is-invalid @enderror"
                                            id="date_from"
                                            name="date_from"
                                            value="{{old('date') ?? $editData->date_from ?? '' }}"
                                            placeholder="@lang('Select Date')"
                                            data-target="#reservationdate"/>
                                        <div class="input-group-append" data-target="#reservationdate"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>

                                    @error('date_from')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label class="control-label" for="date_to">@lang('3'). @lang('Date To') <span class="text-danger"> *</span></label>

                                    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                        <input type="text"
                                            class="form-control datetimepicker-input @error('date_to') is-invalid @enderror"
                                            id="date_to"
                                            name="date_to"
                                            value="{{old('date') ?? $editData->date_to ?? '' }}"
                                            placeholder="@lang('Select Date')"
                                            data-target="#reservationdate2"/>
                                        <div class="input-group-append" data-target="#reservationdate2"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>

                                    @error('date_to')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>  
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label class="control-label" for="user_id">@lang('4'). @lang('Petition Committee') <span class="text-danger"> *</span></label>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div id="addMember">
                                        @php  $i = 0;  @endphp
                                        @foreach ($committees as $committee)
                                        <div class="childDiv row mb-2">
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <select id="petition_committee_{{$i}}" name="user_id[]"
                                                class="@error('user_id') is-invalid @enderror form-control form-control-sm petition_committee select2">
                                                    <option value="">@lang('Select the Name')</option>
                                                    @if (isset($profiles) && count($profiles) > 0)
                                                    @foreach ($profiles as $data)
                                                        <option {{ $committee == $data->user_id ? 'selected' : '' }} value="{{ $data->user_id }}">
                                                            @if(session()->get('language') =='bn')
                                                            {{ $data->name_bn }}
                                                            @else
                                                            {{ $data->name_eng }}
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                
                                                @error('user_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <select id="designation_id_{{$i}}" name="designation_id[]"
                                                class="@error('designation_id') is-invalid @enderror form-control form-control-sm designation_id select2">
                                                    <option value="">@lang('Select Designation')</option>
                                                    @foreach ($designations as $data)
                                                        
                                                        <option {{ $designation_ids[$i] == $data->id ? 'selected': '' }} value="{{ $data->id }}">
                                                            @if(session()->get('language') =='bn')
                                                            {{ $data->name_bn }}
                                                            @else
                                                            {{ $data->name_eng }}
                                                            @endif
                                                        </option>
                                                        
                                                    @endforeach
                                                </select>
                                                    
                                                @error('user_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12 col-md-3 col-lg-3">
                                                <select id="member_status_{{$i}}" name="member_status[]" class="form-control form-control-sm member_status select2">
                                                    <option {{ $memberStatus[$i] == 1 ? 'selected': '' }} value="1">@lang('Active')</option>
                                                    <option {{ $memberStatus[$i] == 0 ? 'selected': '' }} value="0">@lang('Inactive')</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-md-1 col-lg-1">
                                                <button type="button" class="btn {{ $i==0 ? 'btn-info addRow' : 'btn-danger removeRow' }}"> 
                                                    <i class="fa fa-{{ $i==0 ? 'plus' : 'times' }}"> </i> 
                                                </button>
                                            </div>
                                        </div>
                                        @php  $i++ ;  @endphp
                                        @endforeach
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label class="control-label" for="quorum">@lang('5'). @lang('Quorum') <span class="text-danger"> *</span></label>

                                    <input type="number"
                                        class="form-control form-control-sm @error('quorum') is-invalid @enderror"
                                        id="date_to"
                                        name="quorum"
                                        value="{{old('quorum') ?? $editData->quorum ?? '' }}"
                                        placeholder="@lang('Enter Quorum No.')"/>

                                    @error('quorum')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-4 mt-2">
                                <div class="form-group mt-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="status" {{ $editData->status == 1 ? 'checked' : '' }} value="1" class="custom-control-input" id="active-status">
                                        <label class="custom-control-label" for="active-status">@lang('Make it Active/Inactive ?')</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-secondary btn-sm white-text ion-android-arrow-back">
                                        <a href="{{ route('admin.petition_management.petition_committees.index') }}">@lang('Back')</a>
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>    
                                    <button id="submitBtn" type="submit" class="btn btn-success btn-sm">@lang('Submit')</button>
                                </div>
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
        $(function () {
            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#reservationdate2').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            var incrementValue = 20;
            //Add Row
            $('.addRow').click(function(){
                var loadMember = '<div class="row mb-2 childDiv"><div class="col-sm-12 col-md-4 col-lg-4"> <select id="petition_committee_'+incrementValue+'" name="user_id[]" class="@error("user_id") is-invalid @enderror form-control form-control-sm petition_committee select2"><option value="">@lang("Select the Name")</option> @if (isset($profiles) && count($profiles) > 0) @foreach ($profiles as $data) @if($data->user_id == old("user_id"))<option selected value="{{ $data->user_id }}"> @if(session()->get("language") =="bn") {{ $data->name_bn }} @else {{ $data->name_eng }} @endif</option> @else<option value="{{ $data->user_id }}"> @if(session()->get("language") =="bn") {{ $data->name_bn }} @else {{ $data->name_eng }} @endif</option> @endif @endforeach @endif </select> @error("user_id") <span class="text-danger">{{ $message }}</span> @enderror</div><div class="col-sm-12 col-md-4 col-lg-4"> <select id="designation_id_'+incrementValue+'" name="designation_id[]" class="@error("designation_id") is-invalid @enderror form-control form-control-sm designation_id select2"><option value="">@lang("Select Designation")</option> @foreach ($designations as $data) @if($data->id == old("designation_id"))<option selected value="{{ $data->id }}"> @if(session()->get("language") =="bn") {{ $data->name_bn }} @else {{ $data->name_eng }} @endif</option> @else<option value="{{ $data->id }}"> @if(session()->get("language") =="bn") {{ $data->name_bn }} @else {{ $data->name_eng }} @endif</option> @endif @endforeach </select> @error("user_id") <span class="text-danger">{{ $message }}</span> @enderror </div><div class="col-sm-12 col-md-3 col-lg-3"><select id="member_status_'+incrementValue+'" name="member_status[]" class="form-control form-control-sm member_status select2"><option value="1">@lang("Active")</option><option value="0">@lang("Inactive")</option> </select></div><div class="col-sm-12 col-md-1 col-lg-1"> <button type="button" class="btn btn-danger removeRow"> <i class="fa fa-times"> </i> </button></div></div>';


                $('#addMember').append(loadMember);
                incrementValue++;
                $(".select2").select2({});
            });
            
            //Remove Row
            $(document).on("click", ".removeRow", function() {
                $(this).closest('.childDiv').remove();
            });

        });


        

        
    </script>
@endsection