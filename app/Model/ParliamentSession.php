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

class ParliamentSession extends Model
{
    use SoftDeletes, AccessModel;
    protected $with = ['parliament'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'session_no', 'parliament_id', 'declare_date', 'date_from', 'date_to', 'status', 'created_by','updated_by'
    ];

    // Crated by M. Atoar Rahman
    // Foreign key relation with Parliament and Parliament table.
    public function parliament() {
        return $this->belongsTo(Parliament::class, 'parliament_id');
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
