<?php

namespace Database\Seeders;

use App\Models\FilterType;
use Illuminate\Database\Seeder;

class FilterTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $processors = [
            'Intel® Core™ i9',
            'Intel® Core™ i7',
            'AMD Ryzen™ 7',
            'Intel® Core™ i5',
            'AMD Ryzen™ 5',
            'Intel® Core™ i3',
            'AMD Ryzen™ 3',
            'Intel® Pentium®',
            'Intel® (other series)'
        ];

        foreach ($processors as $processor) {
            FilterType::query()->create([
                'name' => $processor,
                'type' => 'Processor'
            ]);
        }

        $hardDrives = [
            'Less than 500 GB',
            '500 Gb to 1TB',
            'More than 1 TB'
        ];

        foreach ($hardDrives as $hardDrive) {
            FilterType::query()->create([
                'name' => $hardDrive,
                'type' => 'Hard Drive'
            ]);
        }

        $hardDrivesTypes = [
            'Solid State Drive (SSD)',
            'Hard Disk Drive (HDD)',
            'Embedded Multimedia Card (eMMC)'
        ];

        foreach ($hardDrivesTypes as $hardDrive) {
            FilterType::query()->create([
                'name' => $hardDrive,
                'type' => 'Hard Drive Type'
            ]);
        }

        $memories = [
            '4 GB',
            '8 GB',
            '16 GB',
            '32 GB',
            '64 GB'
        ];

        foreach ($memories as $memory) {
            FilterType::query()->create([
                'name' => $memory,
                'type' => 'Memory'
            ]);
        }

        $oss = [
            'Chrome OS™',
            'Windows 10 Home',
            'Windows 10 Home in S mode',
            'Windows 10 Pro',
            'IOS'
        ];

        foreach ($oss as $data) {
            FilterType::query()->create([
                'name' => $data,
                'type' => 'Operating System'
            ]);
        }

    }
}
