<!-- START SECTION BANNER -->
@php
$count = 0;
@endphp
<section class="banner_section p-0 full_screen">
    <div id="carouselExampleControls" class="banner_content_wrap carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($slider as $s)
            <div class="carousel-item @if($count == 0){ active }@endif background_bg overlay_bg_50" data-img-src="{{asset('public/upload/slider/'.$s->image)}}">
                <div class="banner_slide_content">
                    <div class="container"><!-- STRART CONTAINER -->
                    <div class="row justify-content-center">
                        <div class="col-lg-12 col-sm-12 text-center">
                            <div class="banner_content animation text_white" data-animation="fadeIn" data-animation-delay="0.8s">
                                <h2 class="font-weight-bold animation text-uppercase" data-animation="zoomIn" data-animation-delay="1s">{{$s->title}}</h2>
                                <p class="animation" data-animation="zoomIn" data-animation-delay="1.5s">{!! $s->description !!}</p>
                               
                            </div>
                        </div>
                    </div>
                </div><!-- END CONTAINER-->
                </div>
            </div>
            @php
            $count++;
            @endphp
           @endforeach
        </div>
        
        <div class="carousel-nav">
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <i class="ion-chevron-left"></i>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <i class="ion-chevron-right"></i>
            </a>
        </div>
    </div>
</section>
<!-- END SECTION BANNER -->