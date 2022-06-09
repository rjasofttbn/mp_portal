<?php
/**
 * Author M. Atoar Rahman
 * Date: 01/02/2021
 * Time: 03:40 PM
 */

use App\Model\Appointment;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $appointments = [[
            'id' => 1,
            'date' =>Carbon::now(),
            'time_from' => '10:00:00',
            'time_to' => '11:00:00',
            'topics' => 'অর্থহীন লেখা যার মাঝে আছে অনেক কিছু।',
            'requested_to' => 1,
            'created_by' => 1
        ],[
            'id' => 2,
            'date' =>Carbon::now(),
            'time_from' => '03:00:00',
            'time_to' => '04:00:00',
            'topics' => 'অর্থহীন লেখা যার মাঝে আছে অনেক কিছু।',
            'requested_to' => 2,
            'created_by' => 1
        ],[
            'id' => 3,
            'date' =>Carbon::now(),
            'time_from' => '03:00:00',
            'time_to' => '04:00:00',
            'topics' => 'অর্থহীন লেখা যার মাঝে আছে অনেক কিছু।',
            'requested_to' => 2,
            'created_by' => 1
        ],[
            'id' => 4,
            'date' =>Carbon::now(),
            'time_from' => '03:00:00',
            'time_to' => '04:00:00',
            'topics' => 'অর্থহীন লেখা যার মাঝে আছে অনেক কিছু।',
            'requested_to' => 2,
            'created_by' => 2
        ],[
            'id' => 5,
            'date' =>Carbon::now(),
            'time_from' => '03:00:00',
            'time_to' => '04:00:00',
            'topics' => 'অর্থহীন লেখা যার মাঝে আছে অনেক কিছু।',
            'requested_to' => 1,
            'created_by' => 2
        ],[
            'id' => 6,
            'date' =>Carbon::now(),
            'time_from' => '03:00:00',
            'time_to' => '04:00:00',
            'topics' => 'অর্থহীন লেখা যার মাঝে আছে অনেক কিছু।',
            'requested_to' => 1,
            'created_by' => 2
        ],[
            'id' => 7,
            'date' =>Carbon::now(),
            'time_from' => '03:00:00',
            'time_to' => '04:00:00',
            'topics' => 'অর্থহীন লেখা যার মাঝে আছে অনেক কিছু।',
            'requested_to' => 1,
            'created_by' => 2
        ]];
        foreach ($appointments as $key => $data) {
            $old = Appointment::where('date', $data['date'])
                ->where('time_from', $data['time_from'])
                ->first();
            if (!$old) {
                Appointment::create($data);
            }
        }

        //DB::table('appointments')->insert($appointments);
    }
}
