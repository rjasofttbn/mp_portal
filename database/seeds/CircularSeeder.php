<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CircularSeeder extends Seeder
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
                'parliament_session_id' => 2,
                'date' => '2021-06-15',
                'ministry_id' => 1,
            ], [
                'id' => 2,
                'parliament_session_id' => 2,
                'date' => '2021-06-15',
                'ministry_id' => 13,
            ], [
                'id' => 3,
                'parliament_session_id' => 2,
                'date' => '2021-06-15',
                'ministry_id' => 20,
            ], [
                'id' => 4,
                'parliament_session_id' => 2,
                'date' => '2021-06-15',
                'ministry_id' => 28,
            ], [
                'id' => 5,
                'parliament_session_id' => 2,
                'date' => '2021-06-15',
                'ministry_id' => 31,
            ], [
                'id' => 6,
                'parliament_session_id' => 2,
                'date' => '2021-06-16',
                'ministry_id' => 17,
            ], [
                'id' => 7,
                'parliament_session_id' => 2,
                'date' => '2021-06-16',
                'ministry_id' => 23,
            ], [
                'id' => 8,
                'parliament_session_id' => 2,
                'date' => '2021-06-16',
                'ministry_id' => 32,
            ], [
                'id' => 9,
                'parliament_session_id' => 2,
                'date' => '2021-06-16',
                'ministry_id' => 16,
            ], [
                'id' => 10,
                'parliament_session_id' => 2,
                'date' => '2021-06-17',
                'ministry_id' => 11,
            ], [
                'id' => 11,
                'parliament_session_id' => 2,
                'date' => '2021-06-17',
                'ministry_id' => 33,
            ], [
                'id' => 12,
                'parliament_session_id' => 2,
                'date' => '2021-06-17',
                'ministry_id' => 34,
            ], [
                'id' => 13,
                'parliament_session_id' => 2,
                'date' => '2021-06-17',
                'ministry_id' => 35,
            ], [
                'id' => 14,
                'parliament_session_id' => 2,
                'date' => '2021-06-17',
                'ministry_id' => 16,
            ], [
                'id' => 15,
                'parliament_session_id' => 2,
                'date' => '2021-06-18',
                'ministry_id' => 12,
            ], [
                'id' => 16,
                'parliament_session_id' => 2,
                'date' => '2021-06-18',
                'ministry_id' => 36,
            ], [
                'id' => 17,
                'parliament_session_id' => 2,
                'date' => '2021-06-19',
                'ministry_id' => 19,
            ], [
                'id' => 18,
                'parliament_session_id' => 2,
                'date' => '2021-06-19',
                'ministry_id' => 9,
            ], [
                'id' => 19,
                'parliament_session_id' => 2,
                'date' => '2021-06-19',
                'ministry_id' => 26,
            ], [
                'id' => 20,
                'parliament_session_id' => 2,
                'date' => '2021-06-19',
                'ministry_id' => 3,
            ], [
                'id' => 21,
                'parliament_session_id' => 2,
                'date' => '2021-06-19',
                'ministry_id' => 4,
            ], [
                'id' => 22,
                'parliament_session_id' => 2,
                'date' => '2021-06-19',
                'ministry_id' => 15,
            ],
        ];

        foreach ($datas as $key => $data) {
            $old = DB::table('circulars')->where('id', $data['id'])->first();
            if (!$old) {
                DB::table('circulars')->insert($data);
            }
        }  
    }
}
