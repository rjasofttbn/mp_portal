<?php

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfficeWiseTelephonePabx extends Model
{
    use SoftDeletes, AccessModel;
    protected $fillable = [
		'building_type',
		'block_id',
        'floor_id',
        'room_id',
        'num_of_telephone',
        'status_telephone',
        'num_of_pabx',
        'status_pabx',
		'created_by',
		'updated_by'
    ];
}
