<?php

/*
 Author: Naziur Rahman
 Date: 6/05/2021
 */

use Illuminate\Database\Seeder;
use App\Model\AccommodationApplicationType;



class AccommodationApplicationTypeSeeder extends Seeder
{
   
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Application for new flat allotment',
                'name_bn' => 'সংসদ সদস্য ভবনের ফ্লাট বরাদ্দের জন্য আবেদন।',
                'accommodation_type_id' => 1,
              
            ], [
                'id' => 2,
                'name' => 'Application for cancel allotted flat',
                'name_bn' => 'সংসদ সদস্য ভবনের ফ্লাট বরাদ্দ বাতিলের জন্য আবেদন।',
                'accommodation_type_id' => 1,
               
            ], [
                'id' => 3,
                'name' => 'Application for exchange allotted flat',
                'name_bn' => 'সংসদ সদস্য ভবনের ফ্লাট বরাদ্দ পরিবর্তনের জন্য আবেদন।',
                'accommodation_type_id' => 1,
               
            ], [
                'id' => 4,
                'name' => 'Application for new high official house allotment',
                'name_bn' => 'উচ্চমান আবাসন বরাদ্দের জন্য আবেদন।',
                'accommodation_type_id' => 2,
               
            ], [
                'id' => 5,
                'name' => 'Application for cancel allotted high official house',
                'name_bn' => 'উচ্চমান আবাসন বরাদ্দ বাতিলের জন্য আবেদন।',
                'accommodation_type_id' => 2,
                
            ], [
                'id' => 6,
                'name' => 'Application for exchange allotted high official house',
                'name_bn' => 'উচ্চমান আবাসন বরাদ্দ পরিবর্তনের জন্য আবেদন।',
                'accommodation_type_id' => 2,
                
            ],
        ];

        foreach ($data as $key => $data) {
            $old = AccommodationApplicationType::where('id', $data['id'])->first();
            if (!$old) {
                AccommodationApplicationType::create($data);
            }
        }
    }
}
