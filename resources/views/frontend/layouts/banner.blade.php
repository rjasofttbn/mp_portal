
<section class="page-title-light breadcrumb_section parallax_bg overlay_bg_50" data-parallax-bg-image="{{asset('public/upload/banner/'.$banner->image)}}" style="position: relative; background: transparent; overflow: hidden; z-index: 1;"><div class="parallax-inner" style="position: absolute; background-image: url(&quot;assets/images/banner/banner.jpg&quot;); background-position: center center; background-repeat: no-repeat; background-size: cover; width: 1349px; height: 308px; transform: translate3d(0px, -132.5px, 0px); transition: transform 100ms ease 0s; z-index: -1;"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <h1>{{!empty($title_page)? $title_page:'Welcome'}}</h1>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-sm-end">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{!empty($page)? $page:'Page'}}</li>
                  </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
