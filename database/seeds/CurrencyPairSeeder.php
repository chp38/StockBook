<?php

use Illuminate\Database\Seeder;

class CurrencyPairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Model\CurrencyPair')->create([
            'name' => 'USD/JPY'
        ]);

        factory('App\Model\CurrencyPair')->create([
            'name' => 'GBP/USD'
        ]);

        factory('App\Model\CurrencyPair')->create([
            'name' => 'AUD/CAD'
        ]);

        factory('App\Model\CurrencyPair')->create([
            'name' => 'EUR/USD'
        ]);
    }
}
