<?php
/**
 * Author M. Atoar Rahman
 * Date: 24/01/2021
 * Time: 11:40 AM
 */
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu_permissions = [[
            'menu_id' => 4,
            'role_id' => 1,
            'permitted_route' => 'user',
            'menu_from' => 'menu'
        ],[
            'menu_id' => 5,
            'role_id' => 1,
            'permitted_route' => 'user.role',
            'menu_from' => 'menu'
        ],[
            'menu_id' => 6,
            'role_id' => 1,
            'permitted_route' => 'user.permission',
            'menu_from' => 'menu'
        ],[
            'menu_id' => 8,
            'role_id' => 1,
            'permitted_route' => 'frontend-menu',
            'menu_from' => 'menu'
        ],[
            'menu_id' => 9,
            'role_id' => 1,
            'permitted_route' => 'frontend-menu.post.view',
            'menu_from' => 'menu'
        ],[
            'menu_id' => 10,
            'role_id' => 1,
            'permitted_route' => 'frontend-menu.menu.view',
            'menu_from' => 'menu'
        ]];
        foreach ($menu_permissions as $key => $data) {
            $old = DB::table('menu_permissions')
                ->where('menu_id', $data['menu_id'])
                ->where('role_id', $data['role_id'])
                ->first();
            if (!$old) {
                DB::table('menu_permissions')->insert($data);
            }
        }

        //DB::table('menu_permissions')->insert($menu_permissions);
    }
}
