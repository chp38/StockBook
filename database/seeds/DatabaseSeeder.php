<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(CurrencyPairSeeder::class);
        //$this->call(UserSeeder::class);
        //$this->call(TradeDetailsSeeder::class);
        $this->call(TradeWatchlistSeeder::class);
    }
}
