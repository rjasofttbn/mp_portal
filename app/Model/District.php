<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
        use SoftDeletes;

    protected $table = "districts";
    protected $with = ['division'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'bn_name', 'lat', 'lon', 'url', 'division_id', 'status', 'created_by','updated_by'
    ];


    // Crated by Rajan Bhatta.
    // Foreign key relation with Division table.
    public function division() {
        return $this->belongsTo(Division::class, 'division_id');
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
