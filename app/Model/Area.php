<?php


/*
 Author: Naziur Rahman
 Date: 22/03/2021
 */


namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{

    use SoftDeletes;

    protected $table = "areas";

  
    protected $fillable = [
        'name', 'name_bn','created_at','updated_at', 'created_by','updated_by'
    ];


    protected $hidden = [
        'deleted_at','created_by','updated_by'
    ];
}
