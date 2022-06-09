<?php
/**
 * Author M. Atoar Rahman
 * Date: 24/01/2021
 * Time: 11:40 AM
 */
namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
        use SoftDeletes, AccessModel;

    protected $table = "designations";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'name_bn', 'status', 'created_by','updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at'
    ];
}
