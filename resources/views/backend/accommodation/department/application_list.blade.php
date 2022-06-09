@extends('backend.layouts.app')
@section('content')
<style type="text/css">
    nav > .nav.nav-tabs{
        border: none;
        color:#fff;
        background:#272e38;
        border-radius:0;
    }
    nav > div a.nav-item.nav-link,
    nav > div a.nav-item.nav-link.active
    {
        border: none;
        /*padding: 8px 8px;*/
        color:#fff;
        background:#272e38;
        border-radius:0;
    }

    nav > div a.nav-item.nav-link.active:after
    {
        content: "";
        position: relative;
        bottom: -48px;
        left: -10%;
        border: 15px solid transparent;
        border-top-color: #e74c3c ;
    }
    .tab-content{
        background: #fdfdfd;
        line-height: 25px;
        border: 1px solid #ddd;
        border-top:5px solid #e74c3c;
        border-bottom:5px solid #e74c3c;
        /*padding:8px 8px;*/
    }

    nav > div a.nav-item.nav-link:hover,
    nav > div a.nav-item.nav-link:focus
    {
        border: none;
        background: #e74c3c;
        color:#fff;
        border-radius:0;
        transition:background 0.20s linear;
    }
</style>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="card-title">@lang('Manage Accommodation Application')</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                    <li class="breadcrumb-item active">@lang('Manage Accommodation Application')</li>
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
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">  
                                <select id="accommodation_application_type_id" name="accommodation_application_type_id" class="form-control form-control-sm select2">
                                    <option value="">@lang('Select Application')</option>
                                    @foreach ($accommodation_application_types as $list)
                                    @if(session()->get('language') =='bn') 
                                    <option value="{{ $list->id }}">{{  Lang::locale()=='bn'?$list->name_bn:$list->name}}</option>
                                    @else
                                    <option value="{{ $list->id }}">{{  Lang::locale()=='bn'?$list->name_bn:$list->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">  
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
$(document).on('click','#search',function(){
    var accommodation_application_type_id = $('#accommodation_application_type_id').val();
    $.ajax({
        url : "{{url('/admin/accommodation/applications/application/application-monitoring-data')}}",
        data : {accommodation_application_type_id:accommodation_application_type_id},
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

<script type="text/javascript">
    
    $(document).on('click', '.reject_accommodation', function() {
      var btn = this;
      Swal.fire({
        title: 'Are you sure to Reject?',
        // text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Reject!'
      }).then((result) => {
        if (result.value) {
            var status = 3;
            var id = $(this).data('id');
          $.ajax({
            url: '{{url('/admin/accommodation/applications/application/application-monitoring-data-reject')}}',
            type: "get",
            data: {id:id,status:status},
            success: function(response) {
                if (response.status == 'success') {
                    Swal.fire({
                        title: 'Reject!',
                        text: "",
                        type: 'success'
                    }).then((result) => {
                        window.location.replace(response.reload_url);
                    });
                } 
                else {
                    Swal.fire('Cancel error', '', 'error');
                }
            }
        });
        }

      })
    });
</script>

@endsection