<?php

use App\Model\HostelBuilding;
use Illuminate\Database\Seeder;

/* 
Author: Md. Omar Faruk
Date: 02/04/2021
 */

class HostelBuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'id' => 1,
                'name' => 'Water Lile',
                'name_bn' => 'শাপলা',
                'building_no' => '1',
                'status' => '1',
                'total_floor' => '5',
                'created_by' => '1',
            ], [
                'id' => 2,
                'name' => 'Nightshade',
                'name_bn' => 'রজনীগন্ধা',
                'building_no' => '2',
                'status' => '1',
                'total_floor' => '5',
                'created_by' => '1',
            ],
        ];

        foreach ($datas as $key => $data) {
            $old = HostelBuilding::where('name', $data['name'])->first();
            if (!$old) {
                HostelBuilding::create($data);
            }
        }
    }
}
