<?php

/*
Author: Naziur Rahman
Date: 22/03/2021

 */

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlatType extends Model
{
        use AccessModel, SoftDeletes;
  
    protected $fillable = [
        'name_bn','name','size', 'service_charge', 'created_by','updated_by'
    ];


    protected $hidden = [
        'deleted_at','created_by','updated_by'
    ];
}
