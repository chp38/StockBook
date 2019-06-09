<?php

namespace Tests\Unit;

use App\Repositories\IG\IGRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IGRepoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetIntraday()
    {
        $repo = new IGRepository();

        $prices = $repo->getIntraDayInformation('GBP/USD', '5min');

        var_dump($prices);die;

    }
}
