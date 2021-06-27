<?php

namespace Database\Factories\Model;

use App\Model\CurrencyPair;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyPairFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CurrencyPair::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'AUD/JPY'
        ];
    }
}