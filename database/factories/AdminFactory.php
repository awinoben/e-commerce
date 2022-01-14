<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => config('app.name'),
            'email' => 'admin@test.com',
            'phone_number' => '0713255791',
            'password' => bcrypt('secret_123'), // password
            'remember_token' => Str::random(10),
        ];
    }
}
