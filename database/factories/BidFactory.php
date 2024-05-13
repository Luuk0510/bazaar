<?php

namespace Database\Factories;

use App\Models\Bid;
use Illuminate\Database\Eloquent\Factories\Factory;

class BidFactory extends Factory
{
    protected $model = Bid::class;

    public function definition()
    {
        return [
            'amount' => $this->faker->randomNumber(2),
            'user_id' => \App\Models\User::factory(),
            'advertisement_id' => \App\Models\Advertisement::factory(),
            // Voeg andere velden toe zoals nodig
        ];
    }
}
