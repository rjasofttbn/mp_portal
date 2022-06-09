<?php

/* 
Author: Naziur Rahman 
Date: 8/03/2021
 */

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;

class AccommodationType extends Model
{

    use  AccessModel;

    protected $fillable = ['name','name_bn','created_at','updated_at'];


    
}
