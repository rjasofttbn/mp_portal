<?php
/**
 * Author M. Atoar Rahman
 * Date: 02/02/2021
 * Time: 09:40 AM
 */
namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;
    use AccessModel;

    protected $with = ['profile', 'requested_by'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'time_from',
        'time_to',
        'type',
        'topics',
        'requested_to',
        'status',
        'created_by',
        'updated_by'
    ];

    public function profile() {
        return $this->belongsTo(Profile::class, 'requested_to');
    }

    public function requested_by() {
        return $this->belongsTo(Profile::class, 'created_by');
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
