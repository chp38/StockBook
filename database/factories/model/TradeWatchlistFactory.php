<?php

namespace Database\Factories\Model;

use App\Model\TradeWatchlist;
use App\Model\TradeDetail;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class TradeWatchlistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TradeWatchlist::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'trade_details_id' => function() {
                return TradeDetail::factory()->create()->id;
            }
        ];
    }
}
