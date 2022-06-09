<?php

namespace App\Model;

use App\Traits\AccessModel;
use App\Model\ParliamentBillClause;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParliamentBill extends Model
{
    use SoftDeletes;
    use AccessModel;

    protected $fillable = [
        'name',
        'name_bn',
        'attachment',
        'status',
        'created_by',
        'updated_by',
    ];

    public function clauses()
    {
        return $this->hasMany(ParliamentBillClause::class,'parliament_bill_id','id');
    }

    
}
