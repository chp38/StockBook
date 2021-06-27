<?php

namespace Database\Factories\Model;

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Model\User;
use App\Model\CurrencyPair;
use App\Model\TradeDetail;

class TradeDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TradeDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'currency_pair_id' => function() {
                return CurrencyPair::factory()->create()->id;
            },
            'user_id' => function() {
                return User::factory()->create()->id;
            },
            'entry_price' => 1.2023
        ];
    }
}