<?php

namespace Tests\Unit;

use App\Model\CurrencyPair;
use App\Repositories\CurrencyPairs\CurrencyPairsRepository;
use App\Repositories\IG\IGRepository;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IGRepoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetIntraday()
    {
        Artisan::call('db:seed');

        $repo = new IGRepository(new CurrencyPairsRepository(new CurrencyPair()));

        $pair = CurrencyPair::where('name', 'GBP/USD')->first();

        $epic = $repo->getEpic($pair->name);

        $this->assertEquals('CS.D.GBPUSD.CFD.IP', $epic);
    }

    /**
     * Test getting current price information
     */
    public function testGetPriceInfo()
    {
        Artisan::call('db:seed');
        $repo = new IGRepository(new CurrencyPairsRepository(new CurrencyPair()));
        $pair = CurrencyPair::where('name', 'GBP/USD')->first();

        $info = $repo->getCurrentPriceInformation($pair->name);

        $this->assertNotNull($info);
    }
}
