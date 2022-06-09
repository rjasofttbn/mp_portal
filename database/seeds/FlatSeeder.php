<?php

use App\Model\Flat;
use Illuminate\Database\Seeder;

class FlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $flats = [[
            'id' => 1,
            'number' => '101',
            'number_bn' => '১০১',
            'created_by' => '1',
            'floor_id' => '1',
            'building_id' => '1',
            'flat_type_id' => 1,
            'area_id' => '2',

        ], [
            'id' => 2,
            'number' => '102',
            'number_bn' => '১০২',
            'created_by' => '1',
            'floor_id' => '1',
            'building_id' => '1',            
            'area_id' => '2',

        ]];
        foreach ($flats as $key => $data) {
            $old = Flat::where('number', $data['number'])
                ->first();
            if (!$old) {
                Flat::create($data);
            }
        }

     
    }
}
