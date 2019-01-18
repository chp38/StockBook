<?php

use Faker\Generator as Faker;

$factory->define(App\Model\TradeWatchlist::class, function (Faker $faker) {
    return [
        'trade_details_id' => function() {
            return factory('App\Model\TradeDetail')->create()->id;
        }
    ];
});
