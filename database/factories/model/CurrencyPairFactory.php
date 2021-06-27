<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

$factory->define(App\Model\CurrencyPair::class, function (Faker $faker) {
    return [
        'name' => 'AUD/JPY'
    ];
});
