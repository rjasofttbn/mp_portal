<?php

namespace App\Traits;

trait PublicTrait
{
     /** Approve Application info* */
     public static function approveApp()
     {
         $acc_app ="";
         $acc_app =  "
         SELECT ha.id as application_id,ha.office_room_id,ha.created_at,ha.date,ha.department_ar_date,ha.department_ar_by,ha.whips_ar_date,ha.whips_ar_by,ha.application_from, ha.subject,ha.status,ha.description,ha.hostel_application_type_id,hb.name as hostel_bu_en,hb.name_bn as hostel_bu_bn,hf.name_bn as hostel_fl_bn, hf.name as hostel_fl_en,ofr.number as hostel_ofr_en, ofr.number_bn as hostel_ofr_bn
         FROM hostel_applications ha
         LEFT JOIN hostel_buildings hb on hb.id = ha.hostel_building_id
         LEFT JOIN hostel_floors hf on hf.id = ha.hostel_floor_id
         LEFT JOIN office_rooms ofr on ofr.id = ha.office_room_id" ;
         return $acc_app ;
     }
}