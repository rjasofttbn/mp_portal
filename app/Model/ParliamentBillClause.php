<?php

namespace App\Model;

use App\Traits\AccessModel;
use App\Model\ParliamentBillSubClause;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParliamentBillClause extends Model
{
    use SoftDeletes;
    use AccessModel;

    public function subClauses()
    {
        return $this->hasMany(ParliamentBillSubClause::class,'parliament_bill_clause_id','id');
    }
}
