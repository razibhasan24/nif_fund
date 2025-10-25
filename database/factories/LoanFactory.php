<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Member;

class LoanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'member_id' => Member::factory(),
            'amount' => fake()->numberBetween(5000, 20000),
            'installments' => fake()->numberBetween(3, 10),
            'paid_amount' => fake()->numberBetween(0, 5000),
            'status' => fake()->randomElement(['active', 'closed']),
        ];
    }
}
