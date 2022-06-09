<?php

namespace App\Model;

use App\Model\AccommodationAsset;
use App\Model\AccommodationBuilding;
use App\Model\Area;
use App\Traits\AccessModel;
use App\Model\AccommodationAssetType;
use Illuminate\Database\Eloquent\Model;
use App\Model\AccommodationType;
use Illuminate\Database\Eloquent\SoftDeletes;

class FurnitureElectronicGood extends Model
{
    use SoftDeletes, AccessModel;

  
    /**
     * The attributes that are mass assignable.`0  
     *
     * @var array
     */

    protected $fillable = [
        'area_id',
        'accommodation_type_id'
        ,'accommodation_building_id'
        ,'accommodation_asset_type_id'
        ,'accommodation_asset_id'
        ,'total_no'
        ,'created_by'
        ,'updated_by'
    ];

  /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function accommodation_type()
    {
        return $this->belongsTo(AccommodationType::class, 'accommodation_type_id', 'id');
    }

    public function accommodation_building()
    {
        return $this->belongsTo(AccommodationBuilding::class, 'accommodation_building_id', 'id');
    }

    public function accommodation_asset_type()
    {
        return $this->belongsTo(AccommodationAssetType::class, 'accommodation_asset_type_id', 'id');
    }

    public function accommodation_asset()
    {
        return $this->belongsTo(AccommodationAsset::class, 'accommodation_asset_id', 'id');
    }

}
