<?php


/*
 Author: Naziur Rahman
 Date: 6/05/2021
 */

namespace App\Model;

use App\Traits\AccessModel;
use Illuminate\Database\Eloquent\Model;

class AccommodationApplicationType extends Model
{ 

    protected $table = "accommodation_application_types";


    public function accommodationInfo()
    {
        return $this->belongsTo(AccommodationType::class,'accommodation_type_id');

    }
 
}