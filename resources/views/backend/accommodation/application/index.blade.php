@extends('backend.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark">@lang('Accommodation Application Management')</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Accommodation Application Management')</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="content">
    <div class="col-md-12">
        @if($user->usertype =='speaker' || $user->usertype =='staff')
                <div class="card"style="margin-top: 171px; text-align:center;">
                <div class="card-body">
                <h3 style="color: red;">Only, MP Can Submit Appliction...</h3>
            </div>
        </div>
           @elseif($user->usertype =='mp' || $user['usertype']=='ps')
                <div class="card">
                <div class="card-body">
                <form id="application_type_id" class="form-horizontal" action="{{ route('admin.accommodation.applications.create') }}" method="get">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="control-label" for="application_type_id">@lang('Select Application Type')<span
                                    class="required text-danger">*</span></label>
                            <select id="application_type_id" name="application_type_id"
                                    class="form-control form-control-sm select2" required>
                                <option value="">@lang('Select Application')</option>
                                     @foreach ($accommodation_application_types as $value)
                                         @if(session()->get('language') =='bn') 
                                         <option value="{{ $value->id }}">{{  Lang::locale()=='bn'?$value->name_bn:$value->name}}</option>
                                      
                                        @else
                                         <option value="{{ $value->id }}">{{  Lang::locale()=='bn'?$value->name_bn:$value->name}}</option>
                                        @endif
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-info btn-sm seachNotice"
                                    style="margin-top:28px">
                                @lang('GO')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
          @endif               
    </div>
</div>
</div>
@endsection




{{-- <script>

<input type = "hidden" class="delete_id_value" value = "{{$data->id}}">
<a href = "javascript:void(0)" class = "delete_btn_ajax btn btn-danger"> confirm delete</a>

$(document).ready(function(){
	$('.delete_btn_ajax').click(function(e){
	e.preventDefault();
	// console.log("Hello");

	var deleteid = $(this).closest("tr").find('.delete_id_value').val();
	console.log(deleted);
	});

});
</script> --}}
