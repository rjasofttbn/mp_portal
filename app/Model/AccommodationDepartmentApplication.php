<?php

namespace App\Model;



use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\SoftDeletes;

class AccommodationDepartmentApplication extends Model
{
    
    use SoftDeletes, AccessModel;

    protected $table = "accommodation_department_applications";

    protected $fillable = [
        'application_id', 'flat_id', 'status','created_by','updated_by'
    ];



    public function application() {
        return $this->belongsTo(AccommodationApplication::class, 'application_id');
    }
 
    protected $hidden = [
        'deleted_at'
    ];



}
