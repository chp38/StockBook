<?php

use Faker\Generator as Faker;

$factory->define(App\Model\TradeDetail::class, function (Faker $faker) {
    return [
        'currency_pair_id' => function() {
            return factory('App\Model\CurrencyPair')->create()->id;
        },
        'user_id' => function() {
            return factory('App\Model\User')->create()->id;
        },
        'entry_price' => 1.2023
    ];
});
