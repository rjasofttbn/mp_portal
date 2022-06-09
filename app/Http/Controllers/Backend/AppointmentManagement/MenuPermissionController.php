<?php

namespace App\Http\Controllers\Backend\UserManagement;

use App\Http\Controllers\Controller;
use App\Model\Menu;
use App\Model\MenuPermission;
use App\Model\MenuRoute;
use App\Model\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class MenuPermissionController extends Controller
{
    public function list(Request $request){   
        $data['roles'] = Role::where('id','!=',1)->orderBy('sort','asc')->get();
        $data['modules'] = Menu::where('parent',0)->where([['id','!=',1],['status','1']])->orderBy('sort','asc')->get();
        if($request->menu_id){
            $parent_menu = Menu::where('parent',0)->where([['id','!=',1],['status','1']])->whereIn('id',$request->menu_id)->orderBy('sort','asc')->get();
        }else{
            $parent_menu = Menu::where('parent',0)->where([['id','!=',1],['status','1']])->orderBy('sort','asc')->get();
        }
        if($request->user_role){
            $data['menus'] =[];
            foreach ($parent_menu as $key => $pmenu) {
                $data['menus'][$pmenu->id]['id']= $pmenu->id;
                $data['menus'][$pmenu->id]['name']= (session()->get('language')=='bn')?($pmenu->name_bn):$pmenu->name;
                $data['menus'][$pmenu->id]['route']= $pmenu->route;
                $data['menus'][$pmenu->id]['menu_from']= 'menu'; 
                $child_menu = Menu::where('parent',$pmenu->id)->where([['id','!=',1],['status','1']])->orderBy('sort','asc')->get();
                if(count($child_menu)>0){
                    foreach ($child_menu as $key => $cmenu) {
                        $data['menus'][$pmenu->id]['child'][$cmenu->id]['id']= $cmenu->id;
                        $data['menus'][$pmenu->id]['child'][$cmenu->id]['name']= (session()->get('language')=='bn')?($cmenu->name_bn):$cmenu->name;
                        $data['menus'][$pmenu->id]['child'][$cmenu->id]['route']= $cmenu->route;
                        $data['menus'][$pmenu->id]['child'][$cmenu->id]['menu_from']= 'menu';  
                        $child_child_menu = Menu::where('parent',$cmenu->id)->where([['id','!=',1],['status','1']])->orderBy('sort','asc')->get();
                        if(count($child_child_menu)>0){
                            foreach ($child_child_menu as $key => $ccmenu) {
                                $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['id']= $ccmenu->id;
                                $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['name']= (session()->get('language')=='bn')?($ccmenu->name_bn):$ccmenu->name;
                                $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['route']= $ccmenu->route;
                                $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['menu_from']= 'menu';  
                                $child_child_child_menu = Menu::where('parent',$ccmenu->id)->where([['id','!=',1],['status','1']])->orderBy('sort','asc')->get();
                                if(count($child_child_child_menu)>0){
                                    foreach ($child_child_child_menu as $key => $cccmenu) {
                                        $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['child'][$cccmenu->id]['id']= $cccmenu->id;
                                        $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['child'][$cccmenu->id]['name']= (session()->get('language')=='bn')?($cccmenu->name_bn):$cccmenu->name;
                                        $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['child'][$cccmenu->id]['route']= $cccmenu->route;
                                        $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['child'][$cccmenu->id]['menu_from']= 'menu';  
                                        $menu_route = MenuRoute::where('menu_id',$cccmenu->id)->where('status','1')->orderBy('sort','asc')->get();
                                        $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['child'][$cccmenu->id]['menu_route']['0']['id']= $cccmenu->id;                        
                                        $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['child'][$cccmenu->id]['menu_route']['0']['name']= (session()->get('language')=='bn')?('বিস্তারিত'):'View';;                        
                                        $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['child'][$cccmenu->id]['menu_route']['0']['route']= $cccmenu->route;                      
                                        $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['child'][$cccmenu->id]['menu_route']['0']['menu_from']= 'menu';                        
                                        $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['child'][$cccmenu->id]['menu_route']['0']['permission']= MenuPermission::where('menu_id',$cccmenu->id)->where('role_id',$request->user_role)->where('menu_from','menu')->first();
                                        foreach ($menu_route as $key => $mrmenu) {
                                            $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['child'][$cccmenu->id]['menu_route'][$mrmenu->id]['id']= $mrmenu->id;                        
                                            $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['child'][$cccmenu->id]['menu_route'][$mrmenu->id]['name']= (session()->get('language')=='bn')?($mrmenu->name_bn):$mrmenu->name;                        
                                            $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['child'][$cccmenu->id]['menu_route'][$mrmenu->id]['route']= $mrmenu->route;                        
                                            $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['child'][$cccmenu->id]['menu_route'][$mrmenu->id]['menu_from']= 'menu_route';                        
                                            $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['child'][$cccmenu->id]['menu_route'][$mrmenu->id]['permission']= MenuPermission::where('menu_id',$mrmenu->id)->where('role_id',$request->user_role)->where('menu_from','menu_route')->first();
                                        }
                                    }
                                }else{
                                    $menu_route = MenuRoute::where('menu_id',$ccmenu->id)->where('status','1')->orderBy('sort','asc')->get();
                                    $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['child']= null;
                                    $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['menu_route']['0']['id']= $ccmenu->id;                        
                                    $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['menu_route']['0']['name']= (session()->get('language')=='bn')?('বিস্তারিত'):'View';;                        
                                    $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['menu_route']['0']['route']= $ccmenu->route;                        
                                    $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['menu_route']['0']['menu_from']= 'menu';                        
                                    $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['menu_route']['0']['permission']= MenuPermission::where('menu_id',$ccmenu->id)->where('role_id',$request->user_role)->where('menu_from','menu')->first();
                                    foreach ($menu_route as $key => $mrmenu) {
                                        $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['menu_route'][$mrmenu->id]['id']= $mrmenu->id;                        
                                        $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['menu_route'][$mrmenu->id]['name']= (session()->get('language')=='bn')?($mrmenu->name_bn):$mrmenu->name;                        
                                        $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['menu_route'][$mrmenu->id]['route']= $mrmenu->route;                        
                                        $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['menu_route'][$mrmenu->id]['menu_from']= 'menu_route';                        
                                        $data['menus'][$pmenu->id]['child'][$cmenu->id]['child'][$ccmenu->id]['menu_route'][$mrmenu->id]['permission']= MenuPermission::where('menu_id',$mrmenu->id)->where('role_id',$request->user_role)->where('menu_from','menu_route')->first();
                                    }
                                }
                            }
                        }else{
                            $menu_route = MenuRoute::where('menu_id',$cmenu->id)->where('status','1')->orderBy('sort','asc')->get();
                            $data['menus'][$pmenu->id]['child'][$cmenu->id]['child']= null;
                            $data['menus'][$pmenu->id]['child'][$cmenu->id]['menu_route']['0']['id']= $cmenu->id;                        
                            $data['menus'][$pmenu->id]['child'][$cmenu->id]['menu_route']['0']['name']= (session()->get('language')=='bn')?('বিস্তারিত'):'View';;                        
                            $data['menus'][$pmenu->id]['child'][$cmenu->id]['menu_route']['0']['route']= $cmenu->route;                        
                            $data['menus'][$pmenu->id]['child'][$cmenu->id]['menu_route']['0']['menu_from']= 'menu';                        
                            $data['menus'][$pmenu->id]['child'][$cmenu->id]['menu_route']['0']['permission']= MenuPermission::where('menu_id',$cmenu->id)->where('role_id',$request->user_role)->where('menu_from','menu')->first();
                            foreach ($menu_route as $key => $mrmenu) {
                                $data['menus'][$pmenu->id]['child'][$cmenu->id]['menu_route'][$mrmenu->id]['id']= $mrmenu->id;                        
                                $data['menus'][$pmenu->id]['child'][$cmenu->id]['menu_route'][$mrmenu->id]['name']= (session()->get('language')=='bn')?($mrmenu->name_bn):$mrmenu->name;                        
                                $data['menus'][$pmenu->id]['child'][$cmenu->id]['menu_route'][$mrmenu->id]['route']= $mrmenu->route;                        
                                $data['menus'][$pmenu->id]['child'][$cmenu->id]['menu_route'][$mrmenu->id]['menu_from']= 'menu_route';                        
                                $data['menus'][$pmenu->id]['child'][$cmenu->id]['menu_route'][$mrmenu->id]['permission']= MenuPermission::where('menu_id',$mrmenu->id)->where('role_id',$request->user_role)->where('menu_from','menu_route')->first();
                            }
                        }
                    }
                }else{
                    $menu_route = MenuRoute::where('menu_id',$pmenu->id)->where('status','1')->orderBy('sort','asc')->get();
                    $data['menus'][$pmenu->id]['child']= null;
                    $data['menus'][$pmenu->id]['menu_route']['0']['id']= $pmenu->id;                        
                    $data['menus'][$pmenu->id]['menu_route']['0']['name']= (session()->get('language')=='bn')?('বিস্তারিত'):'View';;                        
                    $data['menus'][$pmenu->id]['menu_route']['0']['route']= $pmenu->route;
                    $data['menus'][$pmenu->id]['menu_route']['0']['menu_from']= 'menu';                        
                    $data['menus'][$pmenu->id]['menu_route']['0']['permission']= MenuPermission::where('menu_id',$pmenu->id)->where('role_id',$request->user_role)->where('menu_from','menu')->first();
                    foreach ($menu_route as $key => $mrmenu) {
                        $data['menus'][$pmenu->id]['menu_route'][$mrmenu->id]['id']= $mrmenu->id;                        
                        $data['menus'][$pmenu->id]['menu_route'][$mrmenu->id]['name']= (session()->get('language')=='bn')?($mrmenu->name_bn):$mrmenu->name;
                        $data['menus'][$pmenu->id]['menu_route'][$mrmenu->id]['route']= $mrmenu->route;                        
                        $data['menus'][$pmenu->id]['menu_route'][$mrmenu->id]['menu_from']= 'menu_route';                        
                        $data['menus'][$pmenu->id]['menu_route'][$mrmenu->id]['permission']= MenuPermission::where('menu_id',$mrmenu->id)->where('role_id',$request->user_role)->where('menu_from','menu_route')->first();
                    }
                }
            }
        }
        return view('backend.user-management.menu-permission-info.list',$data);
    }

    public function store(Request $request){
        $data = explode(',', $request->jsondata); 
        $role_id = $request->role_id;
        $menu_id = $request->menu_id;
        DB::transaction(function () use($data,$role_id,$menu_id){
            if($menu_id){
                MenuPermission::whereIn('menu_id',$menu_id)->where('role_id',$role_id)->where('menu_from','menu')->delete();
                $parent_menu = Menu::whereIn('id',$menu_id)->get();
                foreach ($parent_menu as $key => $pmenu) {
                    MenuPermission::where('menu_id',$pmenu->id)->where('role_id',$role_id)->where('menu_from','menu')->delete(); 
                    $child_menu = Menu::where('parent',$pmenu->id)->get();
                    if(count($child_menu)>0){
                        foreach ($child_menu as $key => $cmenu) {
                            MenuPermission::where('menu_id',$cmenu->id)->where('role_id',$role_id)->where('menu_from','menu')->delete(); 
                            $child_child_menu = Menu::where('parent',$cmenu->id)->get();
                            if(count($child_child_menu)>0){
                                foreach ($child_child_menu as $key => $ccmenu) {
                                    MenuPermission::where('menu_id',$ccmenu->id)->where('role_id',$role_id)->where('menu_from','menu')->delete(); 
                                    $child_child_child_menu = Menu::where('parent',$ccmenu->id)->get();
                                    if(count($child_child_child_menu)>0){
                                        foreach ($child_child_child_menu as $key => $cccmenu) {
                                            MenuPermission::where('menu_id',$cccmenu->id)->where('role_id',$role_id)->where('menu_from','menu')->delete(); 
                                            $menu_route = MenuRoute::where('menu_id',$cccmenu->id)->where('status','1')->orderBy('sort','asc')->get();
                                            foreach ($menu_route as $key => $mrmenu) {
                                                MenuPermission::where('menu_id',$mrmenu->id)->where('role_id',$role_id)->where('menu_from','menu_route')->delete(); 
                                            }
                                        }
                                    }else{
                                        MenuPermission::where('menu_id',$ccmenu->id)->where('role_id',$role_id)->where('menu_from','menu')->delete(); 
                                        $menu_route = MenuRoute::where('menu_id',$ccmenu->id)->where('status','1')->orderBy('sort','asc')->get();
                                        foreach ($menu_route as $key => $mrmenu) {
                                            MenuPermission::where('menu_id',$mrmenu->id)->where('role_id',$role_id)->where('menu_from','menu_route')->delete(); 
                                        }
                                    }
                                }
                            }else{
                                MenuPermission::where('menu_id',$cmenu->id)->where('role_id',$role_id)->where('menu_from','menu')->delete(); 
                                $menu_route = MenuRoute::where('menu_id',$cmenu->id)->where('status','1')->orderBy('sort','asc')->get();
                                foreach ($menu_route as $key => $mrmenu) {
                                    MenuPermission::where('menu_id',$mrmenu->id)->where('role_id',$role_id)->where('menu_from','menu_route')->delete(); 
                                }
                            }
                        }
                    }else{
                        MenuPermission::where('menu_id',$pmenu->id)->where('role_id',$role_id)->where('menu_from','menu')->delete(); 
                        $menu_route = MenuRoute::where('menu_id',$pmenu->id)->where('status','1')->orderBy('sort','asc')->get();
                        foreach ($menu_route as $key => $mrmenu) {
                            MenuPermission::where('menu_id',$mrmenu->id)->where('role_id',$role_id)->where('menu_from','menu_route')->delete(); 
                        }
                    }
                }
            }else{    
                MenuPermission::where('role_id', $role_id)->delete();
            }

            foreach ($data as $d){
                $split_data = explode('&', $d);
                if(@$split_data[1]){
                    $ifexist = MenuPermission::where('menu_id', $split_data[1])->where('role_id',$role_id)->where('permitted_route',$split_data[2])->where('menu_from',$split_data[3])->first();
                    if($ifexist == null){
                        $p = new MenuPermission;
                        $p->menu_id         = $split_data[1];
                        $p->role_id         = $role_id;
                        $p->permitted_route = $split_data[2];
                        $p->menu_from       = $split_data[3];
                        $p->save();
                    }                   
                }
            }
        });
    return response()->json(array('status' => 'success','message'=>Lang::get('Data Successfully Updated')));
}

}

