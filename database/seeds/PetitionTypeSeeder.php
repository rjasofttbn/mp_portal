<?php

use App\Model\PetitionType;
use Illuminate\Database\Seeder;

class PetitionTypeSeeder extends Seeder
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
                'id' => '1',
                'name' => 'Member of Perliament',
                'name_bn' => 'এম.পি',
                'petitiontype' => 'mp'
            ],
            [
                'id' => '2',
                'name' => 'Citizen',
                'name_bn' => 'নাগরিক',
                'petitiontype' => 'citizen'
            ]
        ];

        foreach ($datas as $key => $data) {
            $old = PetitionType::where('petitiontype', $data['petitiontype'])->first();
            if (!$old) {
                PetitionType::create($data);
            }
        }
    }
}
