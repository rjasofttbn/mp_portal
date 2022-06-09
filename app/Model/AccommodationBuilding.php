<?php

/*
 Author: Naziur Rahman
Date: 22/03/2021
 */


namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccommodationBuilding extends Model
{
    use SoftDeletes, AccessModel;

    protected $fillable = ['name', 'name_bn', 'building_no', 'total_floor', 'area_id','accommodation_type_id'];

    

    public function areaInfo()
    {
        return $this->belongsTo(Area::class,'area_id','id');
    }

    public function accommodationTypeInfo()
    {
        return $this->belongsTo(AccommodationType::class,'accommodation_type_id','id');
    }


   
    protected $hidden = [
        'deleted_at','created_by','updated_by'
    ];
}
