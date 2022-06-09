<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Constituency extends Model
{
        use SoftDeletes;

    protected $table = "constituencies";
    protected $with = ['district', 'division', 'upazila'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'bn_name','number', 'upazila_id', 'district_id', 'division_id', 'status', 'created_by','updated_by'
    ];


    // Crated by Rajan Bhatta.
    // Foreign key relation with district table.
    public function district() {
        return $this->belongsTo(District::class, 'district_id');
    }


    // Foreign key relation with division table.
    public function division() {
        return $this->belongsTo(Division::class, 'division_id');
    }


    // Foreign key relation with upazila table.
    public function upazila() {
        return $this->belongsTo(Upazila::class, 'upazila_id');
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
