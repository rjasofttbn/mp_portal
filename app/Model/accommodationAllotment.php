<?php

namespace App\Model;


use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Constraints\SoftDeletedInDatabase;

use Illuminate\Database\Eloquent\SoftDeletes;

class accommodationAllotment extends Model
{
    use SoftDeletes;
    use AccessModel;

    protected $fillable = [
        'accommodation_application_id',
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
    public function accommodation_building()
    {
        return $this->belongsTo(AccommodationBuilding::class, 'accommodation_building_id', 'id');
    }

    public function house_building()
    {
        return $this->belongsTo(HouseBuilding::class, 'house_building_id', 'id');
    }

    public function accommodation_application()
    {
        return $this->belongsTo(AccommodationApplication::class, 'accommodation_application_id', 'id');
    }
}
