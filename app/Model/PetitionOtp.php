<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PetitionOtp extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'mobile',
		'otp_number',
		'start_time',
		'end_time'
    ];

    
}
