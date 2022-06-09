<?php


/*
Author: Naziur Rahman
Date: 5/05/2021

 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flat extends Model
{
    
    use SoftDeletes, AccessModel;

  

    protected $fillable = [
        'number','floor_id','building_id','flat_type_id','created_by','updated_by'
    ];


    public function building() {
        return $this->belongsTo(AccommodationBuilding::class, 'building_id');
    }
    public function flatType() {
        return $this->belongsTo(FlatType::class, 'flat_type_id');
    }
    public function area()
    {
        return $this->belongsTo(Area::class,'area_id');
    }
    public function floor()
    {
        return $this->belongsTo(Floor::class,'floor_id');
    }

    protected $hidden = [
        'deleted_at','created_by','updated_by'
    ];

}
