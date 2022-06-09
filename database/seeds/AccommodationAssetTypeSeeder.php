<?php

use Illuminate\Database\Seeder;
use App\Model\AccommodationAssetType;

class AccommodationAssetTypeSeeder extends Seeder
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
                'name' => 'Furniture',
                'name_bn' => 'আসবাবপত্র',
            ], [
                'id' => 2,
                'name' => 'Electric',                   
                'name_bn' => 'বৈদ্যুতিক',
            ],
        ];

        foreach ($datas as $key => $data) {
            $old = AccommodationAssetType::where('name', $data['name'])->first();
            if (!$old) {
                AccommodationAssetType::create($data);
            }
        }
    }
}
