<?php

namespace App\Model;


use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TelephonePabxApplication extends Model
{
    use SoftDeletes, AccessModel;
  
    protected $fillable = [
      'connection_type',
      'connection_place',
      'require_connection_place',
      'own_address',
      'building_type',
      'block_id',
      'floor_id',
      'room_id',
      'want_renew',
      'status',
      'created_by',
      'updated_by'
    ];
}
