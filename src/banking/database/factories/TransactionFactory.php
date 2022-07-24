<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Account;
use App\Models\Currency;

class TransactionFactory extends Factory
{
    protected const  UNDERLINE_SEPERATOR = '_';

    public function definition(): array
    {
        return [
    	    "from_account_id" => $this->faker->randomElement(Account::all()->pluck('id')),
    	    "to_account_id" => $this->faker->randomElement(Account::all()->pluck('id')),
    	    "currency_id" => $this->faker->randomElement(Currency::all()->pluck('id')),
    	    "amount" => $this->faker->numerify('##.##'),

    	];
    }
}
