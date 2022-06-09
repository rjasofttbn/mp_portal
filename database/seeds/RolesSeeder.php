<?php
use App\Model\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $datas = [
            [
                'id' => 1,
                'name' => 'Developer',
                'name_bn' => 'ডেভেলপার',
            ],
            [
                'id' => 2,
                'name' => 'Superadmin',
                'name_bn' => 'সুপার এডমিন',
            ],
            [
                'id' => 3,
                'name' => 'Admin',
                'name_bn' => 'এডমিন',
            ],
            [
                'id' => 4,
                'name' => 'Administrative Officer',
                'name_bn' => 'প্রশাসনিক কর্মকর্তা',
            ],
            [
                'id' => 5,
                'name' => ' Deputy Secretary',
                'name_bn' => 'উপ সচিব',
            ],
            [
                'id' => 6,
                'name' => 'Joint Secretary',
                'name_bn' => 'যুগ্ন সচিব',
            ],
            [
                'id' => 7,
                'name' => 'Senior Secretary',
                'name_bn' => 'সিনিয়র সচিব',
            ]
        ];

        foreach ($datas as $key => $data) {
            $old = Role::where('name', $data['name'])->first();
            if (!$old) {
                Role::create($data);
            }
        }
    }
}
