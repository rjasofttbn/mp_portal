<?php

use App\Model\UserType;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    public function run()
    {
        $datas = [
            [
                'id' => '1',
                'name' => 'Speaker',
                'name_bn' => 'স্পীকার',
                'usertype' => 'speaker'
            ],
            [
                'id' => '2',
                'name' => 'Member of Perliament',
                'name_bn' => 'এম.পি',
                'usertype' => 'mp'
            ],
            [
                'id' => '3',
                'name' => 'Personal Secretary',
                'name_bn' => 'পি.এস',
                'usertype' => 'ps'
            ],
            [
                'id' => '4',
                'name' => 'Staff',
                'name_bn' => 'স্টাফ',
                'usertype' => 'staff'
            ]
        ];

        foreach ($datas as $key => $data) {
            $old = UserType::where('usertype', $data['usertype'])->first();
            if (!$old) {
                UserType::create($data);
            }
        }
    }
}
