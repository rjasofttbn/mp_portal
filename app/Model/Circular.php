<?php

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Circular extends Model
{
    use AccessModel;

    protected $table = "circulars";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parliament_session_id', 
        'date', 
        'ministry_id'
    ];
}
