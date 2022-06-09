<?php

use App\Model\MpPs;
use Illuminate\Database\Seeder;

class MpPsSeeder extends Seeder
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
                'mp_user_id' => '2',
                'ps_user_id' => '12',
                'created_by' => '1',
            ],[
                'id' => 2,
                'mp_user_id' => '3',
                'ps_user_id' => '13',
                'created_by' => '1',
            ],
        ];

        foreach ($datas as $key => $data) {
            $old = MpPs::where('ps_user_id', $data['ps_user_id'])->where('mp_user_id', $data['mp_user_id'])->first();
            if (!$old) {
                MpPs::create($data);
            }
        }
    }
}
