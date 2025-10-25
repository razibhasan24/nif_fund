<?php

namespace Database\Factories;

use App\Models\Fund;
use Illuminate\Database\Eloquent\Factories\Factory;

class FundFactory extends Factory
{
    protected $model = Fund::class;

    public function definition()
    {
        return [
            'member_id' => 1,
            'amount' => $this->faker->numberBetween(1000, 5000),
            'month' => $this->faker->date('Y-m-01'),
        ];
    }
}
