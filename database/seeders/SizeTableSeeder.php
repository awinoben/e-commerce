<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class SizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = array(
            'Red',
            'Blue',
            'Yellow'
        );

        foreach ($items as $item) {
            Color::query()->create([
                'value' => $item
            ]);
        }
    }
}
