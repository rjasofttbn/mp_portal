<?php

namespace App\Model;

use App\User;
use App\Model\Ministry;
use App\Model\Parliament;
use App\Model\Designation;
use App\Model\Constituency;
use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;
    use AccessModel;
    protected $fillable = [
        'name_bn',
        'name_eng',
        'father_name',
        'mother_name',
        'merital_status',
        'Married',
        'spouse_name_bn',
        'spouse_name_eng',
        'spouse_dob',
        'nid_no',
        'spouse_nid_no',
        'religion',
        'pabx_no',
        'official_phone',
        'residential_phone',
        'office_address',
        'residential_address',
        'parmanent_address',
        'status',
        'created_by',
        'updated_by',
        'user_id',
        'constituency_id',
        'parliament_id',
        'designation_id',
        'political_parties_id',
        'birth_district_id',
        'ministry_id'
    ];

    public function userInfo()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class,'designation_id','id');
    }
    
    public function constituency()
    {
        return $this->belongsTo(Constituency::class,'constituency_id','id');
    }
    
    public function parliamentInfo()
    {
        return $this->belongsTo(Parliament::class,'parliament_id','id');
    }
    public function ministryInfo()
    {
        return $this->belongsTo(Ministry::class,'ministry_id','id');
    }
}
