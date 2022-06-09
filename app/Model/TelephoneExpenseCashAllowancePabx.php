<?php

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TelephoneExpenseCashAllowancePabx extends Model
{
    use SoftDeletes, AccessModel;

    protected $fillable = [
		'designition_id',
        'telphone_expenses',
        'cashing_allowance',
        'status',
		'created_by',
		'updated_by'
    ];
}
