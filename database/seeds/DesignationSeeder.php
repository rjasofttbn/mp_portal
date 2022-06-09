<?php
/**
 * Author M. Atoar Rahman
 * Date: 24/01/2021
 * Time: 11:40 AM
 */
use App\Model\Designation;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
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
                'name' => 'Speaker',
                'name_bn' => 'স্পিকার',
                'created_by' => 1,
            ], [
                'id' => 2,
                'name' => 'Deputy Speaker',
                'name_bn' => 'ডেপুটি স্পিকার',
                'created_by' => 1,
            ], [
                'id' => 3,
                'name' => 'President',
                'name_bn' => 'রাষ্ট্রপতি',
                'created_by' => 1,
            ], [
                'id' => 4,
                'name' => 'Prime Minister',
                'name_bn' => 'প্রধানমন্ত্রী',
                'created_by' => 1,
            ], [
                'id' => 5,
                'name' => 'Minister',
                'name_bn' => 'মন্ত্রী',
                'created_by' => 1,
            ], [
                'id' => 6,
                'name' => 'Deputy Minister',
                'name_bn' => 'উপমন্ত্রী',
                'created_by' => 1,
            ], [
                'id' => 7,
                'name' => 'State Minister',
                'name_bn' => 'প্রতিমন্ত্রী',
                'created_by' => 1,
            ], [
                'id' => 8,
                'name' => 'Parliament Member',
                'name_bn' => 'সংসদ সদস্য',
                'created_by' => 1,
            ], [
                'id' => 9,
                'name' => 'Secretary',
                'name_bn' => 'সচিব',
                'created_by' => 1,
            ], [
                'id' => 10,
                'name' => 'Joint Secretary',
                'name_bn' => 'যুগ্ন সচিব',
                'created_by' => 1,
            ],
        ];

        foreach ($datas as $key => $data) {
            $old = Designation::where('id', $data['id'])->first();
            if (!$old) {
                Designation::create($data);
            }
        }
        // DB::table('designations')->insert($designations);
    }
}
