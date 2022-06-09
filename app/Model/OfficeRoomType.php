<?php

namespace App\Model;



use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfficeRoomType extends Model
{
    //
    use SoftDeletes, AccessModel;


    protected $table = 'office_room_types';
 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','name_bn','service_charge','status', 'created_by','updasted_by'
    ];

    


    protected $hidden = [
        'deleted_at'
    ];


}
