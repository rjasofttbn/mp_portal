<?php

use Illuminate\Database\Seeder;
use App\Model\PetitionComitteeDesignation;
class PetitionComitteeDesignationSeeder extends Seeder
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
                'name' => 'Chairman',
                'name_bn' => 'সভাপতি',
                'created_by' => 1,
            ], [
                'id' => 2,
                'name' => 'Vice-Chairman',
                'name_bn' => 'সহ সভাপতি',
                'created_by' => 1,
            ], [
                'id' => 3,
                'name' => 'Member',
                'name_bn' => 'সদস্য',
                'created_by' => 1,
            ],
        ];

        foreach ($datas as $key => $data) {
            $old = PetitionComitteeDesignation::where('name', $data['name'])->first();
            if (!$old) {
                PetitionComitteeDesignation::create($data);
            }
        }
    }
}
