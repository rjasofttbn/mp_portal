<?php

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SongshodRoom extends Model
{
    use SoftDeletes, AccessModel;
    protected $table = "songshod_rooms";

    protected $fillable = [
        'room', 'room_bn','floor_id', 'block_id', 'status', 'created_by','updated_by'
    ];
}
