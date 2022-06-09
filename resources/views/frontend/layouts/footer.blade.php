
<footer class="bg_light_navy footer_dark">
    <div class="top_footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-8 mb-4 mb-lg-0">
                    <div class="footer_logo">
                        <a href="index.html"><img alt="logo" src="{{asset('public/frontend/images/banner/black-logo.svg')}}"></a>
                    </div>

                    <ul class="contact_info contact_info_light list_none">
                        <li>
                            <i class="fa fa-map-marker-alt "></i>
                            <address>{!! $contact->address !!}</address>
                        </li>
                        <li>
                            <i class="fa fa-envelope"></i>
                            <a href="#">{{$contact->email}}</a>
                        </li>
                        <li>
                            <i class="fa fa-mobile-alt"></i>
                            <p>{{$contact->phone}}</p>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-sm-4 mb-4 mb-lg-0">
                    <h6 class="widget_title">Useful Links</h6>
                    <ul class="list_none widget_links links_style2">
                        <li><a href="{{route('about')}}">About Us</a></li>
                        <li><a href="{{route('faculty')}}">Faculty</a></li>
                        {{-- <li><a href="#">Achievements</a></li> --}}
                        <li><a href="{{route('more.gallery')}}">Gallery</a></li>
                        <li><a href="{{route('contact.us')}}">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="widget_title">Recent News</h6>
                    <ul class="recent_post border_bottom_dash list_none">
                        @foreach($home_news as $news)
                        <li>
                            <div class="post_footer">

                                <div class="post_content">
                                    <h6><a href="{{route('read.more.news',$news['id'])}}">{{$news['title']}}</a></h6>
                                    <span class="post_date">{{date('d F, Y',strtotime($news['date']))}}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h6 class="widget_title">Recent Notice</h6>
                    <ul class="recent_post border_bottom_dash list_none">
                        @foreach($home_notice as $notice)
                        <li>
                            <div class="post_footer">

                                <div class="post_content">
                                    <h6><a href="{{route('notice',$notice['id'])}}">{{$notice['title']}}</a></h6>
                                    <span class="post_date">{{date('d F, Y',strtotime($notice['date']))}}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach


                    </ul>
                    <h6 class="widget_title">Follow Us</h6>
                    <ul class="list_none social_icons social_white social_style1">
                        <li><a href="{{$follow_us['facebook_url']}}" target="_blank"><i class="ion-social-facebook"></i></a></li>
                        <li><a href="{{$follow_us['twitter_url']}}" target="_blank"><i class="ion-social-twitter"></i></a></li>
                        <li><a href="{{$follow_us['googleplus_url']}}" target="_blank"><i class="ion-social-googleplus"></i></a></li>
                        <li><a href="{{$follow_us['youtube_url']}}" target="_blank"><i class="ion-social-youtube-outline"></i></a></li>
                        <li><a href="{{$follow_us['instagram_url']}}" target="_blank"><i class="ion-social-instagram-outline"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_footer header_wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright m-md-0 text-center text-md-left">Copyrights © 2019 Nanosoft.  All rights reserved.</p>
                </div>

            </div>
        </div>
    </div>
</footer>


<!-- END FOOTER
