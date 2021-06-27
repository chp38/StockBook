<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Model\CurrencyPair;

class CurrencyPairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CurrencyPair::factory()->create([
            'name' => 'USD/JPY'
        ]);

        CurrencyPair::factory()->create([
            'name' => 'GBP/USD'
        ]);

        CurrencyPair::factory()->create([
            'name' => 'AUD/CAD'
        ]);

        CurrencyPair::factory()->create([
            'name' => 'EUR/USD'
        ]);
    }
}
