<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class ColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = array(
            'Large',
            'Small',
            'X-Large',
            'X-Small',
            'Medium',
        );

        foreach ($items as $item) {
            Size::query()->create([
                'value' => $item
            ]);
        }
    }
}
