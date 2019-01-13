<?php

use Faker\Generator as Faker;

$factory->define(App\Model\CurrencyPair::class, function (Faker $faker) {
    return [
        'name' => 'USD/JPY'
    ];
});
