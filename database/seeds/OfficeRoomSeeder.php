<?php

use App\Model\OfficeRoom;
use Illuminate\Database\Seeder;

class OfficeRoomSeeder extends Seeder
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
                'number' => 1001,
                'number_bn' => '১০০১',
                'building_id' => 1,
                'hostel_floor_id' => 1,
                'office_room_type_id' => 1,
                'status' => '1',
                'created_by' => '1',
            ], [
                'id' => 2,
                'number' => 1002,
                'number_bn' => '১০০২',
                'building_id' => 1,
                'hostel_floor_id' => 1,                
                'office_room_type_id' => 2,
                'status' => '1',
                'created_by' => '1',
            ],
        ];


        foreach ($datas as $key => $data) {
            $old = OfficeRoom::where('number', $data['number'])->first();
            if (!$old) {
                OfficeRoom::create($data);
            }
        }
    }
}
