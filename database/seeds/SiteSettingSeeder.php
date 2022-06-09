<?php
/**
 * Author M. Atoar Rahman
 * Date: 24/01/2021
 * Time: 11:40 AM
 */
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSettingSeeder extends Seeder
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
            'company_name' => 'Nanosoft',
            'site_title' => 'MP Portal',
            'site_title_bn' => ' ',
            'site_short_description' => ' ',
            'site_short_description_bn' => ' ',
            'site_header_logo' => '20190821_1566385367712.png',
            'site_footer_logo' => '20190821_1566385399772.png',
            'site_favicon' => '20190821_1566373763949.jpg',
            'site_banner_image' => '20190821_1566373763367.jpg',
            'file_type' => 'jpeg|png|jpg|gif'
        ]];
        foreach ($datas as $key => $data) {
            $old = DB::table('site_settings')->where('company_name', $data['company_name'])->first();
            if (!$old) {
                DB::table('site_settings')->insert($data);
            }
        }
    }
}
