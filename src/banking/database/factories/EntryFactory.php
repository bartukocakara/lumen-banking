<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Account;
use App\Models\Currency;

class EntryFactory extends Factory
{
    public function definition(): array
    {
    	return [
            "account_id" => $this->faker->randomElement(Account::all()->pluck('id')),
            "currency_id" => $this->faker->randomElement(Currency::all()->pluck('id')),
            "amount" => $this->faker->numerify('##.##'),
    	];
    }
}
