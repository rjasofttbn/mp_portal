<?php
/**
 * Author M. Atoar Rahman
 * Date: 24/01/2021
 * Time: 11:40 AM
 */
use App\Model\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
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
                'name' => 'Sher-E-Bangla Nagar',
                'name_bn' => 'শের-এ-বাংলা নগর',
                'created_by' => 1,
            ], [
                'id' => 2,
                'name' => 'Manik Mia Ave',
                'name_bn' => 'মানিক মিয়া এভিনিউ',
                'created_by' => 1,
            ], [
                'id' => 3,
                'name' => 'Nakhalpara',
                'name_bn' => 'নাখালপাড়া',
                'created_by' => 1,
            ],
        ];

        foreach ($datas as $key => $data) {
            $old = Area::where('id', $data['id'])->first();
            if (!$old) {
                Area::create($data);
            }
        }        
    }
}
