<?php

/**
 * Author M. Atoar Rahman
 * Date: 24/01/2021
 * Time: 11:40 AM
 */

use App\Model\Floor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FloorTableSeeder extends Seeder
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
                'name' => '1st Floor',
                'name_bn' => 'এক নম্বর ফ্লোর',                
                'created_by' => 1
            ], [
                'id' => 2,
                'name' => '2nd Floor',
                'name_bn' => 'দুই নম্বর ফ্লোর',            
                'created_by' => 1
            ], [
                'id' => 3,
                'name' => '3rd Floor',
                'name_bn' => 'তিন নম্বর ফ্লোর',               
                'created_by' => 1
            ], [
                'id' => 4,
                'name' => '4th Floor',
                'name_bn' => 'চার নম্বর ফ্লোর',                
                'created_by' => 1
            ], [
                'id' => 5,
                'name' => '5th Floor',
                'name_bn' => 'পাঁচ নম্বর ফ্লোর',    
                'created_by' => 1
            ], [
                'id' => 6,
                'name' => '6th Floor',
                'name_bn' => 'ছয় নম্বর ফ্লোর',             
                'created_by' => 1
            ], [
                'id' => 7,
                'name' => '7th Floor',
                'name_bn' => 'সাত নম্বর ফ্লোর',           
                'created_by' => 1
            ], [
                'id' => 8,
                'name' => '8th Floor',
                'name_bn' => 'আট নম্বর ফ্লোর',          
                'created_by' => 1
            ], [
                'id' => 9,
                'name' => '9th Floor',
                'name_bn' => 'নয় নম্বর ফ্লোর',             
                'created_by' => 1
            ], [
                'id' => 10,
                'name' => '10th Floor',
                'name_bn' => 'দশ নম্বর ফ্লোর',             
                'created_by' => 1
            ], [
                'id' => 11,
                'name' => '11th Floor',
                'name_bn' => 'এগার নম্বর ফ্লোর',                
                'created_by' => 1
            ], [
                'id' => 12,
                'name' => '12th Floor',
                'name_bn' => 'বার নম্বর ফ্লোর',             
                'created_by' => 1
            ], [
                'id' => 13,
                'name' => '13th Floor',
                'name_bn' => 'তের নম্বর ফ্লোর',             
                'created_by' => 1
            ], [
                'id' => 14,
                'name' => '14th Floor',
                'name_bn' => 'চৌদ্দ নম্বর ফ্লোর',              
                'created_by' => 1
            ], [
                'id' => 15,
                'name' => '15th Floor',
                'name_bn' => 'পনের নম্বর ফ্লোর',           
                'created_by' => 1
            ]
        ];

        foreach ($datas as $key => $data) {
            $old = Floor::where('name', $data['name'])->first();
            if (!$old) {
                Floor::create($data);
            }
        }
        // DB::table('floors')->insert($floors);
    }
}
