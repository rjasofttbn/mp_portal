<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cabinet extends Model
{
    
    protected $fillable = [
		'ministry_id',
		'wing_id',
		'profile_id',
		'designation_id',
		'date_from',
        'date_to',
		'created_by'
    ];
}
