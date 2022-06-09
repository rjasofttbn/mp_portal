<?php

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Petition extends Model
{
    use SoftDeletes, AccessModel;
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'applicant_name',
		'applicant_designation',
		'applicant_nid',
		'applicant_mobile',
		'applicant_email',
        
        'applicant_division_id',
        'applicant_district_id',
        'applicant_upazila_id',
        'applicant_union',
        'applicant_more_address',

        'description',
        'prayer',
        
        'applicant_list',

        'mp_name',
		'otp_id',
		'status',

		'created_by',
		'updated_by'
    ];

    public function applicantDivision()
    {
        return $this->belongsTo(Division::class,'applicant_division_id','id');
    }

    public function applicantDistrict()
    {
        return $this->belongsTo(District::class,'applicant_district_id','id');
    }

    public function applicantUpazila()
    {
        return $this->belongsTo(Upazila::class,'applicant_upazila_id','id');
    }

    public function profileInfo()
    {
        return $this->belongsTo(Profile::class,'mp_name','user_id');
    }

    public function otpInfo()
    {
        return $this->belongsTo(PetitionOtp::class,'otp_id','mobile');
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
