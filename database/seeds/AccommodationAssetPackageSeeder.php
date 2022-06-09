<?php

use App\Model\AccommodationAssetPackage;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AccommodationAssetPackageSeeder extends Seeder
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
                'accommodation_type_id' => '1',
                'flat_type_id' => '1',
                'accommodation_asset_type_id' => 1,
                'accommodation_asset_id' => '1',
                'total_no' => '7',
                'created_by' => '1',
            ], [
                'id' => 2,
                'accommodation_type_id' => '1',
                'flat_type_id' => '2',
                'accommodation_asset_type_id' => 1,
                'accommodation_asset_id' => '2',
                'total_no' => '9',
                'created_by' => '1',
            ],
        ];

        foreach ($datas as $key => $data) {
            $old = AccommodationAssetPackage::where('id', $data['id'])->first();
            if (!$old) {
                AccommodationAssetPackage::create($data);
            }
        }
    }
}
