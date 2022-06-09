<?php

/*
Author: Naziur Rahman
Date: 22/03/2021

 */

use App\Model\FlatType;
use Illuminate\Database\Seeder;

class FlatTypeSeeder extends Seeder
{
    
    public function run()
    {
        $flat_types = [[
            'id' => 1,
            'name' => '1800 sqft',
            'name_bn' => '১৮০০ বর্গফুট',
            'size' => 1800,
            'service_charge' => 500
           
        ],[
            'id' => 2,
            'name' => '1200 sqft',
            'name_bn' => '১২০০ বর্গফুট',
            'size' => 1200,
            'service_charge' => 400
        ]];
        foreach ($flat_types as $key => $data) {
            $old = FlatType::where('name', $data['name'])
                ->where('service_charge', $data['service_charge'])
                ->first();
            if (!$old) {
                FlatType::create($data);
            }
        }

       
    }
}
