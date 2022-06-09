<?php
/**
 * Author M. Atoar Rahman
 * Date: 24/01/2021
 * Time: 11:40 AM
 */
use App\Model\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
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
                'name' => 'Information Technology',
                'name_bn' => 'তথ্য ও প্রযুক্তি',
                'department_no' => '111',
                'created_by' => 1,
            ],[
                'id' => 2,
                'name' => 'Notice',
                'name_bn' => 'নোটিশ',
                'department_no' => '222',
                'created_by' => 1,
            ], [
                'id' => 3,
                'name' => 'Deferral and Rights',
                'name_bn' => 'মুলতবি ও অধিকার',
                'department_no' => '333',
                'created_by' => 1,
            ], [
                'id' => 4,
                'name' => 'Law 1',
                'name_bn' => 'আইন ১',
                'department_no' => '444',
                'created_by' => 1,
            ], [
                'id' => 5,
                'name' => 'Law 2',
                'name_bn' => 'আইন ২',
                'department_no' => '555',
                'created_by' => 1,
            ], [
                'id' => 6,
                'name' => 'Question and Answer',
                'name_bn' => 'প্রশ্ন ও উত্তর',
                'department_no' => '666',
                'created_by' => 1,
            ], [
                'id' => 7,
                'name' => 'Petition',
                'name_bn' => 'পিটিশন',
                'department_no' => '777',
                'created_by' => 1,
            ],
        ];

        foreach ($datas as $key => $data) {
            $old = Department::where('id', $data['id'])->first();
            if (!$old) {
                Department::create($data);
            }
        }
        // DB::table('departments')->insert($departments);
    }
}
