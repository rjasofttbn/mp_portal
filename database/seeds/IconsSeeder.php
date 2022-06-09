<?php
/**
 * Author M. Atoar Rahman
 * Date: 24/01/2021
 * Time: 11:40 AM
 */
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IconsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $icons = [[
            'name' => 'fa-copy'
        ],[
            'name' => 'ion-social-twitter'
        ],[
            'name' => 'ion-ionic'
        ],[
            'name' => 'ion-settings'
        ]];
        foreach ($icons as $key => $data) {
            $old = DB::table('icons')
                ->where('name', $data['name'])
                ->first();
            if (!$old) {
                DB::table('icons')->insert($data);
            }
        }

        //DB::table('icons')->insert($icons);
    }
}
