<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MenuPermission extends Model
{
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }

    public function menu(){
        return $this->hasOne(Menu::class,'id','menu_id');
    }
}
