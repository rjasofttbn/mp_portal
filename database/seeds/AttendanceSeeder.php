<?php
/**
 * Author : Rajan Bhatta
 * Date: 01/02/2021
 */
use App\Model\Attendance;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
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
            'parliament_id' => '1',
            'session_id' => '1',
            'user_id' => '1',
            'date' => '2021-01-01',
            'created_by' => 1
        ],[
            'id' => 2,
            'parliament_id' => '1',
            'session_id' => '2',
            'user_id' => '1',
            'date' => '2021-01-02',
            'created_by' => 1
        ]
    ];

        foreach ($datas as $key => $data) {
            $old = Attendance::where('parliament_id', $data['parliament_id'])
            ->where('session_id', $data['session_id'])
            ->where('date', $data['date'])->first();
            if (!$old) {
                Attendance::create($data);
            }
        }
        // DB::table('attendances')->insert($attendances);
    }
}
