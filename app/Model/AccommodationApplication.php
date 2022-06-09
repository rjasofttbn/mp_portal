<?php

namespace App\Model;

use App\Model\AccommodationApplicationType;
use App\Model\Area;
use App\Model\Flat;
use App\Model\Profile;
use App\Traits\AccessModel;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Testing\Constraints\SoftDeletedInDatabase;

class AccommodationApplication extends Model
{
    use SoftDeletes;
    use AccessModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject',
        'application_from',
        'application_to',
        'date',
        'description',
        'status',
        'created_by',
        'dept_submission_date',
        'approval_date',
        'department_ar_date',
        'department_ar_by',
        'whips_ar_date',
        'whips_ar_by',
        'comments',
        'updated_by',
        'house_building_id',
        'accommodation_building_id',
        'application_type_id'
    ];
    
    public function accommodation_application_type()
    {
        return $this->belongsTo(AccommodationApplicationType::class, 'application_type_id', 'id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }
    public function accommodation_building()
    {
        return $this->belongsTo(AccommodationBuilding::class, 'accommodation_building_id', 'id');
    }

    public function house_building()
    {
        return $this->belongsTo(HouseBuilding::class, 'house_building_id', 'id');
    }

    public function mp()
    {
        return $this->belongsTo(User::class, 'application_from','id');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'application_from','user_id');
    }

    public function flat_type()
    {
        return $this->belongsTo(FlatType::class, 'flat_type_id','id');
    }

    protected $hidden = [
        'deleted_at'
    ];
}
