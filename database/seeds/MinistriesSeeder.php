<?php
/**
 * Author M. Atoar Rahman
 * Date: 24/01/2021
 * Time: 11:40 AM
 */
use App\Model\Ministry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MinistriesSeeder extends Seeder
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
                'name' => 'Cabinet Division',
                'name_bn' => 'মন্ত্রিপরিষদ বিভাগ',
                'created_by' => 1,
            ], [
                'id' => 2,
                'name' => 'Ministry of Public Administration',
                'name_bn' => 'জনপ্রশাসন মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 3,
                'name' => 'Ministry of Defence',
                'name_bn' => 'প্রতিরক্ষা মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 4,
                'name' => 'Armed Forces Division',
                'name_bn' => 'সশস্ত্র বাহিনী বিভাগ',
                'created_by' => 1,
            ], [
                'id' => 5,
                'name' => 'Ministry of Power, Energy and Mineral Resources',
                'name_bn' => 'বিদ্যুৎ, জ্বালানি ও খনিজ সম্পদ মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 6,
                'name' => 'Ministry of Finance',
                'name_bn' => 'অর্থ মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 7,
                'name' => 'Ministry of Industries',
                'name_bn' => 'শিল্প মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 8,
                'name' => 'Ministry of Commerce',
                'name_bn' => 'বাণিজ্য মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 9,
                'name' => 'Ministry of Agriculture',
                'name_bn' => 'কৃষি মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 10,
                'name' => 'Ministry of Home Affairs',
                'name_bn' => 'স্বরাষ্ট্র মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 11,
                'name' => 'Ministry of Health and Family Welfare',
                'name_bn' => 'স্বাস্থ্য ও পরিবার কল্যাণ মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 12,
                'name' => 'Ministry of Local Government, Rural Development and Co-operatives',
                'name_bn' => 'স্থানীয় সরকার, পল্লী উন্নয়ন ও সমবায় মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 13,
                'name' => 'Ministry of Science and Technology',
                'name_bn' => 'বিজ্ঞান ও প্রযুক্তি মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 14,
                'name' => 'Ministry of Fisheries and Livestock',
                'name_bn' => 'মৎস্য ও প্রাণিসম্পদ মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 15,
                'name' => 'Ministry of Liberation War Affairs',
                'name_bn' => 'মুক্তিযুদ্ধ বিষয়ক মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 16,
                'name' => 'Ministry of Textiles and Jute',
                'name_bn' => 'পাট ও বস্ত্র মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 17,
                'name' => 'Ministry of Road Transport and Bridges',
                'name_bn' => 'সড়ক পরিবহন ও সেতু মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 18,
                'name' => 'Ministry of Information',
                'name_bn' => 'তথ্য মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 19,
                'name' => 'Ministry of Environment and Forest',
                'name_bn' => 'পরিবেশ ও বন মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 20,
                'name' => 'Ministry of Education',
                'name_bn' => 'শিক্ষা মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 21,
                'name' => 'Ministry of Law, Justice and Parliamentary Affairs',
                'name_bn' => 'আইন, বিচার ও সংসদ বিষয়ক মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 22,
                'name' => 'Ministry of Foreign Affairs',
                'name_bn' => 'পররাষ্ট্র মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 23,
                'name' => 'Ministry of Railways',
                'name_bn' => 'রেলপথ মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 24,
                'name' => 'Ministry of Planning',
                'name_bn' => 'পরিকল্পনা মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 25,
                'name' => 'Posts and Telecommunications Division',
                'name_bn' => 'ডাক ও টেলিযোগাযোগ বিভাগ',
                'created_by' => 1,
            ], [
                'id' => 26,
                'name' => 'Ministry of Land',
                'name_bn' => 'ভূমি মন্ত্রণালয়',
                'created_by' => 1,
            ], [
                'id' => 27,
                'name' => 'Ministry of Food',
                'name_bn' => 'খাদ্য মন্ত্রনালয়',
                'created_by' => 1,
            ], [
                'id' => 28,
                'name' => 'Ministry of Social Welfare',
                'name_bn' => 'সমাজকল্যাণ মন্ত্রনালয়',
                'created_by' => 1,
            ], [
                'id' => 29,
                'name' => 'Ministry of Chittagong Hill Tracts Affairs',
                'name_bn' => 'পার্বত্য চট্টগ্রাম বিষয়ক মন্ত্রনালয়',
                'created_by' => 1,
            ], [
                'id' => 30,
                'name' => 'Ministry of Expatriates Welfare and Overseas Employment',
                'name_bn' => 'প্রবাসী কল্যাণ ও বৈদেশিক কর্মসংস্থান মন্ত্রনালয়',
                'created_by' => 1,
            ],
        ];

        foreach ($datas as $key => $data) {
            $old = Ministry::where('id', $data['id'])->first();
            if (!$old) {
                Ministry::create($data);
            }
        }
        // DB::table('ministries')->insert($ministries);
    }
}
