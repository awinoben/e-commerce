<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use ShiftechAfrica\CodeGenerator\Seeds\ShiftCodeGeneratorFactory;
use World\Countries\Seeds\WorldCountriesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(WorldCountriesTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        User::factory()->create();
        Admin::factory()->create();
        $this->call(ShiftCodeGeneratorFactory::class);
        $this->call(ColorTableSeeder::class);
        $this->call(SizeTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(LocationTableSeeder::class);
        $this->call(PaymentOptionTableSeeder::class);
        $this->call(BrandTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(FilterTypeTableSeeder::class);
    }
}
