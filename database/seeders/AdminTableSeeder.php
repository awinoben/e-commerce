<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::query()->create([
            'name' => 'Collins Waweru',
            'email' => 'collinswaweru2002@gmail.com',
            'password' => bcrypt('collins@21'), // password
            'remember_token' => Str::random(10),
        ]);

        Admin::query()->create([
            'name' => 'Shantel Aloo',
            'email' => 'orebishan@gmail.com',
            'password' => bcrypt('shantel@2021'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
