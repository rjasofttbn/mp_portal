<?php

use App\Model\PetitionStage;
use Illuminate\Database\Seeder;

class PetitionStageSeeder extends Seeder
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
                'rule_number' => 102,
                'role_id' => 4,
                'stage' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 2,
                'rule_number' => 102,
                'role_id' => 5,
                'stage' => 2,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 3,
                'rule_number' => 102,
                'role_id' => 6,
                'stage' => 3,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 4,
                'rule_number' => 102,
                'role_id' => 7,
                'stage' => 4,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ];

        foreach ($datas as $key => $data) {
            $old = PetitionStage::where('id', $data['id'])->first();
            if (!$old) {
                PetitionStage::create($data);
            }
        }
    }
}
