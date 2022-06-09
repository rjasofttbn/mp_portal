<?php
/**
 * Author M. Atoar Rahman
 * Date: 24/01/2021
 * Time: 11:40 AM
 */
use App\Model\PoliticalParty;
use Illuminate\Database\Seeder;

class PoliticalPartySeeder extends Seeder
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
            'name' => 'Bangladesh Awami League',
            'name_bn' => 'বাংলাদেশ আওয়ামী লীগ',
            'created_by' => 1
        ],[
            'id' => 2,
            'name' => 'Bangladesh Nationalist Party',
            'name_bn' => 'বাংলাদেশ জাতীয়তাবাদী দল',
            'created_by' => 1
        ],[
            'id' => 3,
            'name' => 'Jatiya Party',
            'name_bn' => 'জাতীয় পার্টি',
            'created_by' => 1
        ]];

        foreach ($datas as $key => $data) {
            $old = PoliticalParty::where('name', $data['name'])->first();
            if (!$old) {
                PoliticalParty::create($data);
            }
        }
        // DB::table('political_parties')->insert($political_parties);
    }
}
