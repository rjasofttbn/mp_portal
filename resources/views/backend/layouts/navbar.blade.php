<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
</ul>

<ul class="navbar-nav ml-auto">
    <li class="nav-item">
        @if(session()->get('language') =='bn')
            <a class="nav-link btn btn-sm"href="{{route('language','en')}}" style="background: white;color: #17a2b8;border: 2px solid #17a2b8; line-height: 14px;">English</a>
        @else
            <a class="nav-link btn btn-sm"href="{{route('language','bn')}}" style="background: white;color: #17a2b8;border: 2px solid #17a2b8; line-height: 14px;">বাংলা</a>
        @endif
    </li>
    <li class="nav-item dropdown show">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
            @if(session()->get('language') =='bn')
                {{auth()->user()->name_bn}}
            @else
                {{auth()->user()->name}}
            @endif
            <img src="{{asset('public/backend/profile.jpg')}}" class="ml-2 img-circle elevation-2" alt="User Image" style="width: 24px;">
        </a>
        <div class="dropdown-menu dropdown-menu-right">
           <a href="{{route('profile-management.change.password')}}" class="dropdown-item" >  

                <i class="fas fa-lock"></i> Change Password
            </a>
            <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-lock"></i> Logout
            </a>
            <form style="display: none;" method="post" id="logout-form" action="{{route('logout')}}">
                @csrf
            </form>
        </div>
    </li>
</ul>
