<?php

namespace App\Traits;

use Illuminate\Http\Request;
use DB;

trait UsefulLibraryTrait {

    
    public function duplicateCheck($checkData){


        $table=$checkData['table'];      
        $key=$checkData['key'];
        $value=$checkData['value'];      
       
        if( DB::table($table)->where($key,$value)->exists()){
            return true;
        }else{
            return false;

        }
    }

}

