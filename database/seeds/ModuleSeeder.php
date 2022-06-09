<?php

use App\Model\Module;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
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
                'name' => '',
                'name_bn' => '',
            ],
            [
                'id' => 2,
                'name' => 'Site Settings',
                'name_bn' => 'সাইট সেটিংস',
            ],
            [
                'id' => 3,
                'name' => 'Profile & Activities',
                'name_bn' => 'প্রোফাইল ও কার্যক্রম',
            ],
            [
                'id' => 4,
                'name' => 'Notice Management',
                'name_bn' => 'নোটিশ ব্যবস্থাপনা',
            ],
            [
                'id' => 5,
                'name' => 'Accommodation Management',
                'name_bn' => 'আবাসন ব্যবস্থাপনা',
            ],
            [
                'id' => 6,
                'name' => 'Hostel Management',
                'name_bn' => 'হোস্টেল ব্যবস্থাপনা',
            ],
            [
                'id' => 7,
                'name' => 'Furniture/Goods Management',
                'name_bn' => 'আসবাবপত্র/মালামাল ব্যবস্থাপনা',
            ],
        ];

        foreach ($datas as $key => $data) {
            $old = Module::where('name', $data['name'])->first();
            if (!$old) {
                Module::create($data);
            }
        }
    }
}
