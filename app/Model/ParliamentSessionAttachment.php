<?php

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParliamentSessionAttachment extends Model
{
    
    use SoftDeletes;
    use AccessModel;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attachment',
        'parliament_session_id',
        'created_by',
        'updated_by',

    ];

    public function parliamentSession()
    {
        return $this->belongsTo(ParliamentSession::class,'parliament_session_id','id');
    }
}
