<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Loan;

class InstallmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'loan_id' => Loan::factory(),
            'amount' => fake()->numberBetween(1000, 3000),
            'payment_date' => fake()->dateTimeBetween('-3 months', '+3 months'),
        ];
    }
}
