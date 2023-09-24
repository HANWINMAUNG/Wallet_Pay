<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,10),
            'amount' => $this->faker->numberBetween(100,10000),
            'account_number' => $this->faker->unique()->randomDigit,

        ];
    }
}
