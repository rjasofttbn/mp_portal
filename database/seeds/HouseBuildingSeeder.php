<?php

/* 
Author: Naziur Rahman
Date: 22/03/2021

*/

use App\Model\HouseBuilding;
use Illuminate\Database\Seeder;

class HouseBuildingSeeder extends Seeder
{
   
    public function run()
    {
        $datas = [
            [
                'id' => 1,
                'name' => 'Building 1',
                'name_bn' => 'ভবন ১',
                'building_no' => '1',
                'area_id' => 2,
            ], [
                'id' => 2,
                'name' => 'Building 2',
                'name_bn' => 'ভবন ২',
                'building_no' => '2',
                'area_id' => 2,
            ],
        ];

        foreach ($datas as $key => $data) {
            $old = HouseBuilding::where('name', $data['name'])->first();
            if (!$old) {
                HouseBuilding::create($data);
            }
        }
    }
}
