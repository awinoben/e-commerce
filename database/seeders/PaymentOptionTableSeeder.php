<?php

namespace Database\Seeders;

use App\Models\PaymentOption;
use Illuminate\Database\Seeder;

class PaymentOptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = array(
            'Cash on Delivery',
            'M-PESA',
            'Stripe',
            'PayPal'
        );

        foreach ($options as $option) {
            PaymentOption::query()->create([
                'name' => $option
            ]);
        }
    }
}
