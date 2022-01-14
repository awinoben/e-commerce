<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = array(
            'United States of America'
        );

        foreach ($locations as $location) {
            Location::query()->create([
                'name' => $location,
                'cost' => 200,
                'address' => '00100-nairobi'
            ]);
        }
    }
}
