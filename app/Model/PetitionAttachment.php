<?php

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PetitionAttachment extends Model
{
    use SoftDeletes, AccessModel;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attachment',
        'petition_id',
        'created_by',
        'updated_by',

    ];

    public function petition()
    {
        return $this->belongsTo(Petition::class,'petition_id','id');
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
