<?php

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccommodationAssetPackage extends Model
{
    use SoftDeletes, AccessModel;

    /**
     * The attributes that are mass assignable.`0  
     *
     * @var array
     */

    protected $fillable = [
        'accommodation_type_id', 'flat_type_id', 'accommodation_asset_type_id', 'accommodation_asset_id', 'total_no', 'created_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at'
    ];
}
