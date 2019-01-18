<?php

use Illuminate\Database\Seeder;

class TradeDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Model\TradeDetail')->create();
    }
}
