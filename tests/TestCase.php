<?php

namespace Tests;

use App;
use App\Repositories\IG\IGRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * TestCase constructor.
     */
    public function __construct()
    {
        $this->app = $this->createApplication();

        parent::__construct();
    }

    /**
     * @var MockHandler
     */
    protected $mockHandler;

    /**
     * Fake Guzzle Client
     */
    public function fakeGuzzle()
    {
        $this->mockHandler = new MockHandler();
        $handler = HandlerStack::create($this->mockHandler);
        $client = new Client(['handler' => $handler]);

        $this->app->instance(Client::class, $client);
    }

    /**
     * Append a request result to the handler
     *
     * @param int    $statusCode
     * @param array  $headers
     * @param string $body
     * @param string $version
     * @param string $reason
     */
    protected function appendToHandler($statusCode = 200, $headers = [], $body = '', $version = '1.1', $reason = '')
    {
        $this->mockHandler->append(new Response($statusCode, $headers, $body, $version, $reason));
    }

    /**
     * Get an IG Repository instance
     *
     * @return IGRepository
     */
    protected function getIGRepository()
    {
        return App::make(IGRepository::class);
    }
}
