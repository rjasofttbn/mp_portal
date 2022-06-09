<?php

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StandingCommittee extends Model
{
    use SoftDeletes, AccessModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'parliament_id',
		'ministry_id',
        'user_id',
        'designation',
        'date_from',
        'date_to',
		'status',
		'created_by',
		'updated_by'
    ];

    public function profileInfo()
    {
        return $this->belongsTo(Profile::class,'user_id','id');
    }
    public function ministryInfo()
    {
        return $this->belongsTo(Ministry::class,'ministry_id','id');
    }
    public function parliamentInfo()
    {
        return $this->belongsTo(Parliament::class,'parliament_id','id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at'
    ];

}
