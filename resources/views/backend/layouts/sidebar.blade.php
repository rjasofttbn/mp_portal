@php
$user_role_array=Auth::user()->user_role;
if(count($user_role_array)==0){
$user_role = [];
}else{
foreach($user_role_array as $rolee){
$user_role[] = $rolee->role_id;
}
}
$nav_menus=[];
@endphp

@if(in_array(1, $user_role))
@php
$modules = App\Model\Module::where('status',1)->orderBy('sort', 'asc')->get();
foreach ($modules as $module) {
$nav_menus[$module->id]['name'] = (session()->get('language')=='bn')?($module->name_bn):$module->name;
$parents1 = App\Model\Menu::where('module_id', $module->id)->where('parent', 0)->where('status',1)->orderBy('sort', 'asc')->get();
foreach ($parents1 as $parent1){
$nav_menus[$module->id]['menus'][$parent1->id]['menu_name']=(session()->get('language')=='bn')?($parent1->name_bn):$parent1->name;
$nav_menus[$module->id]['menus'][$parent1->id]['menu_route']=$parent1->route;
$nav_menus[$module->id]['menus'][$parent1->id]['menu_icon']=$parent1->icon;
$parents2=App\Model\Menu::where('parent', $parent1->id)->where('status',1)->orderBy('sort', 'asc')->get();
foreach ($parents2 as $parent2){
$nav_menus[$module->id]['menus'][$parent1->id]['child'][$parent2->id]['menu_name']=(session()->get('language')=='bn')?($parent2->name_bn):$parent2->name;
$nav_menus[$module->id]['menus'][$parent1->id]['child'][$parent2->id]['menu_route']=$parent2->route;
$nav_menus[$module->id]['menus'][$parent1->id]['child'][$parent2->id]['menu_icon']=$parent2->icon;
$parents3=App\Model\Menu::where('parent', $parent2->id)->where('status',1)->orderBy('sort', 'asc')->get();
foreach ($parents3 as $parent3){
$nav_menus[$module->id]['menus'][$parent1->id]['child'][$parent2->id]['child'][$parent3->id]['menu_name']=(session()->get('language')=='bn')?($parent3->name_bn):$parent3->name;
$nav_menus[$module->id]['menus'][$parent1->id]['child'][$parent2->id]['child'][$parent3->id]['menu_route']=$parent3->route;
$nav_menus[$module->id]['menus'][$parent1->id]['child'][$parent2->id]['child'][$parent3->id]['menu_icon']=$parent3->icon;
$parents4=App\Model\Menu::where('parent', $parent3->id)->where('status',1)->orderBy('sort', 'asc')->get();
foreach ($parents4 as $parent4){
$nav_menus[$module->id]['menus'][$parent1->id]['child'][$parent2->id]['child'][$parent3->id]['child'][$parent4->id]['menu_name']=(session()->get('language')=='bn')?($parent4->name_bn):$parent4->name;
$nav_menus[$module->id]['menus'][$parent1->id]['child'][$parent2->id]['child'][$parent3->id]['child'][$parent4->id]['menu_route']=$parent4->route;
$nav_menus[$module->id]['menus'][$parent1->id]['child'][$parent2->id]['child'][$parent3->id]['child'][$parent4->id]['menu_icon']=$parent4->icon;
$parents4=App\Model\Menu::where('parent', $parent3->id)->where('status',1)->orderBy('sort', 'asc')->get();
}
}
}
}
}
@endphp
@else
@php
$modules = App\Model\Module::where('status',1)->orderBy('sort', 'asc')->get();
foreach ($modules as $module) {
$nav_menus[$module->id]['name'] = (session()->get('language')=='bn')?($module->name_bn):$module->name;
$parents1 = App\Model\Menu::where('module_id', $module->id)->where('parent', 0)->whereNotIn('id',[1,2])->where('status',1)->orderBy('sort', 'asc')->get();
foreach ($parents1 as $parent1){
if(App\Model\MenuPermission::where('menu_id',$parent1->id)->whereIn('role_id',@$user_role)->first()){
$nav_menus[$module->id]['menus'][$parent1->id]['menu_name']=(session()->get('language')=='bn')?($parent1->name_bn):$parent1->name;
$nav_menus[$module->id]['menus'][$parent1->id]['menu_route']=$parent1->route;
$nav_menus[$module->id]['menus'][$parent1->id]['menu_icon']=$parent1->icon;
$parents2=App\Model\Menu::where('parent', $parent1->id)->where('status',1)->orderBy('sort', 'asc')->get();
foreach ($parents2 as $parent2){
if(App\Model\MenuPermission::where('menu_id',$parent2->id)->whereIn('role_id',@$user_role)->first()){
$nav_menus[$module->id]['menus'][$parent1->id]['child'][$parent2->id]['menu_name']=(session()->get('language')=='bn')?($parent2->name_bn):$parent2->name;
$nav_menus[$module->id]['menus'][$parent1->id]['child'][$parent2->id]['menu_route']=$parent2->route;
$nav_menus[$module->id]['menus'][$parent1->id]['child'][$parent2->id]['menu_icon']=$parent2->icon;
$parents3=App\Model\Menu::where('parent', $parent2->id)->where('status',1)->orderBy('sort', 'asc')->get();
foreach ($parents3 as $parent3){
if(App\Model\MenuPermission::where('menu_id',$parent3->id)->whereIn('role_id',@$user_role)->first()){
$nav_menus[$module->id]['menus'][$parent1->id]['child'][$parent2->id]['child'][$parent3->id]['menu_name']=(session()->get('language')=='bn')?($parent3->name_bn):$parent3->name;
$nav_menus[$module->id]['menus'][$parent1->id]['child'][$parent2->id]['child'][$parent3->id]['menu_route']=$parent3->route;
$nav_menus[$module->id]['menus'][$parent1->id]['child'][$parent2->id]['child'][$parent3->id]['menu_icon']=$parent3->icon;
$parents4=App\Model\Menu::where('parent', $parent3->id)->where('status',1)->orderBy('sort', 'asc')->get();
foreach ($parents4 as $parent4){
if(App\Model\MenuPermission::where('menu_id',$parent4->id)->whereIn('role_id',@$user_role)->first()){
$nav_menus[$module->id]['menus'][$parent1->id]['child'][$parent2->id]['child'][$parent3->id]['child'][$parent4->id]['menu_name']=(session()->get('language')=='bn')?($parent4->name_bn):$parent4->name;
$nav_menus[$module->id]['menus'][$parent1->id]['child'][$parent2->id]['child'][$parent3->id]['child'][$parent4->id]['menu_route']=$parent4->route;
$nav_menus[$module->id]['menus'][$parent1->id]['child'][$parent2->id]['child'][$parent3->id]['child'][$parent4->id]['menu_icon']=$parent4->icon;
$parents5=App\Model\Menu::where('parent', $parent4->id)->where('status',1)->orderBy('sort', 'asc')->get();
}
}
}
}
}
}
}
}
}
@endphp
@endif

