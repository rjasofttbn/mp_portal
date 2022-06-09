<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Session;

class IsDeveloper
{
    public function handle($request, Closure $next)
    {
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
        }
        return redirect()->route('dashboard')->with('error',((session()->get('language')=='bn')?('আপনি এই ম্যানুর জন্য অনুমোদন প্রাপ্ত নন'):'Access Permission Denied'));

    }
}

