<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MinistryWingSeeder extends Seeder
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
                'name_eng' => 'Software Wings22',
                'name_bn' => 'সফটওয়্যার বিভাগ২২',
                'ministry_id' => 13,
                'created_by' => 1,
            ], [
                'id' => 2,
                'name_eng' => 'Edible Oil',
                'name_bn' => 'ভোজ্য তেল',
                'ministry_id' => 27,
                'created_by' => 1,
            ], [
                'id' => 3,
                'name_eng' => 'Road Transport Division',
                'name_bn' => 'সড়ক পরিবহন ও মহাসড়ক বিভাগ',
                'ministry_id' => 17,
                'created_by' => 1,
            ], [
                'id' => 4,
                'name_eng' => 'Bridge Division',
                'name_bn' => 'সেতু বিভাগ',
                'ministry_id' => 17,
                'created_by' => 1,
            ], [
                'id' => 5,
                'name_eng' => 'Secondary & Higher Education',
                'name_bn' => 'মাধ্যমিক ও উচ্চ শিক্ষা বিভাগ',
                'ministry_id' => 20,
                'created_by' => 1,
            ], [
                'id' => 6,
                'name_eng' => 'Vocational & Madrasah Education',
                'name_bn' => 'কারিগরি ও মাদ্রাসা শিক্ষা বিভাগ',
                'ministry_id' => 20,
                'created_by' => 1,
            ], [
                'id' => 7,
                'name_eng' => 'Electricity Division',
                'name_bn' => 'বিদ্যুৎ বিভাগ',
                'ministry_id' => 5,
                'created_by' => 1,
            ], [
                'id' => 8,
                'name_eng' => 'Energy & Mineral Resources',
                'name_bn' => 'জ্বালানি ও খনিজ সম্পদ বিভাগ',
                'ministry_id' => 5,
                'created_by' => 1,
            ],
        ];

        foreach ($datas as $key => $data) {
            $old = DB::table('ministry_wings')->where('id', $data['id'])->first();
            if (!$old) {
                DB::table('ministry_wings')->insert($data);
            }
        } 
    }
}
