<?php

namespace Tests\Unit;

use App\Model\CurrencyPair;
use App\Model\User;
use App\Repositories\CurrencyPairs\CurrencyPairsRepository;
use App\Repositories\IG\IGRepository;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IGRepoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var IGRepository
     */
    private $repo;

    public function setUp(): void
    {
        parent::setUp();

        $this->fakeGuzzle();
        $this->repo = $this->getIGRepository();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetIntraday()
    {
        $this->appendToHandler(200, ['X-SECURITY-TOKEN' => '1234', 'CST' => 1234]);
        $this->appendToHandler(200, [], '{"markets":{"1":{"instrumentName":"GBP/USD","epic":"CS.D.GBPUSD.CFD.IP"}}}');
        $pair = factory(CurrencyPair::class)->create([
            'name' => 'GBP/USD'
        ]);

        $epic = $this->repo->getEpic($pair->name);

        $this->assertEquals('CS.D.GBPUSD.CFD.IP', $epic);
    }

    /**
     * Test getting current price information
     */
    public function testGetPriceInfo()
    {
        $this->appendToHandler(200, ['X-SECURITY-TOKEN' => '1234', 'CST' => 1234]);
        $this->appendToHandler(200, [], '{"markets":{"1":{"instrumentName":"GBP/USD","epic":"CS.D.GBPUSD.CFD.IP"}}}');
        $this->appendToHandler(200, [], '{"snapshot":{"offer":"1.23093"}}');
        $pair = factory(CurrencyPair::class)->create([
            'name' => 'GBP/USD'
        ]);

        $info = $this->repo->getCurrentPriceInformation($pair->name);

        $this->assertNotNull($info);
        $this->assertEquals('1.23093', $info);
    }
}
