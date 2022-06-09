<!-- START HEADER -->
<header class="header_wrap dark_skin">
    <div class="top-header bg_linen light_skin">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="main-logo text-center">
                        <img class="logo_dark img-responsive img-fluid" src="{{asset('public/frontend/images/logo.png')}}" alt="logo" />
                    </div>
                    <div class="tagline">
                        <img class="logo_dark img-responsive img-fluid" src="{{asset('public/frontend/images/logo.jpg')}}" alt="logo" style="padding-left: 15px;width: 513px;height: 73px;" />
                    </div>  
                </div>
                <div class="col-md-5">
                    <nav class="navbar navbar-expand-lg"> 
                        <ul class="navbar-nav">
                            <li class="dropdown">
                                <a class="btn btn-outline-danger" href="#" data-toggle="dropdown">Campus Life</a>
                            </li>
                            <li class="dropdown">
                                <a class="btn btn-outline-danger" href="#" data-toggle="dropdown">Apply</a>
                            </li>
                            <li class="dropdown">
                                <a class="btn btn-outline-danger" href="#" data-toggle="dropdown">Achievement</a>
                            </li>
                            <li class="dropdown">
                                <a class="btn btn-outline-danger" href="#" data-toggle="dropdown">Alumni</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav attr-nav align-items-center">
                            <li><a href="javascript:void(0);" class="nav-link search_trigger "><i class="ion-ios-search-strong"></i></a>
                                <div class="search-overlay">
                                    <div class="search_wrap">
                                        <form>
                                            <input type="text" placeholder="Search" class="form-control" id="search_input">
                                            <button type="submit" class="search_icon"><i class="ion-ios-search-strong"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div> 
            </div>
        </div>
    </div>
    <div class="container">
        <nav class="navbar navbar-expand-lg"> 
            <a class="navbar-brand" href="{{url('')}}"> 
                <img class="home-icon" src="{{asset('public/frontend/logo/home.png')}}">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="ion-android-menu"></span> </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav">



                    <?php $parents = DB::table('frontend_menus')->where('parent_id','0')->orderBy('sort_order','asc')->get();?>
                    @if(count($parents) != 0)
                    @foreach($parents as $parent)
                    <?php $parents = DB::table('frontend_menus')->where('parent_id',$parent->rand_id)->orderBy('sort_order','asc')->get();?>
                    <li class="dropdown">
                        <a class="{{(count($parents) != 0)?('dropdown-toggle'):''}} nav-link" href="{{($parent->url_link)?(route('menu_url',$parent->url_link)):'#'}}"  {{(count($parents) != 0)?('data-toggle="dropdown"'):''}} >{{$parent->title_en}}</a>
                        @if(count($parents) != 0)
                        <div class="dropdown-menu">
                            <ul> 
                                @foreach($parents as $parent)
                                <?php $parents = DB::table('frontend_menus')->where('parent_id',$parent->rand_id)->orderBy('sort_order','asc')->get();?>
                                <li class="{{(count($parents) != 0)?('dropdown'):''}}">
                                    <a class="{{(count($parents) != 0)?('dropdown-toggler'):''}} dropdown-item nav-link nav_item" href="{{($parent->url_link)?(route('menu_url',$parent->url_link)):'#'}}">{{$parent->title_en}}</a>
                                    @if(count($parents) != 0)
                                    <div class="dropdown-menu">
                                        <ul> 
                                            @foreach($parents as $parent)
                                            <?php $parents = DB::table('frontend_menus')->where('parent_id',$parent->rand_id)->orderBy('sort_order','asc')->get();?>
                                            <li class="{{(count($parents) != 0)?('dropdown'):''}}">
                                                <a class="{{(count($parents) != 0)?('dropdown-toggler'):''}} dropdown-item nav-link nav_item" href="{{($parent->url_link)?(route('menu_url',$parent->url_link)):'#'}}">{{$parent->title_en}}</a>
                                                @if(count($parents) != 0)
                                                <div class="dropdown-menu">
                                                    <ul> 
                                                        @foreach($parents as $parent)
                                                        <?php $parents = DB::table('frontend_menus')->where('parent_id',$parent->rand_id)->orderBy('sort_order','asc')->get();?>
                                                        <li class="{{(count($parents) != 0)?('dropdown'):''}}">
                                                            <a class="{{(count($parents) != 0)?('dropdown-toggler'):''}} dropdown-item nav-link nav_item" href="{{($parent->url_link)?(route('menu_url',$parent->url_link)):'#'}}">{{$parent->title_en}}</a>
                                                            @if(count($parents) != 0)
                                                            <div class="dropdown-menu">
                                                                <ul> 
                                                                    @foreach($parents as $parent)
                                                                    <?php $parents = DB::table('frontend_menus')->where('parent_id',$parent->rand_id)->orderBy('sort_order','asc')->get();?>
                                                                    <li class="{{(count($parents) != 0)?('dropdown'):''}}">
                                                                        <a class="{{(count($parents) != 0)?('dropdown-toggler'):''}} dropdown-item nav-link nav_item" href="{{($parent->url_link)?(route('menu_url',$parent->url_link)):'#'}}">{{$parent->title_en}}</a>
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            @endif
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </li>
                    @endforeach
                    @endif







                </ul>
            </div>
        </nav>
    </div>
</header>


<!-- END HEADER --> 