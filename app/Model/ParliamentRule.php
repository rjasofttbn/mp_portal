<?php

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/*
Crated By : Rajan Bhatta,
    Created Date: 28-01-2021

*/

class ParliamentRule extends Model
{
        use SoftDeletes, AccessModel;

    protected $table = "parliament_rules";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rule_number', 'name', 'department_id', 'description', 'status', 'created_by','updated_by'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id');
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
