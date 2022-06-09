<?php

/* 
Author: Naziur Rahman 
Date: 8/03/2021
 */

use Illuminate\Database\Seeder;
use App\Model\AccommodationType;
use Illuminate\Support\Facades\DB;

class AccommodationTypeSeeder extends Seeder
{
   
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Flat',
                'name_bn' => 'ফ্ল্যাট'
                
            ], [
              
                'id' => 2,
                'name' => 'High Official House',
                'name_bn' => 'উচ্চমান আবাসন'
            ],
        ];

        foreach ($data as $key => $data) {
            $old = AccommodationType::where('name', $data['name'])->first();
            if (!$old) {
                AccommodationType::create($data);
            }
        }
    }
}
