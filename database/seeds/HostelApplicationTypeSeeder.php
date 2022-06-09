<?php
use App\Model\HostelApplicationType;
use Illuminate\Database\Seeder;

class HostelApplicationTypeSeeder extends Seeder
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
                'subject' => 'সংসদ সদস্য হোস্টেল বরাদ্দের জন্য আবেদন।',
                'type_name' => 'hostelAllotment',
                'created_by' => 1,
            ], [
                'id' => 2,
                'subject' => 'সংসদ সদস্য হোস্টেল বরাদ্দ বাতিলের জন্য আবেদন।',
                'type_name' => 'hostelCancel',
                'created_by' => 1,
            ], [
                'id' => 3,
                'subject' => 'সংসদ সদস্য হোস্টেল বরাদ্দ পরিবর্তনের জন্য আবেদন।',
                'type_name' => 'hostelExchange',
                'created_by' => 1,
            ],
        ];

        foreach ($datas as $key => $data) {
            $old = HostelApplicationType::where('subject', $data['subject'])->first();
            if (!$old) {
                HostelApplicationType::create($data);
            }
        }
    }
}
