<?php

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoticeConsent extends Model
{
    use SoftDeletes;
    use AccessModel;

    protected $table = "notice_consents";

    protected $fillable = [
        'notice_id', 
        'user_id', 
        'stage_number', 
        'note', 
        'user_consent',
        'created_by' 
    ];

    protected $hidden = [
        'deleted_at'
    ];
}
