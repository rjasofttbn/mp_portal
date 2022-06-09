<?php

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class NoticeSpeech extends Model
{
    //use SoftDeletes;
    use AccessModel;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'speech',
        'notice_ids',
        'created_by',
        'updated_by',

    ];
}
