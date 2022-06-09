<?php

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoticeAttachment extends Model
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
        'notice_id',
        'created_by',
        'updated_by',

    ];

    public function notice()
    {
        return $this->belongsTo(Notice::class,'notice_id','id');
    }
}
