<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait BengaliLibraryTrait {

    
   public function en2bnNumber ($number){
        $bnNumber= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        $enNumber= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        $convertednumber = str_replace($enNumber,  $bnNumber, $number);
    
        return $convertednumber;
    }

}