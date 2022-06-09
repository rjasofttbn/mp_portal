<?php

namespace App\Http\Middleware;

use App\Model\Menu;
use App\Model\MenuPermission;
use App\Model\MenuRoute;
use Auth;
use Closure;
use Session;
class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next){
        $route=$request->route()->getName();         
        $user_role_array=authInfo()->user_role;
        if(count($user_role_array)==0){
            $user_role = [];
        }else{
            foreach($user_role_array as $rolee){
                $user_role[] = $rolee->role_id;
            }
        }

        if(in_array(1, $user_role)){
            return $next($request);        
        }else{
            $mainmenu = Menu::where('route',$route)->first();
            $mainmenuroute = MenuRoute::with(['menu'])->where('route',$route)->first();
            if($mainmenu != null || $mainmenuroute != null){
                $permission=MenuPermission::whereIn('role_id',$user_role)->where('permitted_route',$route)->first();
                if($permission){
                    return $next($request);
                }else{  
        return redirect()->route('dashboard')->with('error',((session()->get('language')=='bn')?('আপনি এই ম্যানুর জন্য অনুমোদন প্রাপ্ত নন'):'Access Permission Denied'));
                }
            }else{
                return $next($request);
            }
        }
    }





}
