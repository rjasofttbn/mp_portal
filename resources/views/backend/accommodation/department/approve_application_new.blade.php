@extends('backend.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="card-title">@lang('Flat Allocation Management')</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Flat Allocation Management')</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <p>@lang('Applicant Name') : {{ Lang::locale()=='bn'? @$accommodation_application['mp']['name_bn']:$accommodation_application['mp']['name']}} ({{ Lang::locale()=='bn'? @$accommodation_application['profile']['constituency']['bn_name']:@$accommodation_application['profile']['constituency']['name']}})</p>
                        <p>@lang('Applicant Subject') : {{(session()->get('language') =='bn')?(@$accommodation_application['accommodation_application_type']['name_bn']):@$accommodation_application['accommodation_application_type']['name']}}</p>
                        <p>@lang('Expected Allocated Date') : {{(session()->get('language') =='bn')?(en2bn(date('d-m-Y',strtotime(@$accommodation_application['date'])))):date('d-m-Y',strtotime(@$accommodation_application['date']))}}</p>
                        <p>@lang('Area') : {{(session()->get('language') =='bn')?(@$accommodation_application['area']['name_bn']):@$accommodation_application['area']['name']}}</p>
                        <p>@lang('Flat') : {{(session()->get('language') =='bn')?(@$accommodation_application['flat_type']['name_bn']):@$accommodation_application['flat_type']['name']}}</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-4">  
                                <select id="area_id" name="area_id" class="form-control form-control-sm select2">
                                    <option value="">@lang('Select Area')</option>
                                    @foreach ($areas as $list)
                                    @if(session()->get('language') =='bn') 
                                    <option value="{{ $list->id }}">{{  Lang::locale()=='bn'?$list->name_bn:$list->name}}</option>
                                    @else
                                    <option value="{{ $list->id }}">{{  Lang::locale()=='bn'?$list->name_bn:$list->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">  
                                <select id="building_id" name="building_id" class="form-control form-control-sm select2">
                                    <option value="">@lang('Select Building')</option>
                                </select>
                            </div>
                            <div class="col-sm-2">  
                                <a class="btn btn-sm btn-success" id="search"><i class="fa fa-search"></i> @lang('Search')</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="ajax_data"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).on('change','#area_id', function () {
        var area_id = $(this).val();
        $.ajax({
            url: '{{url("building-list-by-area")}}',
            data:{area_id:area_id},
            type: "GET",
            beforeSend: function () {
            },
            success: function (data) {
                $('#building_id').html(data);
                $('#building_id').select2();
            }
        });
    });
</script>

<script type="text/javascript">
$(document).on('click','#search',function(){
    alert('c');
    var area_id = $('#area_id').val();
    var building_id = $('#building_id').val();
    $.ajax({
        url : "{{url('accommodation-flat-list-by-building')}}",
        data : {area_id:area_id,building_id:building_id},
        type : "get",
        beforeSend : function(){
            $('.preload').show();
        },
        success:function(data){
            $('.preload').hide();
            $('#ajax_data').html(data);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            toastr.error('দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য দেখা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান ', {globalPosition: 'top right',className: 'error',autoHideDelay:10000});
            $('.preload').hide();
        }
    });
});
</script>
@endsection