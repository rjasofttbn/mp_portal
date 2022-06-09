<?php

namespace App\model;

use App\Model\HostelBuilding;
use App\Model\HostelFloor;
use App\Model\OfficeRoom;
use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HostelApplication extends Model
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
            'comments',
            'updated_by',            
            'hostel_building_id',
            'hostel_application_type_id',
            'hostel_floor_id',
            'office_room_id'
    ];
    
    public function hostel_application_type()
    {
        return $this->belongsTo(HostelApplicationType::class, 'hostel_application_type_id', 'id');
    }

    public function hostel_building()
    {
        return $this->belongsTo(HostelBuilding::class, 'hostel_building_id', 'id');
    }

    public function hostel_floor()
    {
        return $this->belongsTo(HostelFloor::class, 'hostel_floor_id', 'id');
    }

    public function office_room()
    {
        return $this->belongsTo(OfficeRoom::class, 'office_room_id', 'id');
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
