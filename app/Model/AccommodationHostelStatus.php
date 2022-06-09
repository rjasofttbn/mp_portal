<?php


/*
  Author: Naziur Rahman
 Date: 12/05/2021 
 
 */

 
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AccommodationHostelStatus extends Model
{
    
    protected $table = "accommodation_hostel_status";


    protected $fillable = [
        'type', 'name', 'name_bn', 'color'
    ];

}
