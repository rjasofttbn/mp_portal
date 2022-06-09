<?php

use App\Model\FurnitureElectronicGood;
use Illuminate\Database\Seeder;

class FurnitureElectronicGoodsSeeder extends Seeder
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
                'area_id' => '1',
                'accommodation_type_id' => '1',
                'accommodation_building_id' => '1',
                'accommodation_asset_type_id' => 1,
                'accommodation_asset_id' => 1,
                'total_no' => '11',
                'created_by' => '1',
            ], [
                'id' => 2,
                'area_id' => '2',
                'accommodation_type_id' => '2',
                'accommodation_building_id' => '2',
                'accommodation_asset_type_id' => 2,
                'accommodation_asset_id' => 2,
                'total_no' => '15',
                'created_by' => '1',
            ], 
        ];
       
        foreach ($datas as $key => $data) {
            $old = FurnitureElectronicGood::where('accommodation_type_id', $data['accommodation_type_id'])->first();
            if (!$old) {
                FurnitureElectronicGood::create($data);
            }
        }
    }
}
