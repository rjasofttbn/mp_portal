@extends('frontend.layouts.index') @section('content')
<!-- LOADER -->
{{-- @include('frontend.layouts.loader') --}}
<!-- START HEADER -->
@include('frontend.layouts.header')

<!-- END HEADER -->

<!-- NEWS -->
@include('frontend.layouts.news_notice_headline')
<!-- END NEWS -->
<!-- START SECTION SLIDER -->
@include('frontend.layouts.slider')
<!-- END SECTION SLIDER -->

<!-- START SECTION ABOUT -->
<section class="small_pt small_pb overflow-hidden">
    <div class="container-fluid p-0">
        <div class="row no-gutters align-items-center">
            <div class="col-md-8">
                <div class="box_shadow1 bg-white overlap_section padding_eight_all">
                    <div class="animation animated fadeInLeft" data-animation="fadeInLeft" data-animation-delay="0.02s" style="animation-delay: 0.02s; opacity: 1;">
                        <div class="heading_s1">
                            <h2>{{$about->title}}</h2>
                        </div>
                        <p>{!! $about->short_description !!}</p>

                        <div class="text-center animation animated fadeInUp" data-animation="fadeInUp" data-animation-delay="0.07s" style="animation-delay: 0.07s; opacity: 1;">

                            <a href="{{route('about')}}" class="btn btn-default">More About<i class="ion-ios-arrow-thin-right ml-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="animation animated fadeInRight" data-animation="fadeInRight" data-animation-delay="0.03s" style="animation-delay: 0.03s; opacity: 1;">
                    <div class="overlay_bg_30 about_img z_index_minus1">
                        <img class="w-100" src="{{asset('public/frontend/images/download.jpg')}}" alt="about_img">
                    </div>
                    <a href="https://www.youtube.com/embed/8ZdlGEh-rI4" class="video_popup video_play">
                        <span class="ripple"><i class="ion-play ml-1"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- START SECTION EVENT -->
