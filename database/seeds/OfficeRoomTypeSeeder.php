<?php

use App\Model\OfficeRoomType;
use Illuminate\Database\Seeder;

class OfficeRoomTypeSeeder extends Seeder
{
    
   
    public function run()
    {
        $datas = [[
            'id' => 1,
            'name' => 'One Room',
            'name_bn' => 'এক রুম বিশিষ্ট',            
            'service_charge' => 400,
            'created_by' => 1,
            
        ],[
            'id' => 2,
            'name' => 'Two Room',
            'name_bn' => 'দুই রুম বিশিষ্ট',            
            'service_charge' => 800,
            'created_by' => 1,
        ]];

        foreach ($datas as $key => $data) {
            $old = OfficeRoomType::where('name', $data['name'])->first();
            if (!$old) {
                OfficeRoomType::create($data);
            }
        }        
    }

}
