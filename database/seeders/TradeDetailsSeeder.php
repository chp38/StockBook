<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Model\TradeDetail;

class TradeDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TradeDetail::factory()->create();
    }
}
