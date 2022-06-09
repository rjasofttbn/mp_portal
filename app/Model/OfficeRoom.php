<?php

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use app\Model\HostelBuilding;
use app\Model\HostelFloor;



class OfficeRoom extends Model
{
    
    use SoftDeletes, AccessModel;

    protected $table = "office_rooms";

    protected $fillable = [
        'number', 'number_bn', 'building_id', 'hostel_floor_id',
        'office_room_type_id' , 'status', 'is_availabe', 'created_by', 'updated_by'
    ];

    public function building() {
        return $this->belongsTo(HostelBuilding::class, 'building_id');
    }
    public function floor() {
        return $this->belongsTo(HostelFloor::class, 'hostel_floor_id');
    }
    public function officeType() {
        return $this->belongsTo(OfficeRoomType::class, 'office_room_type_id');
    }

    protected $hidden = [
        'deleted_at'
    ];


}
