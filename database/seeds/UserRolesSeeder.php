<?php
/**
 * Author M. Atoar Rahman
 * Date: 24/01/2021
 * Time: 11:40 AM
 */
use App\Model\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesSeeder extends Seeder
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
                'user_id' => '1',
                'role_id' => '1'
            ],[
                'id' => 2,
                'user_id' => '2',
                'role_id' => '2'
            ],
            [
                'id' => 3,
                'user_id' => '21',
                'role_id' => '4'
            ],
            [
                'id' => 4,
                'user_id' => '22',
                'role_id' => '5'
            ],
            [
                'id' => 5,
                'user_id' => '23',
                'role_id' => '6'
            ],
            [
                'id' => 6,
                'user_id' => '24',
                'role_id' => '7'
            ],
            [
                'id' => 7,
                'user_id' => '25',
                'role_id' => '4'
            ],
            [
                'id' => 8,
                'user_id' => '26',
                'role_id' => '5'
            ],
            [
                'id' => 9,
                'user_id' => '27',
                'role_id' => '6'
            ],
            [
                'id' => 10,
                'user_id' => '28',
                'role_id' => '7'
            ],
            [
                'id' => 11,
                'user_id' => '29',
                'role_id' => '4'
            ],
            [
                'id' => 12,
                'user_id' => '30',
                'role_id' => '5'
            ],
            [
                'id' => 13,
                'user_id' => '31',
                'role_id' => '6'
            ],
            [
                'id' => 14,
                'user_id' => '32',
                'role_id' => '7'
            ],
            [
                'id' => 15,
                'user_id' => '33',
                'role_id' => '4'
            ],
            [
                'id' => 16,
                'user_id' => '34',
                'role_id' => '5'
            ],
            [
                'id' => 17,
                'user_id' => '35',
                'role_id' => '6'
            ],
            [
                'id' => 18,
                'user_id' => '36',
                'role_id' => '7'
            ]
        ];

        foreach ($datas as $key => $data) {
            $old = UserRole::where('user_id', $data['user_id'])->where('role_id', $data['role_id'])->first();
            if (!$old) {
                UserRole::create($data);
            }
        }
        // DB::table('user_roles')->insert($user_roles);
    }
}
