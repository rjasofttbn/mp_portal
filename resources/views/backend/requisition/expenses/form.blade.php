@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Telephone expenses and cash allowance')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Telephone expenses and cash allowance')</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if ($data->id)
                <h4 class="card-title">@lang('Update Telephone expenses and cash allowance')</h4>
                @else
                <h4 class="card-title">@lang('Create Telephone expenses and cash allowance')</h4>
                @endif
            </div>
            <!-- Form Start-->
            <form id="ministryForm" name="ministryForm" method="POST" @if($data->id)
                action="{{ route('admin.requisition.telephoneExpensesCashAllowance.update', $data->id) }}">
                <input name="_method" type="hidden" value="PUT">
                @else
                action="{{ route('admin.requisition.telephoneExpensesCashAllowance.store') }}">
                @endif
                @csrf

                <input type="hidden" id="id" name="id" value="{{$data->id}}">
                <div class="card-body">
                    <div class="row">
                        
                    <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="designition_id">@lang('Designation')<span style="color: red;"> *</span></label>
                                <select id="designition_id" name="designition_id[]" class="form-control @error('designition_id') is-invalid @enderror select2" multiple>
                                    <option value="">@lang('Select Designation')</option>
                                    @foreach ($designation as $list)
                                   
                                    @if(in_array($list->id,json_decode($data->designition_id)))
                                    <option selected value="{{$list->id}}">{{(session()->get('language') =='bn')?$list->name_bn:$list->name}}</option>
                                    @else
                                    <option value="{{$list->id}}">{{(session()->get('language') =='bn')?$list->name_bn:$list->name}}</option>
                                    @endif
                                    @endforeach
                                </select>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="telphone_expenses">@lang('Enter Monthly Telephone Expenses Including Internet (Taka)')<span style="color: red;"> *</span></label>
                                <input type="text" id="telphone_expenses" name="telphone_expenses" value="{{old('telphone_expenses', $data->telphone_expenses)}}" class="form-control @error('telphone_expenses') is-invalid @enderror" placeholder="@lang('Enter Monthly Telephone Expenses Including Internet (Taka)')" autocomplete="off" maxlength="30">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="cashing_allowance">@lang('Enter Monthly Telephone Cashing Allowance with Internet (Taka)')<span style="color: red;"> *</span></label>
                                <input type="text" id="cashing_allowance" name="cashing_allowance" value="{{old('cashing_allowance', $data->cashing_allowance)}}" class="form-control @error('cashing_allowance') is-invalid @enderror" placeholder="@lang('Enter Monthly Telephone Cashing Allowance with Internet (Taka)')" autocomplete="off" maxlength="30">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        @if($data->id)
                        <div class="form-group col-sm-4 mt-auto">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="status" {{ $data->status == 1 ? 'checked' : '' }} value="1" class="custom-control-input" id="active-status">
                                <label class="custom-control-label" for="active-status">
                                    @if($data->status == 0)
                                    @lang('Make it active ?')
                                    @else
                                    @lang('Make it inactive ?')
                                    @endif
                                </label>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group text-right">
                            @if($data->id)
                            <button type="submit" class="btn btn-success btn-sm">@lang('Update')</button>
                            @else
                            <button type="submit" class="btn btn-success btn-sm">@lang('Save')</button>
                            <button type="reset" class="btn btn-danger btn-sm">@lang('Clear')</button>
                            @endif
                            <button type="button" class="btn btn-default btn-sm ion-android-arrow-back">
                                <a href="{{route('admin.master_setup.songshodRoom.index') }}">@lang('Back')</a>
                            </button>
                        </div>
                    </div>
                </div>
        </div>
        </form>
        <!--Form End-->
    </div>
</div>
</div>
<script>
    // function removeSpecials(evt) {
    //     var input = document.getElementById("room_bn");
    //     var patt = /[^\u0000-\u007F ]+/;
    //     setTimeout(function() {
    //         var value = input.value;
    //         if (patt.test(value) == false) {
    //             input.value = "";
    //         }
    //     }, 100);
    // }
    $('#building_type').change(function() {
        let building_type = $(this).val();
        if (building_type == 1) {
            $('#songshod_portion').css('visibility', 'visible');
            $('#hostel_portion').hide();
        } else {
            $('#songshod_portion').css('visibility', 'hidden');
            $('#hostel_portion').show();
        }
    })
    $('#floor_id').change(function() {
        let floor_id = $(this).val();
        let block_id = $('#sblock_id').val();
        $.ajax({
            url: "{{url('/requisition/getRoom')}}",
            method: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                floor_id: floor_id,
                block_id: block_id
            },
            success: function(res) {
                if(res == 0){
                    alert('No Room Found')
                }else{
                    $('#room_id').html(res);
                }
                
            }

        })
    })
</script>
<style>
    .hides {
        visibility: hidden
    }
    .displays{
        visibility: visible
    }
</style>

@endsection