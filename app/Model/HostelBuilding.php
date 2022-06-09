<?php

namespace App\Model;


use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HostelBuilding extends Model
{
    //


    use SoftDeletes, AccessModel;


    protected $table = 'hostel_buildings';
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'name_bn',       
        'total_floor',       
        'status', 
        'created_by',
        'updated_by'
    ];
   
  



    protected $hidden = [
        'deleted_at'
    ];



}
