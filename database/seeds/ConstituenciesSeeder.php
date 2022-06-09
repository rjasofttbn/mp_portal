<?php
/**
 * Author M. Atoar Rahman
 * Date: 24/01/2021
 * Time: 11:40 AM
 */
use App\Model\Constituency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConstituenciesSeeder extends Seeder
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
            'name' => 'Panchagarh-1',
            'bn_name' => 'পঞ্চগড়-১',
            'number' => 1,
            'division_id' => 7,
            'district_id' => 53,
            'upazila_id' => 399,
            'created_by' => 1
        ],[
            'id' => 2,
            'name' => 'Panchagarh-2',
            'bn_name' => 'পঞ্চগড়-২',
            'number' => 2,
            'division_id' => 7,
            'district_id' => 53,
            'upazila_id' => 400,
            'created_by' => 1
        ],[
            'id' => 3,
            'name' => 'Thakurgaon-1',
            'bn_name' => 'ঠাকুরগাও-১',
            'number' => 3,
            'division_id' => 7,
            'district_id' => 58,
            'upazila_id' => 435,
            'created_by' => 1
        ],[
            'id' => 4,
            'name' => 'Thakurgaon-2',
            'bn_name' => 'ঠাকুরগাও-২',
            'number' => 4,
            'division_id' => 7,
            'district_id' => 58,
            'upazila_id' => 439,
            'created_by' => 1
        ],[
            'id' => 5,
            'name' => 'Thakurgaon-3',
            'bn_name' => 'ঠাকুরগাও-৩',
            'number' => 5,
            'division_id' => 7,
            'district_id' => 58,
            'upazila_id' => 436,
            'created_by' => 1
        ],[
            'id' => 6,
            'name' => 'Dinajpur-1',
            'bn_name' => 'দিনাজপুর-১',
            'number' => 6,
            'division_id' => 7,
            'district_id' => 54,
            'upazila_id' => 404,
            'created_by' => 1
        ],[
            'id' => 7,
            'name' => 'Dinajpur-2',
            'bn_name' => 'দিনাজপুর-২',
            'number' => 7,
            'division_id' => 7,
            'district_id' => 54,
            'upazila_id' => 405,
            'created_by' => 1
        ],[
            'id' => 8,
            'name' => 'Dinajpur-3',
            'bn_name' => 'দিনাজপুর-৩',
            'number' => 8,
            'division_id' => 7,
            'district_id' => 54,
            'upazila_id' => 3,
            'created_by' => 1
        ],[
            'id' => 9,
            'name' => 'Dinajpur-4',
            'bn_name' => 'দিনাজপুর-৪',
            'number' => 9,
            'division_id' => 7,
            'district_id' => 54,
            'upazila_id' => 409,
            'created_by' => 1
        ],[
            'id' => 10,
            'name' => 'Dinajpur-5',
            'bn_name' => 'দিনাজপুর-৫',
            'number' => 10,
            'division_id' => 7,
            'district_id' => 54,
            'upazila_id' => 407,
            'created_by' => 1
        ]];

        foreach ($datas as $key => $data) {
            $old = Constituency::where('name', $data['name'])->where('number', $data['number'])->first();
            if (!$old) {
                Constituency::create($data);
            }
        }
        // DB::table('constituencies')->insert($constituencies);
    }
}
