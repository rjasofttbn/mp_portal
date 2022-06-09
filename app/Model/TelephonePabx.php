<?php

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TelephonePabx extends Model
{
  use SoftDeletes, AccessModel;

  protected $fillable = [
    'place_type',
    'designition_id',
    'num_of_telephone',
    'num_of_pabx',
    'num_of_mobile',
    'status',
    'created_by',
    'updated_by'
  ];
}
