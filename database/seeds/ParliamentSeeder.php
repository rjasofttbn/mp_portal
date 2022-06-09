<?php
/**
 * Author M. Atoar Rahman
 * Date: 31/01/2021
 * Time: 05:40 PM
 */
use App\Model\Parliament;
use Illuminate\Database\Seeder;

class ParliamentSeeder extends Seeder
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
            'parliament_number' => '11th',
            'date_from' => '2021-01-23',
            'date_to' => '2021-02-24',
            'status' => '1',
            'created_by' => 1
        ],[
            'id' => 2,
            'parliament_number' => '10th',
            'date_from' => '2021-03-25',
            'date_to' => '2021-04-26',
            'status' => '0',
            'created_by' => 1
        ],[
            'id' => 3,
            'parliament_number' => '9th',
            'date_from' => '2021-05-27',
            'date_to' => '2021-06-28',
            'status' => '0',
            'created_by' => 1
        ]];

        foreach ($datas as $key => $data) {
            $old = Parliament::where('parliament_number', $data['parliament_number'])->first();
            if (!$old) {
                Parliament::create($data);
            }
        }
        // DB::table('parliaments')->insert($parliaments);
    }
}
