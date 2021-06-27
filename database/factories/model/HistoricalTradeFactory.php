<?php

namespace Database\Factories\Model;

use Faker\Generator as Faker;
use App\Model\HistoricalTrade;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoricalTradeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HistoricalTrade::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }
}
