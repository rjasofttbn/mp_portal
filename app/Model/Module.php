<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','name_bn','status'];
	public function getRouteKeyName()
	{
		return "name";
	}
}
