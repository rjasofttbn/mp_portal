<?php

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notice extends Model
{
    use SoftDeletes;
	use AccessModel;
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'date',
		'subject',
		'topic',
		'bill_topic',
		'description',
        'rule_number',
        'stage_number',
        'notice_from',
        'to_ministry_id',
        'to_wing_id',
        'notice_to',
        'is_verbal',
        'explanation',
        'rd_no',
        'question_type',
        'parliament_session',
        'parliament_session_id',
        'submission_date',
        'acceptance_tag',
        'acceptance_duration',
        'approval_date',
        'comments',
        'ministry_id',
        'speech_id',
        'yes_no_vote',
        'mp_acceptance',
        'discussed_date',
        'mp_list',
		'status',
		'created_by',
		'updated_by'
    ];

    public function parliamentRule()
    {
        return $this->belongsTo(ParliamentRule::class,'rule_number','rule_number');
    }

    public function profileForNoticeTo()
    {
        return $this->belongsTo(Profile::class,'notice_to','user_id');
    }
    public function profileForNoticeFrom()
    {
        return $this->belongsTo(Profile::class,'notice_from','user_id');
    }

    public function parliamentSsessionInfo()
    {
        return $this->belongsTo(ParliamentSession::class,'parliament_session_id','id');
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
