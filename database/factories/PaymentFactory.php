<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Payment;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'amount' => $this->faker->numberBetween(1000, 5000),
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
        ];
    }
}
