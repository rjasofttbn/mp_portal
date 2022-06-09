<?php
/**
 * Author M. Atoar Rahman
 * Date: 03/02/2021
 * Time: 09:40 AM
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MpBook extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

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
