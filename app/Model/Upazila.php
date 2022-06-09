<?php
/**
 * Author M. Atoar Rahman
 * Date: 24/01/2021
 * Time: 11:40 AM
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upazila extends Model
{
        use SoftDeletes;

    protected $table = "upazilas";
    protected $with = ['district', 'division'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'bn_name', 'url', 'district_id', 'division_id', 'status', 'created_by', 'updated_by'
    ];


    // Crated by M. Atoar Rahman
    // Foreign key relation with District and Division table.
    public function district() {
        return $this->belongsTo(District::class, 'district_id');
    }
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
