<?php

use App\Model\HostelFloor;
use Illuminate\Database\Seeder;

class HostelFloorSeeder extends Seeder
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
                'name' => '1st Block',
                'name_bn' => 'এক নম্বর ব্লক',
                'building_id' => 1,
                'status' => '1',
                'created_by' => '1',
            ], [
                'id' => 2,
                'name' => '2nd Block',
                'name_bn' => 'দুই নম্বর ব্লক',
                'building_id' => 2,
                'status' => '1',
                'created_by' => '1',
            ],
        ];

        foreach ($datas as $key => $data) {
            $old = HostelFloor::where('name', $data['name'])->first();
            if (!$old) {
                HostelFloor::create($data);
            }
        }
    }
}