<aside class="main-sidebar elevation-4 sidebar-dark-navy">
    <a href="{{route('dashboard')}}" class="brand-link text-sm navbar-navy">
        <img src="{{asset('public/backend/img/parliament-logo.png')}}" alt="Admin Dashboard" class="brand-image img-circle elevation-3" style="opacity: .8; width: 30px;">
        <span class="brand-text font-weight-light">@lang('MP Portal')</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2" id="swupMenu">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>@lang('Dashboard')</p>
                    </a>
                </li>
                @foreach($nav_menus as $nav_menu)
                @if(@$nav_menu['menus'])
                @if(@$nav_menu['name'])
                <li class="nav-header">{{$nav_menu['name']}}</li>
                @endif
                @foreach($nav_menu['menus'] as $nav_menu1)
                @if(@$nav_menu1['child'] != null)
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far {{(($nav_menu1['menu_icon'])?($nav_menu1['menu_icon']):'fa-circle')}}"></i>
                        <p>
                            {{$nav_menu1['menu_name']}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach($nav_menu1['child'] as $nav_menu2)
                        @if(@$nav_menu2['child'] != null)
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link {{ $child1 == $nav_menu2['menu_route'] ? 'active' : '' }}">
                                <i class="nav-icon far {{(($nav_menu2['menu_icon'])?($nav_menu2['menu_icon']):'fa-circle')}}"></i>
                                <p>
                                    {{$nav_menu2['menu_name']}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach($nav_menu2['child'] as $nav_menu3)
                                @if(@$nav_menu3['child'] != null)
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon far {{(($nav_menu3['menu_icon'])?($nav_menu3['menu_icon']):'fa-circle')}}"></i>
                                        <p>
                                            {{$nav_menu3['menu_name']}}
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @foreach($nav_menu3['child'] as $nav_menu4)
                                        @if(@$nav_menu4['child'] != null)
                                        <li class="nav-item has-treeview">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon far {{(($nav_menu4['menu_icon'])?($nav_menu4['menu_icon']):'fa-circle')}}"></i>
                                                <p>
                                                    {{$nav_menu4['menu_name']}}
                                                    <i class="right fas fa-angle-left"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview">
                                                @foreach($nav_menu4['child'] as $nav_menu5)
                                                @if(@$nav_menu5['child'] != null)
                                                <li class="nav-item has-treeview">
                                                    <a href="#" class="nav-link">
                                                        <i class="nav-icon far {{(($nav_menu5['menu_icon'])?($nav_menu5['menu_icon']):'fa-circle')}}"></i>
                                                        <p>
                                                            {{$nav_menu5['menu_name']}}
                                                            <i class="right fas fa-angle-left"></i>
                                                        </p>
                                                    </a>
                                                </li>
                                                @else
                                                <li class="nav-item">
                                                    <a href="{{($nav_menu5['menu_route'] == '#')?('#'):route($nav_menu5['menu_route'])}}" class="nav-link" data-swup>
                                                        <i class="nav-icon far {{(($nav_menu5['menu_icon'])?($nav_menu5['menu_icon']):'fa-circle')}}"></i>
                                                        <p>
                                                            {{$nav_menu5['menu_name']}}
                                                        </p>
                                                    </a>
                                                </li>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                        @else
                                        <li class="nav-item">
                                            <a href="{{($nav_menu4['menu_route'] == '#')?('#'):route($nav_menu4['menu_route'])}}" class="nav-link" data-swup>
                                                <i class="nav-icon far {{(($nav_menu4['menu_icon'])?($nav_menu4['menu_icon']):'fa-circle')}}"></i>
                                                <p>
                                                    {{$nav_menu4['menu_name']}}
                                                </p>
                                            </a>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a href="{{($nav_menu3['menu_route'] == '#')?('#'):route($nav_menu3['menu_route'])}}" class="nav-link" data-swup>
                                        <i class="nav-icon far {{(($nav_menu3['menu_icon'])?($nav_menu3['menu_icon']):'fa-circle')}}"></i>
                                        <p>
                                            {{$nav_menu3['menu_name']}}
                                        </p>
                                    </a>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{($nav_menu2['menu_route'] == '#')?('#'):route($nav_menu2['menu_route'])}}" class="nav-link" data-swup>
                                <i class="nav-icon far {{(($nav_menu2['menu_icon'])?($nav_menu2['menu_icon']):'fa-circle')}}"></i>
                                <p>
                                    {{$nav_menu2['menu_name']}}
                                </p>
                            </a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{($nav_menu1['menu_route'] == '#')?('#'):route($nav_menu1['menu_route'])}}" class="nav-link" data-swup>
                        <i class="nav-icon far {{(($nav_menu1['menu_icon'])?($nav_menu1['menu_icon']):'fa-circle')}}"></i>
                        <p>
                            {{$nav_menu1['menu_name']}}
                        </p>
                    </a>
                </li>
                @endif
                @endforeach
                @endif
                @endforeach



                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-th-large"></i>
                        <p>
                            @lang('Master Setup')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{route('admin.master_setup.ministries.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Ministry')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.master_setup.ministry_wings.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Ministry Wings')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.master_setup.constituencies.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Constituency')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.master_setup.departments.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Department')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.master_setup.designations.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Designation')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.master_setup.parliaments.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Parliament')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.master_setup.parliament_sessions.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Parliament Session')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.master_setup.political_parties.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Political Party')</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.master_setup.divisions.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Division')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.master_setup.districts.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('District')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.master_setup.upazilas.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Upazila')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon fa fa-address-card"></i>
                                <p>@lang('SongShod Bhaban')
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.master_setup.songshodBlock.index')}}" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('Block')</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.master_setup.songshodFloor.index')}}" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('Floor')</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.master_setup.songshodRoom.index')}}" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('Room')</p>
                                    </a>
                                </li>
                            </ul>

                        </li>

                    </ul>
                </li>



                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-box"></i>
                        <p>@lang('Procedures of Day')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('/admin/master-setup/orderofdays')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Orders of Day')</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-header">@lang('Profile & Activities')</li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-address-card"></i>
                        <p>@lang('Profile & Activities')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.profile_activities.profiles.index') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Profile')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.profile_activities.mpbooks.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('MP Book')</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{url('/admin/attendance/mp-attendance')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('MP Attendance')</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.attendance.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Attendance List')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Application')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.profile_activities.appointments.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Appointment')</p>
                            </a>
                        </li>
                        {{-- Personal Secretary menu --}}
                        <li class="nav-item">
                            <a href="{{route('admin.master_setup.personal_secretaries.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Personal Secretary')</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-header">@lang('Notice Management')</li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>@lang('Setup')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.notice_management.parliament_rules.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Rule')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/notice-management/circulars')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Circulars')</p>
                            </a>
                        </li>
                        {{-- Standing Committee menu --}}
                        <li class="nav-item">
                            <a href="{{route('admin.master_setup.standing_committees.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Standing Committee')</p>
                            </a>
                        </li>
                        {{-- Assessment Committee menu --}}
                        <li class="nav-item">
                            <a href="{{route('admin.master_setup.assessment_committees.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Assessment Committee')</p>
                            </a>
                        </li>
                        {{-- Parliament Bill setup menu --}}
                        <li class="nav-item">
                            <a href="{{route('admin.master_setup.parliament_bills.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Parliamentary Bill')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.notice_management.noticestage.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Notice Stages')</p>
                            </a>
                        </li>
                    </ul>

                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-user-tie"></i>
                        <p>@lang('Parliament Member')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.notice_management.notices.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Add Notice')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Notice List')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Notice Monitoring')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/notice-management/notices/notice/priority')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Priority Set for Notice')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/notice-management/notices/notice/notify-ministry/mp')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Notice in Ministry')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/notice-management/notices/notice/recent-discussion/mp')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Recent Public Issue')</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-clipboard-list"></i>
                        <p>@lang('Notice Department')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Notice Monitoring')</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-question-circle"></i>
                        <p>@lang('Question & Answer Department')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Notice Monitoring')</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-book"></i>
                        <p>@lang('Law Department 1')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.notice_management.notices.index')}}/index/1" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Set Notice Status')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.notice_management.notices.index')}}/index/5" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Approved List')</p>
                            </a>
                        </li>
                        <li class="nav-item" id="test_menu">
                            <a href="#" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Bill Amendment List')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Bill Clause Amendment List')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-balance-scale"></i>
                        <p>@lang('Law Department 2')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.notice_management.notices.index')}}/index/1" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Set Notice Status')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.notice_management.notices.index')}}/index/5" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Approved List')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.notice_management.notices.index')}}/index/5" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Ballot Acceptable List')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/notice-management/notices/notice/notify-ministry')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Notify to Ministry')</p>
                            </a>
                        </li>

                        
                        <li class="nav-item">
                            <a href="#" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Bill/Clause Amendment Member List')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Set Yes/No Status')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-dungeon"></i>
                        <p>@lang('Deferral & Rights Department')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.notice_management.notices.index')}}/index/1" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Set Notice Status')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.notice_management.notices.index')}}/index/6" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Acceptable List')</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-landmark"></i>
                        <p>@lang('Speaker Activities')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.notice_management.notices.index')}}/index/6" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Notice Approval')</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{url('/admin/notice-management/notices/notice/report')}}" class="nav-link ">
                        <i class="fa fa-list nav-icon"></i>
                        <p>@lang('Reports')</p>
                    </a>
                </li>

                <li class="nav-header">@lang('Petition Management')</li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>@lang('Setup')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.petition_management.petition_committees.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Petition Committee')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.petition_management.petitionstage.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Petition Stages')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-user-tie"></i>
                        <p>@lang('Parliament Member')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Application')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Application List')</p>
                            </a>
                        </li>

                    </ul>
                </li>
                

                <li class="nav-header">@lang('Accommodation Management')</li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>@lang('Setup')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.accommodation-management.setup.areas.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Area')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.accommodation.accommodation_types.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Accommodation Type')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.accommodation-management.setup.accommodationbuildings.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Building List')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.accommodation-management.setup.housebuildings.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('High Quality Housing List')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.accommodation-management.setup.flat_types.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Flat Type')</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.accommodation-management.setup.floorflats.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Floor & Flat')</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.accommodation-management.setup.flats.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Flat List')</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.accommodation-management.setup.application_types.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Application Type')</p>
                            </a>
                        </li>

                    </ul>

                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-user-tie"></i>
                        <p>@lang('Parliament Member')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.accommodation.applications.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Application')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/accommodation/applications/application/mp/appNewList')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Application List')</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-building"></i>
                        <p>@lang('Accommodation Department')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/accommodation/applications/application/dashboard')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Accommodation Dashboard')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/accommodation/applications/application/application_monitoring')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Application Monitoring')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/accommodation/applications/application/whip_application_monitoring')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Application Approval')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/accommodation/applications/application/logInformation')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Log Information')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">@lang('Hostel Management')</li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>@lang('Setup')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.accommodation-management.setup.hostel_buildings.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Building List')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.accommodation-management.setup.hostel_floors.index')}}" class="nav-link {{ 'hostel-room.index' == request()->path() ? 'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Block List')</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.accommodation-management.setup.office_rooms.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Block Or Office Room')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.accommodation-management.setup.office_room_types.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Office Room Type List')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.accommodation-management.setup.office.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Office Room Set Up')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.accommodation-management.setup.hostel_application_types.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Application Type')</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-user-tie"></i>
                        <p>@lang('Parliament Member')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.accommodation.hostel_application.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Application')</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{url('admin/accommodation/applications/hostel_application/hostel_application_list_mp')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Application List')</p>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-building"></i>
                        <p>@lang('Accommodation Department')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{url('admin/accommodation/applications/application/hostel_application_monitoring')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Application Approval')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-h-square"></i>
                        <p>@lang('Whips Department')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/accommodation/applications/application/whip_hostel_application_monitoring')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('New Allotment List')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">@lang('Requsition management')</li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>@lang('Setup')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.requisition.telephone_pabx_rights.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Telephone / PABX rights')</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.requisition.office_wise_telephone_pabx.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Office Room Based Telephone / PABX Number')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.requisition.telephoneExpensesCashAllowance.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Telephone expenses and cash allowance')</p>
                            </a>
                        </li>
                    </ul>
                <li class="nav-item">
                    <a href="{{route('admin.requisition.telephone_pabx_application.index')}}" class="nav-link">
                        <i class="fas fa-phone nav-icon"></i>
                        <p>@lang('Telephone / PABX application')</p>
                    </a>
                </li>
                </li>
                <li class="nav-header">@lang('Furniture/Goods Management')</li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>@lang('Setup')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.accommodation-asset-management.setup.accommodation_assets.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Furniture/Electrical Goods Name')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.accommodation-asset-management.setup.furniture_electronic_goods.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Furniture/Electrical Goods Add')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.accommodation-asset-management.setup.accommodation-asset-package.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Furniture/Electrical Package')</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>@lang('Appointment Management')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.appointment-management.appointment-request.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Appointment Request')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.appointment-management.appointment-received.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('Appointment Received')</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<script type="text/javascript">
    $(document).ready(function() {
        var mylist = [];
        var list_counter = 1;
        $(".nav-item a").each(function() {
            if ($(this).attr('href') != '#') {
                mylist.push({
                    id: list_counter++,
                    name: $(this).attr('href')
                });
            }
        });
        navigationMenu(mylist);

        function highlight_navigation(list_array) {
            var path = window.location.href;
            path = path.replace(/\/$/, "");
            path = decodeURIComponent(path);
            var max_value = [];
            for (var i = 0; i < list_array.length; i++) {
                var percent = similar(list_array[i].name, path);
                max_value.push({
                    'name': list_array[i].name,
                    'percent': percent
                });
            }
            var xValues = max_value.map(function(o) {
                return o.percent;
            });
            xValues = Array.from(max_value, o => o.percent);
            var xMax = Math.max.apply(null, xValues);
            xMax = Math.max(...xValues);
            var maxXObjects = max_value.filter(function(o) {
                return o.percent === xMax;
            });
            var the_arr = maxXObjects[0].name.split('/');
            return (the_arr.join('/'));
        }

        function navigationMenu(menu_array = null) {
            var url;
            var url_path = window.location.pathname;
            if (menu_array == null) {
                url = window.location.href;
            } else {
                if (menu_array.some(item => item.name === url_path)) {
                    url = window.location.href;
                } else {
                    url = highlight_navigation(menu_array);
                }
            }
            $('.nav-item a[href="' + url + '"]').addClass('active');
            $('.nav-item a[href="' + url + '"]').parents('ul').css('display', 'block');
            $('.nav-item a[href="' + url + '"]').parents('li').addClass('nav-item menu-open');
            $('.nav-item a').filter(function() {
                return this.href == url;
            }).addClass('active');
        }
    });
</script>