<?php

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParliamentBillSubClause extends Model
{
    use SoftDeletes;
    use AccessModel;
}
