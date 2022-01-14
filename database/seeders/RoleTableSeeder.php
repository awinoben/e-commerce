<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            'Merchant',
            'Customer'
        );

        $count = 1;

        foreach ($roles as $role) {
            Role::query()->create([
                'name' => $role,
                'description' => 'Give more details on what the ' . $role . ' does within the system.',
                'level' => $count++
            ]);
        }
    }
}
