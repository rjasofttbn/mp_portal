<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['name','name_bn','description','mail_status','status'];
	public function getRouteKeyName()
	{
		return "name";
	}
}
