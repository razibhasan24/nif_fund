<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Member;

class LoanRequestFactory extends Factory
{
    public function definition(): array
    {
        return [
            'member_id' => Member::factory(),
            'amount' => fake()->numberBetween(5000, 20000),
            'reason' => fake()->sentence(),
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
