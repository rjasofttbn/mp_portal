@extends('frontend.layouts.index')
@section('content')
@include('frontend.layouts.loader')
@include('frontend.layouts.header')
@include('frontend.layouts.banner')
<section class="background_bg bg_linen bg_fixed">
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
               <div class="single_post">
                <div class="author_block">
                    <div class="course_author">
                        <div class="author_meta">
                            <div class="author_intro">
                                
                            </div>
                            <div class="author_desc mt-2">
                               <?php echo $find_post['description'] ?>
                           </div>	
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
</section>
@include('frontend.layouts.footer')
@endsection