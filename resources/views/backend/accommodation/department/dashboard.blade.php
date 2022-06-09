@extends('backend.layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">@lang('Accommodation Dashboard')</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
              <li class="breadcrumb-item active">@lang('Accommodation Dashboard')</li>
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
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-4">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">@lang('Pending')</span>
               <span class="info-box-number">            
             {{    Lang::locale()=='bn'?$totalPendingBn:$totalPending    }}                 
               </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-4">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">@lang('Approved')</span>
              <span class="info-box-number">
                {{    Lang::locale()=='bn'?$totalApprovedBn:$totalApproved    }}                 

              
              
              </span>   
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div> 
          <!-- /.col -->
         
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-4">
              <div class="info-box mb-4">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">@lang('Rejected')</span>
                 <span class="info-box-number">        
               {{    Lang::locale()=='bn'?$totalRejectedBn:$totalRejected    }}                 
                </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div> 
            <!-- /.col -->
        </div>
      </div>
      <!--/. container-fluid -->
    </section>



                    

@endsection