<section class="background_bg bg_linen bg_fixed">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="single_post">

                    <div class="author_block">
                        <div class="course_author">
                            <div class="author_img">
                                <img class="radius_all_5" src="{{asset('public/upload/faculty/'.$head['image'])}}" alt="client_img1">
                            </div>
                            <div class="author_meta">
                                <div class="author_intro">
                                    <h3 style="font-size: 20px;">{{$head->title}}</h3>
                                    <p><strong>{{$head->designation}}</strong></p>
                                    <!-- <h6>Department of EEE, BUET</h6> -->
                                    <h6>{{$head->name}}</h6>
                                    <h6>{!! $head->address !!}</h6>
                                </div>

                                <div class="author_desc mt-2">
                                    <p>{!! $head->short_description !!}</p>
                                </div>
                                <div class="text-center animation animated fadeInUp" data-animation="fadeInUp" data-animation-delay="0.07s" style="animation-delay: 0.07s; opacity: 1;">
                                    <div class="medium_divider"></div>
                                    <a href="{{route('more.message')}}" target="_blank" class="btn btn-default">More Message <i class="ion-ios-arrow-thin-right ml-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-12">
                <div class="carousel_slider owl-carousel owl-theme" data-margin="10" data-loop="true" data-autoplay="true" data-nav="true" data-dots="false" data-responsive='{"0":{"items": "1"}, "767":{"items": "2"}, "1199":{"items": "4"}}'>

                    @foreach($teacher as $key => $h)
                    <div class="item">
                        <div class="team_box team_style3 animation" data-animation="fadeInUp" data-animation-delay="0.04s">
                            <div class="team_img">
                                <a href="{{route('faculty.details',$h->id)}}"><img @if(!empty($h->image))
                                    @if(file_exists('public/upload/faculty/'.$h->image))
                                    src="{{asset('public/upload/faculty/'.$h->image)}}"
                                    @else
                                    src="{{asset('public/frontend/images/profile.jpg')}}"
                                    @endif
                                    @else
                                    src="{{asset('public/frontend/images/profile.jpg')}}"
                                    @endif alt="team3"></a>
                                </div>
                                <div class="team_title radius_lbrb_10 text-center">
                                    <h5 style="height: 50px"><a href="{{route('faculty.details',!empty($h->faculty_slug)?$h->faculty_slug : '')}}">{{$h['name']}}</a></h5>
                                    <span style="color: black;">{{$h['designations']['name']}}</span>
                                </div>
                                <div style="border-bottom: 1px solid #ddd;"></div>
                                <div class="team_single_info">
                                    <h6 class="text-center">Contact info</h6>
                                    <ul class="contact_info list_none">

                                        <li>
                                            <span style="max-width: 86"><i class="fa fa-envelope" style="padding-left: 1px;"></i></span>
                                            <a href="">{{$h['email']}}</a>
                                        </li>
                                        {{-- @if($h->room) --}}
                                        <li>
                                            <span style="max-width: 86"><i class="fas fa-home"></i></span>
                                            <p>{{$h->room}}</p>

                                        </li>
                                        {{-- @endif --}}
                                        <li>
                                            <span style="max-width: 86"><i class="fa fa-mobile-alt " style="padding-left: 2px;"></i></span>
                                            <p>{{$h['phone']}}</p>
                                        </li>
                                        <li>
                                            <span style="max-width: 86"><i class="fa fa-globe"></i></span>
                                            <a href="{{$h->website}}" target="_blank">{{$h->website}}</a>
                                        </li>
                                    </ul>

                                    {{-- <h6 class="mb-0" style="color: red;">Google Scholar Link</h6> --}}
                                    <ul class="contact_info list_none">
                                        <li>
                                            <span style="max-width: 86"><i class="ai ai-google-scholar-square ai-1x"></i></span>
                                            <a href="@if($h->scholar_url) {{$h->scholar_url}} @else https://scholar.google.com/ @endif"  target="_blank">Google Scholar Link</a>                  
                                        </li>
                                    </ul>
                                    
                                    {{-- <ul class="list_none social_icons text-center">
                                        <li><a href="http://{{$h['facebook_url']}}" class="sc_facebook"><i class="ion-social-facebook"></i></a></li>
                                        <li><a href="http://{{$h['twitter_url']}}" class="sc_twitter"><i class="ion-social-twitter"></i></a></li>
                                        <li><a href="http://{{$h['googleplus_url']}}" class="sc_gplus"><i class="ion-social-googleplus"></i></a></li>
                                        <li><a href="http://{{$h['instagram_url']}}" class="sc_instagram"><i class="ion-social-instagram-outline"></i></a></li>
                                    </ul> --}}
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <div class="text-center animation animated fadeInUp" data-animation="fadeInUp" data-animation-delay="0.07s" style="animation-delay: 0.07s; opacity: 1;">
                        <div class="medium_divider"></div>
                        <a href="{{route('faculty')}}" target="_blank" class="btn btn-default">More Faculty <i class="ion-ios-arrow-thin-right ml-1"></i></a>
                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $(".carousel_slider").owlCarousel({
                            nav: true,
                            dots: false,
                            autoplay : true,
                            loop:true,
                            autoplayTimeout: 8000,
                            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                            mouseDrag: true,
                            touchDrag: false,
                            responsive:{
                                0:{
                                    items:1
                                },
                                767:{
                                    items:2
                                },
                                1199:{
                                    items:4
                                }
                            }
                        });
                    });
                </script>

            </div>
        </div>
    </section>

    <!-- START SECTION COUNTER -->
    <section class="background_bg bg_light_navy bg_fixed" data-img-src="{{asset( 'public/frontend/images/pattern_bg4.png')}} ">
        <div class="container ">
            <div class="row justify-content-center ">
                <div class="col-xl-12 col-lg-12 ">
                    <div class="text-center animation animated fadeInUp " data-animation="fadeInUp " data-animation-delay="0.01s " style="animation-delay: 0.01s; opacity: 1; ">
                        <div class="heading_s1 text-center ">
                            <h2 class="text-white ">About EEE</h2>
                            <p>A place for learning, discovery, innovation, expression and discourse</p>
                        </div> 
                    </div>
                </div> 
            </div>
            <div class="row ">

                <div class="col-lg-4 col-md-4 col-6 ">
                    <div class="box_counter counter_style2 text_white text-center animation " data-animation="fadeInUp " data-animation-delay="0.02s ">
                        <div class="counter_icon ">
                            <img src="{{asset( 'public/frontend/images/counter_icon1.png')}} " alt="counter_icon1 " />
                        </div>
                        <div class="counter_content ">
                            <h3 class="counter_text "><span class=" ">1947</span></h3>
                            <p>Opened in</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-6 ">
                    <div class="box_counter counter_style2 text_white text-center animation " data-animation="fadeInUp " data-animation-delay="0.03s ">
                        <div class="counter_icon ">
                            <img src="{{asset( 'public/frontend/images/counter_icon1.png')}} " alt="counter_icon1 " />
                        </div>
                        <div class="counter_content ">
                            <h3 class="counter_text "><span class="counter ">1,000</span>+</h3>
                            <p>Students</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-6 ">
                    <div class="box_counter counter_style2 text_white text-center animation " data-animation="fadeInUp " data-animation-delay="0.04s ">
                        <div class="counter_icon ">
                            <img src="{{asset( 'public/frontend/images/counter_icon2.png')}} " alt="counter_icon2 " />
                        </div>
                        <div class="counter_content ">
                            <h3 class="counter_text "><span class="counter ">85</span>+</h3>
                            <p>Faculty</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- END SECTION COUNTER -->
    <!-- START SECTION EVENT -->
    <section class="bg_gray ">
        <div class="container ">
            <div class="row ">
                <div class="col-lg-8 ">
                    <div class="text-center animation " data-animation="fadeInUp " data-animation-delay="0.01s ">
                        <div class="heading_s1 text-center ">
                            <div class="small_divider "></div>
                            <h2>News & Events</h2>
                        </div> 
                    </div>
                    <div class="row ">
                        @foreach($home_news as $news)
                        <div class="col-lg-6 col-sm-6 ">
                            <div class="content_box event_box box_shadow1 animation " data-animation="fadeInUp " data-animation-delay="0.02s ">
                                <div class="content_img ">
                                    <a href="{{route( 'read.more.news',$news[ 'id'])}}"><img src="{{asset( 'public/upload/news/'.$news[ 'image'])}} " alt="event_img1 "/></a>

                                </div>
                                <div class="content_desc bg-white ">
                                    <h4 class="content_title "><a href="{{route( 'read.more.news',$news[ 'id'])}}">{{$news['title']}}</a></h4>
                                    <span class="post_date ">{{date('d F, y',strtotime($news['date']))}}</span>
                                    <p>{!! $news['short_description'] !!}
                                        ...<a href="{{route( 'read.more.news',$news[ 'id'])}} " class="text-capitalize "> <i class="ion-ios-arrow-thin-right ml-1 "></i> Read More </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="col-lg-12 col-sm-12 ">
                            <div class="text-center animation animated fadeInUp " data-animation="fadeInUp " data-animation-delay="0.07s " style="animation-delay: 0.07s; opacity: 1; ">
                                <div class="medium_divider "></div>
                                <a href="{{route('more.news.event')}}" class="btn btn-default ">More News & Events <i class="ion-ios-arrow-thin-right ml-1 "></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 ">
                    <div class="text-center animation " data-animation="fadeInUp " data-animation-delay="0.01s ">
                        <div class="heading_s1 text-center ">
                            <div class="small_divider "></div>
                            <h2>Notice Board</h2>
                        </div> 
                    </div>
                    <div class="row event_list ">
                        <div class="col-md-12 ">
                            @foreach($home_notice as $notice)
                            <div class="content_box event_box box_shadow1 animation " data-animation="fadeInUp " data-animation-delay="0.03s ">
                                <div class="event_date ">
                                    <h5><span>{{date('d',strtotime($notice['date']))}}</span> {{date('F',strtotime($notice['date']))}}</h5>
                                    <span class="event_time bg_default ">{{date('Y',strtotime($notice['date']))}}</span>
                                </div>
                                <div class="content_desc bg-white "> 
                                    <h4 class="content_title "><a href="{{route('notice',$notice['id'])}}">{{$notice['title']}}</a></h4>

                                </div>
                            </div>
                            @endforeach

                            <div class="text-center animation animated fadeInUp " data-animation="fadeInUp " data-animation-delay="0.07s " style="animation-delay: 0.07s; opacity: 1; ">
                                <div class="medium_divider "></div>
                                <a href="{{route('all.notice')}}" class="btn btn-default ">More Notice <i class="ion-ios-arrow-thin-right ml-1 "></i></a>
                            </div>
                        </div>    
                    </div>

                </div>
            </div>
        </div> 
    </section>
    {{-- Research --}}
       {{-- <hr style="border: 4px solid #7b0100;"> --}}
       <div class="row" style="padding-left: 100px; padding-right: 100px; background: #f9f5f0">
        {{-- <div class="col-sm-1 col-md-1 col-lg-1">
            
        </div> --}}
        <div class="col-sm-4 col-md-4 col-lg-4" style="">
            <hr style="border: 4px solid #7b0100;">
        </div>
           
        <div class="col-sm-4 col-md-4 col-lg-4">
            <h2 style="text-align: center; ">Research Areas</h2>
        </div>

        <div class="col-sm-4 col-md-4 col-lg-4" style="">
             <hr style="border: 4px solid #7b0100;">
        </div>
        {{-- <div class="col-sm-1 col-md-1 col-lg-1">
            
        </div> --}}
       </div>
    <section class="background_bg bg_linen bg_fixed">

        <div class="container">
          
            <div class="row justify-content-center">


                <div class="col-12">
                    <div class="carousel_slider owl-carousel owl-theme" data-margin="10" data-loop="true" data-autoplay="true" data-nav="true" data-dots="false" data-responsive='{"0":{"items": "1"}, "767":{"items": "2"}, "1199":{"items": "4"}}'>
                        @foreach($research as $r)
                        <a href="{{route('research.detail',$r->id)}}"><div class="card" style="width: 16.5rem; min-height: 120px;">
                            <img class="card-img-top" src="{{asset('public/upload/research/'.$r->image)}}" alt="Card image cap">
                          <div class="card-body" style="min-height: 100px">
                            <h5 class="" style="font-size: 16px; text-align: center;">{{$r->title}}</h5>
                           
                            
                        </div>
                    </div></a>

                    @endforeach




                </div>
                <div class="text-center animation animated fadeInUp" data-animation="fadeInUp" data-animation-delay="0.07s" style="animation-delay: 0.07s; opacity: 1;">
                    <div class="medium_divider"></div>
                    <a href="{{route('more.research')}}" target="_blank" class="btn btn-default">More Research <i class="ion-ios-arrow-thin-right ml-1"></i></a>
                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function(){
                    $(".carousel_slider").owlCarousel({
                        nav: true,
                        dots: false,
                        autoplay : true,
                        autoplayTimeout: 8000,
                        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                        mouseDrag: true,
                        touchDrag: false,
                        responsive:{
                            0:{
                                items:1
                            },
                            767:{
                                items:2
                            },
                            1199:{
                                items:4
                            }
                        }
                    });
                });
            </script>

        </div>
    </div>
