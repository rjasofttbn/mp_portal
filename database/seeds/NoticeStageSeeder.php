<?php

use App\Model\NoticeStage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoticeStageSeeder extends Seeder
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
                'rule_number' => 60,
                'role_id' => 4,
                'stage' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 2,
                'rule_number' => 60,
                'role_id' => 5,
                'stage' => 2,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 3,
                'rule_number' => 60,
                'role_id' => 6,
                'stage' => 3,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 4,
                'rule_number' => 60,
                'role_id' => 7,
                'stage' => 4,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],[
                'id' => 5,
                'rule_number' => 62,
                'role_id' => 4,
                'stage' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 6,
                'rule_number' => 62,
                'role_id' => 5,
                'stage' => 2,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 7,
                'rule_number' => 62,
                'role_id' => 6,
                'stage' => 3,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 8,
                'rule_number' => 62,
                'role_id' => 7,
                'stage' => 4,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],[
                'id' => 9,
                'rule_number' => 68,
                'role_id' => 4,
                'stage' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 10,
                'rule_number' => 68,
                'role_id' => 5,
                'stage' => 2,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 11,
                'rule_number' => 68,
                'role_id' => 6,
                'stage' => 3,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 12,
                'rule_number' => 68,
                'role_id' => 7,
                'stage' => 4,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],[
                'id' => 13,
                'rule_number' => 71,
                'role_id' => 4,
                'stage' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 14,
                'rule_number' => 71,
                'role_id' => 5,
                'stage' => 2,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 15,
                'rule_number' => 71,
                'role_id' => 6,
                'stage' => 3,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 16,
                'rule_number' => 71,
                'role_id' => 7,
                'stage' => 4,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],[
                'id' => 17,
                'rule_number' => 78,
                'role_id' => 4,
                'stage' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 18,
                'rule_number' => 78,
                'role_id' => 5,
                'stage' => 2,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 19,
                'rule_number' => 78,
                'role_id' => 6,
                'stage' => 3,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 20,
                'rule_number' => 78,
                'role_id' => 7,
                'stage' => 4,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],[
                'id' => 21,
                'rule_number' => 82,
                'role_id' => 4,
                'stage' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 22,
                'rule_number' => 82,
                'role_id' => 5,
                'stage' => 2,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 23,
                'rule_number' => 82,
                'role_id' => 6,
                'stage' => 3,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 24,
                'rule_number' => 82,
                'role_id' => 7,
                'stage' => 4,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],[
                'id' => 25,
                'rule_number' => 131,
                'role_id' => 4,
                'stage' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 26,
                'rule_number' => 131,
                'role_id' => 5,
                'stage' => 2,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 27,
                'rule_number' => 131,
                'role_id' => 6,
                'stage' => 3,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ], [
                'id' => 28,
                'rule_number' => 131,
                'role_id' => 7,
                'stage' => 4,
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ]
        ];

        foreach ($datas as $key => $data) {
            $old = NoticeStage::where('id', $data['id'])->first();
            if (!$old) {
                NoticeStage::create($data);
            }
        }
        // DB::table('ministries')->insert($ministries);
    }
}
