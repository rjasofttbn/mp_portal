<?php
/**
 * Author M. Atoar Rahman
 * Date: 31/01/2021
 * Time: 05:40 PM
 */
use Illuminate\Database\Seeder;
use App\Model\ParliamentSession;

class ParliamentSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [[
            'id' => 1,
            'session_no' => '11th',
            'declare_date' => '2021-02-05',
            'date_from' => '2021-02-10',
            'date_to' => '2021-02-24',
            'parliament_id' => 1,
            'status' => 0,
            'created_by' => 1
        ],[
            'id' => 2,
            'session_no' => '12th',
            'declare_date' => '2021-03-05',
            'date_from' => '2021-06-01',
            'date_to' => '2021-09-24',
            'parliament_id' => 1,
            'status' => 1,
            'created_by' => 1
        ]];

        foreach ($datas as $key => $data) {
            $old = ParliamentSession::where('session_no', $data['session_no'])->where('parliament_id', $data['parliament_id'])->first();
            if (!$old) {
                ParliamentSession::create($data);
            }
        }
        // DB::table('parliament_sessions')->insert($parliament_sessions);
    }
}
