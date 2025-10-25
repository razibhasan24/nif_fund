<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class MemberFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'join_date' => now(),
        ];
    }
}
