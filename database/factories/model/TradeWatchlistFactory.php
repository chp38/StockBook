<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

$factory->define(App\Model\TradeWatchlist::class, function (Faker $faker) {
    return [
        'trade_details_id' => function() {
            return factory('App\Model\TradeDetail')->create()->id;
        }
    ];
});
