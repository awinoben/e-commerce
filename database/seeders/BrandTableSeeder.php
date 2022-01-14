<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = array(
            'Lenovo',
            'Dell',
            'HP',
            'Mac',
            'EPSON',
            'Kyocera',
            'Canon',
            'DLINK',
            'HUAWEI',
            'CISCO'
        );

        foreach ($brands as $brand) {
            Brand::query()->create([
                'name' => $brand
            ]);
        }
    }
}