</section>

{{-- End Research --}}
{{-- 
    <section class=" ">
        <div class="container ">
            <div class="row justify-content-center ">
                <div class="col-xl-12 col-lg-12 ">
                    <div class="text-center ">
                        <div class="heading_s1 text-center milumax-border ">
                            <div style="border: 4px solid"><hr></div><h2 class="post__title has-no-space-below" style="height: 0"><span style="position: relative;background: white;z-index: 1;">Research</span><div><hr></div>
                        </div>
                        <p class="title p-post "></p>

                        <div class="course_list" style="padding: 22px 0px 53px 0px;border: 4px solid ;">
                            <div class="row ">
                                @foreach($home_research as $r)
                                <div class="col-md-12 ">
                                    <div class="content_box box_shadow1 animation animated fadeInUp " data-animation="fadeInUp " data-animation-delay="0.02s " style="animation-delay: 0.02s; opacity: 1; ">
                                        <div class="content_img ">
                                            <a href="{{route('research.detail',$r['id'])}}"><img src="{{asset( 'public/upload/research/'.$r['image'])}} " alt="Biomedical-Signal-Processing " width="100px" height="150px"></a>
                                        </div>
                                        
                                             <div class="content_desc ">
                                            <h4 class="content_title "><a href="#">{{$r['title']}}</a></h4>
                                                {!! $r['description'] !!}
                                            </div>

                                        </div>
                                    </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                        <div class="text-center animation animated fadeInUp " data-animation="fadeInUp " data-animation-delay="0.07s " style="animation-delay: 0.07s; opacity: 1; ">
                            <div class="medium_divider "></div>
                            <a href="{{route('more.research')}}" class="btn btn-default rounded-0 ">More About Research <i class="ion-ios-arrow-thin-right ml-1 "></i></a>
                        </div>
                    </div>

                </div>
            </div>

        </section> --}}

        <!-- START SECTION GALLERY -->
        <section class="bg_light_navy background_bg " data-img-src="{{asset( 'public/frontend/images/pattern_bg2.png')}} " style="background-image: url({{asset( 'public/frontend/images/pattern_bg2.png')}}); background-position: center center; background-size: cover; ">
            <div class="container "> 
                <div class="row justify-content-center ">
                    <div class="col-xl-12 col-lg-12 ">
                        <div class="text-center animation " data-animation="fadeInUp " data-animation-delay="0.01s ">
                            <div class="heading_s1 text-center ">
                                <h2 class="text-white ">Our Gallery</h2>
                            </div>
                            <p class="title text-white "></p>
                            <div class="small_divider "></div>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-12 ">
                        <ul class="grid_container gutter_medium grid_col3 animation " data-animation="fadeInUp " data-animation-delay="0.03s ">
                            <li class="grid-sizer "></li>
                            <!-- START PORTFOLIO ITEM -->
                            @foreach($gallery as $g)
                            <li class="grid_item ">
                                <div class="gallery_item radius_all_10 ">
                                    <a href="# " class="image_link ">
                                        <img src="{{asset( 'public/upload/gallery/'.$g['image'])}} " alt="image ">
                                    </a>
                                    <div class="gallery_content ">
                                        <div class="link_container ">
                                            <a href="{{asset( 'public/upload/gallery/'.$g['image'])}} " class="image_popup "><span class="ripple "><i class="ion-image "></i></span></a>
                                        </div>
                                        <div class="text_holder text_white ">
                                            <h5>{{$g['title']}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach

                            <!-- END PORTFOLIO ITEM -->
                        </ul>
                    </div>
                    <div class="col-12 ">
                        <div class="text-center animation animated fadeInUp " data-animation="fadeInUp " data-animation-delay="0.07s " style="animation-delay: 0.07s; opacity: 1; ">
                            <div class="medium_divider "></div>
                            <a href="{{route('more.gallery')}}" class="btn btn-default ">More Gallery <i class="ion-ios-arrow-thin-right ml-1 "></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END SECTION GALLERY -->

        <!-- START SECTION TESTIMONIAL -->

        <!-- END SECTION TESTIMONIAL -->
        <section class="background_bg bg_fixed ">
            <div class="text-center animation animated fadeInUp " data-animation="fadeInUp " data-animation-delay="0.01s " style="animation-delay: 0.01s; opacity: 1; ">
                <div class="heading_s1 text-center ">
                    <h2>Get In Touch</h2>
                </div>
                <p></p>
                <div class="small_divider "></div>
            </div>
            <div class="contact_map map_radius_rtrb overflow-hidden h-100 " style="height: 150px !important ">
                <iframe src="//www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.578430063007!2d90.38622601498089!3d23.726744084600977!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x9216af99d31fde46!2sDepartment%20of%20Electrical%20and%20Electronic%20Engineering%20BUET!5e0!3m2!1sen!2sbd!4v1574858123671!5m2!1sen!2sbd " frameborder="0 " style="border:0; " allowfullscreen=" "></iframe>
            </div>
        </section>

        <!-- START FOOTER -->
        @include('frontend.layouts.footer')
        <!-- END FOOTER -->
        @endsection