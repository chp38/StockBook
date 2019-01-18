<?php

use Illuminate\Database\Seeder;

class TradeWatchlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Model\TradeWatchlist')->create();
    }
}
