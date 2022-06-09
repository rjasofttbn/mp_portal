<?php


use App\Model\AccommodationAsset;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccommodationAssetSeeder extends Seeder
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
                    'name' => 'Bed',
                    'accommodation_asset_type_id' => '1',
                    'accommodation_type_id' => 1,
                    'name_bn' => 'খাট',
                ], [
                    'id' => 2,
                    'name' => 'Table',
                    'accommodation_asset_type_id' => '1',
                    'accommodation_type_id' => 1,
                    'name_bn' => 'টেবিল',
                ], [
                    'id' => 3,
                    'name' => 'Fan',
                    'accommodation_asset_type_id' => '2',
                    'accommodation_type_id' => 2,
                    'name_bn' => 'পাখা',
                ],

                [
                    'id' => 4,
                    'name' => 'Light',
                    'accommodation_asset_type_id' => '2',
                    'accommodation_type_id' => 2,
                    'name_bn' => 'লাইট',
                ], [
                    'id' => 5,
                    'name' => 'Air Conditioner',
                    'accommodation_asset_type_id' => '2',
                    'accommodation_type_id' => 2,
                    'name_bn' => 'এয়ার কন্ডিশনার',
                ]
            ];

            foreach ($datas as $key => $data) {
                $old = AccommodationAsset::where('id', $data['id'])->first();
                if (!$old) {
                    AccommodationAsset::create($data);
                }
            }

    }
}
