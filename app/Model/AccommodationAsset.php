<?php

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccommodationAsset extends Model
{
    use SoftDeletes, AccessModel;

    protected $table = "accommodation_assets";
    /**
     * The attributes that are mass assignable.`0  
     *
     * @var array
     */

    protected $fillable = [
       'accommodation_type_id','accommodation_asset_type_id', 'name', 'name_bn', 'status','created_by'
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
