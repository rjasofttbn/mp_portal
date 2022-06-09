<?php

use App\Model\AccommodationBuilding;
use Illuminate\Database\Seeder;

class AccommodationBuildingSeeder extends Seeder
{
   
    public function run()
    {
        $datas = [
            [
                'id' => 1,
                'name' => 'Building 1',
                'name_bn' => 'ভবন ১',
                'building_no' => '1',
                'total_floor' => 10,
                'area_id' => 2,
                'accommodation_type_id'=> 1
            ], [
                'id' => 2,
                'name' => 'Building 2',
                'name_bn' => 'ভবন ২',
                'building_no' => '2',
                'total_floor' => 5,
                'area_id' => 2,
                'accommodation_type_id'=> 1
            ],
        ];

        foreach ($datas as $key => $data) {
            $old = AccommodationBuilding::where('name', $data['name'])->first();
            if (!$old) {
                AccommodationBuilding::create($data);
            }
        }
    }
}
