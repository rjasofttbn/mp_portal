<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function permission(){
    	return $this->hasMany(MenuPermission::class);
    }
}
