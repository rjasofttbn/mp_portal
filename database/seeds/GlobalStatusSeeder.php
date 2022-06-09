<?php

use App\Model\Global_status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GlobalStatusSeeder extends Seeder
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
                'status_type' => 'notice',
                'status_name' => 'Draft',
                'name_bn' => 'খসড়া',
                'status_id' => 0,
                'status_color' => 'secondary',

            ], [
                'id' => 2,
                'status_type' => 'notice',
                'status_name' => 'Pending',
                'name_bn' => 'বিবেচনাধীন',
                'status_id' => 1,
                'status_color' => 'warning',

            ], [
                'id' => 3,
                'status_type' => 'notice',
                'status_name' => 'Approved',
                'name_bn' => 'অনুমোদিত',
                'status_id' => 5,
                'status_color' => 'success',

            ], [
                'id' => 4,
                'status_type' => 'notice',
                'status_name' => 'Rejected',
                'name_bn' => 'প্রত্যাখ্যাত',
                'status_id' => 2,
                'status_color' => 'danger',

            ], [
                'id' => 5,
                'status_type' => 'notice',
                'status_name' => 'Acceptable',
                'name_bn' => 'গ্রহণযোগ্য',
                'status_id' => 3,
                'status_color' => 'info',

            ], [
                'id' => 6,
                'status_type' => 'notice',
                'status_name' => 'Acceptable with correction',
                'name_bn' => 'সংশোধন সহ গ্রহণযোগ্য',
                'status_id' => 4,
                'status_color' => 'primary',

            ], [
                'id' => 7,
                'status_type' => 'notice',
                'status_name' => 'Already discussed',
                'name_bn' => 'ইতিমধ্যে আলোচিত',
                'status_id' => 7,
                'status_color' => 'default',

            ], [
                'id' => 8,
                'status_type' => 'notice',
                'status_name' => 'Waiting for Approval',
                'name_bn' => 'অনুমোদনযোগ্য',
                'status_id' => 6,
                'status_color' => 'default',

            ], [
                'id' => 9,
                'status_type' => 'notice',
                'status_name' => 'Closed',
                'name_bn' => 'তামাদি',
                'status_id' => -1,
                'status_color' => 'default',

            ], [
                'id' => 10,
                'status_type' => 'Accommodation-Hostel application',
                'status_name' => ' Draft',
                'name_bn' => 'খসড়া',
                'status_id' => 8,
                'status_color' => ''

            ], [
                'id' => 11,
                'status_type' => 'Accommodation-Hostel application',
                'status_name' => 'Application submit-Department pending',
                'name_bn' => 'বিবেচনাধীন',
                'status_id' => 9,
                'status_color' => ''

            ], [
                'id' => 12,
                'status_type' => 'Accommodation-Hostel application',
                'status_name' => 'Department Approved-Whip Pending',
                'name_bn' => 'অনুমোদনযোগ্য',
                'status_id' => 10,
                'status_color' => ''

            ], [
                'id' => 13,
                'status_type' => 'Accommodation-Hostel application',
                'status_name' => 'Department Rejected-Final Rejected',
                'name_bn' => 'প্রত্যাখ্যাত',
                'status_id' => 11,
                'status_color' => ''

            ], [
                'id' => 14,
                'status_type' => 'Accommodation-Hostel application',
                'status_name' => 'Whip Approved-Final Approved',
                'name_bn' => 'অনুমোদিত',
                'status_id' => 12,
                'status_color' => ''

            ], [
                'id' => 15,
                'status_type' => 'Accommodation-Hostel application',
                'status_name' => 'Whip Rejected-Final Rejected',
                'name_bn' => 'প্রত্যাখ্যাত',
                'status_id' => 13,
                'status_color' => ''

            ], [
                'id' => 16,
                'status_type' => 'Flat-house_building-office_room',
                'status_name' => 'Assigned',
                'name_bn' => 'আরোপিত',
                'status_id' => 14,
                'status_color' => ''

            ],  [
                'id' => 17,
                'status_type' => 'Flat-house_building-office_room',
                'status_name' => 'Available',
                'name_bn' => 'উপলব্ধ',
                'status_id' => 15,
                'status_color' => ''

            ], [
                'id' => 18,
                'status_type' => 'Flat-house_building-office_room',
                'status_name' => 'Not available',
                'name_bn' => 'উপলব্ধ নয়',
                'status_id' => 16,
                'status_color' => ''

            ], [
                'id' => 19,
                'status_type' => 'Flat-house_building-office_room',
                'status_name' => 'Allocated',
                'name_bn' => 'বরাদ্দকৃত',
                'status_id' => 17,
                'status_color' => ''

            ]

        ];

        foreach ($datas as $key => $data) {

            $old = Global_status::where('id', $data['id'])->first();
            if (!$old) {
                Global_status::create($data);
            }
        }
    }
}
