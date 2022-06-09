<?php
/**
 * Author M. Atoar Rahman
 * Date: 01/02/2021
 * Time: 09:25 AM
 */
namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Parliament extends Model
{
    use SoftDeletes, AccessModel;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parliament_number', 'date_from', 'date_to', 'status', 'created_by','updated_by'
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
