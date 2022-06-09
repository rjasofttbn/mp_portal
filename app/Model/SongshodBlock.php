<?php

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SongshodBlock extends Model
{
    use SoftDeletes, AccessModel;
    protected $table = "songshod_blocks";

    protected $fillable = [
        'name', 'name_bn', 'status', 'created_by','updated_by'
    ];

}
