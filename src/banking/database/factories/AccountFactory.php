<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Currency;

class AccountFactory extends Factory
{

    public function definition(): array
    {
        $balance = [$this->faker->numerify('###.##'), 0];
    	return [
            "owner" => $this->faker->name,
            "currency_id" => $this->faker->randomElement(Currency::all()->pluck('id')),
            "balance" => $this->faker->randomElement($balance)
        ];
    }
}
