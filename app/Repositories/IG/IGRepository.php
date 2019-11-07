<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 04/06/2019
 * Time: 22:28
 */

namespace App\Repositories\IG;

use App\Repositories\CurrencyPairs\CurrencyPairsRepository;
use GuzzleHttp\Client;

class IGRepository implements IGRepositoryInterface
{
    /**
     * The base URL endpoint
     *
     * @var \Illuminate\Config\Repository|mixed
     */
    protected $baseUrl;

    /**
     * The API key to use
     *
     * @var \Illuminate\Config\Repository|mixed
     */
    protected $key;

    /**
     * Username for the API
     *
     * @var \Illuminate\Config\Repository|mixed
     */
    protected $user;

    /**
     * The client to use for API requests
     *
     * @var Client
     */
    protected $client;

    /**
     * @var CurrencyPairsRepository
     */
    protected $pairRepository;

    /**
     * @const array allowed resolution types
     */
    const resolution = [
        'min' => 'MINUTE',
        '1min' => 'MINUTE_1',
        '5min' => 'MINUTE_5',
        '10min' => 'MINUTE_10',
        '15min' => 'MINUTE_15',
        '30min' => 'MINUTE_30',
        'hour' => 'HOUR',
        '2hour' => 'HOUR_2',
        '3hour' => 'HOUR_3',
        '4hour' => 'HOUR_4',
        'day' => 'DAY',
        'week' => 'WEEK',
    ];

    /**
     * IGRepository constructor.
     * Get config options for IG API
     *
     * @param CurrencyPairsRepository $pairRepository
     * @param Client                  $client
     */
    public function __construct(CurrencyPairsRepository $pairRepository, Client $client)
    {
        $this->baseUrl = config('app.ig_api_url');
        $this->key     = config('app.ig_api_key');
        $this->user    = config('app.ig_api_user');

        $this->client = $client;

        $this->pairRepository = $pairRepository;
    }

    /**
     * Get the current exchange rate for a given pair
     *
     * @param String $pair
     *
     * @return mixed
     */
    public function getCurrentPriceInformation(String $pair)
    {
        $tokens = $this->login();
        $epic = $this->getEpic($pair, $tokens);
        $url = "deal/markets/" . $epic;

        $response = $this->client->get($url, ['headers' => [
            'content-type' => 'application/json; charset=UTF-8',
            'Accept'       => 'application/json; charset=UTF-8',
            'Version'      => '2',
            'X-IG-API-KEY' => $this->key,
            'CST'          => $tokens['cst'],
            'X-SECURITY-TOKEN' => $tokens['token']
        ]]);

        $info = json_decode($response->getBody(), true);

        return $info['snapshot']['offer'];
    }

    /**
     * Log the user into the IG session
     * TODO:
     *  - Remember the token, in caching
     *
     * @return array
     */
    private function login()
    {
        $url = $this->baseUrl . "deal/session";
        $body = '{"identifier":"'.$this->user.'","password":"'.config('app.ig_api_pass').'"}';

        $response = $this->client->post($url, [
            'headers' => [
                'content-type' => 'application/json; charset=UTF-8',
                'Accept'       => 'application/json; charset=UTF-8',
                'X-IG-API-KEY' => $this->key,
            ],
            'body' => $body
        ]);

        return [
            'token' => $response->getHeader('X-SECURITY-TOKEN'),
            'cst' => $response->getHeader('CST')
        ];
    }

    /**
     * Parse the response from IG API
     *
     * @param $prices
     *
     * @return array
     */
    private function parsePriceResponse($prices)
    {
        $prices = json_decode($prices->getBody(), true);

        $timePrices = [];
        foreach ($prices['prices'] as $info) {
            $data = [
                'date'  => $info['snapshotTime'],
                'open'  => (String)$info['openPrice']['bid'],
                'high'  => (String)$info['highPrice']['bid'],
                'low'   => (String)$info['lowPrice']['bid'],
                'close' => (String)$info['closePrice']['bid'],
            ];

            array_push($timePrices, $data);
        }

        $intraDay = ['data' => $timePrices];

        return $intraDay;
    }

    /**
     * @param String $pair
     * @param String $interval
     *
     * @return mixed
     */
    public function getIntraDayInformation(String $pair, $interval)
    {
        $tokens = $this->login();
        $epic = $this->getEpic($pair);
        $url = $this->baseUrl . "deal/prices/$epic/" . self::resolution[$interval] . "/300";

        $response = $this->client->get($url, ['headers' => [
            'content-type' => 'application/json; charset=UTF-8',
            'Accept'       => 'application/json; charset=UTF-8',
            'Version'      => '2',
            'X-IG-API-KEY' => $this->key,
            'CST'          => $tokens['cst'],
            'X-SECURITY-TOKEN' => $tokens['token']
        ]]);

        return $this->parsePriceResponse($response);
    }

    /**
     * @param String $pair
     *
     * @return mixed
     */
    public function getDailyInformation(String $pair)
    {
        $tokens = $this->login();
        $epic = $this->getPairEpic($pair);
        $url = $this->baseUrl . "deal/prices/$epic/" . self::resolution['day'] . "/300";

        $response = $this->client->get($url, ['headers' => [
            'content-type' => 'application/json; charset=UTF-8',
            'Accept'       => 'application/json; charset=UTF-8',
            'Version'      => '2',
            'X-IG-API-KEY' => $this->key,
            'CST'          => $tokens['cst'],
            'X-SECURITY-TOKEN' => $tokens['token']
        ]]);

        return $this->parsePriceResponse($response);
    }

    /**
     * @param String $pair
     *
     * @return mixed
     */
    public function getWeeklyInformation(String $pair)
    {
        $tokens = $this->login();
        $epic = $this->getPairEpic($pair);
        $url = $this->baseUrl . "deal/prices/$epic/" . self::resolution['week'] . "/300";

        $response = $this->client->get($url, ['headers' => [
            'content-type' => 'application/json; charset=UTF-8',
            'Accept'       => 'application/json; charset=UTF-8',
            'Version'      => '2',
            'X-IG-API-KEY' => $this->key,
            'CST'          => $tokens['cst'],
            'X-SECURITY-TOKEN' => $tokens['token']
        ]]);

        return $this->parsePriceResponse($response);
    }

    /**
     * Get the epic for a given currency pair
     * TODO:
     *     - Get from local database if it exists.
     *
     * @param String $pair
     * @param array  $tokens
     *
     * @return bool|String
     */
    public function getEpic(String $pair, $tokens = [])
    {
        if (empty($tokens)) {
            $tokens = $this->login();
        }
        $pair = strtoupper($pair);
        $url = $this->baseUrl . "deal/markets?searchTerm=" . urlencode($pair);

        $response = $this->client->get($url, ['headers' => [
            'content-type' => 'application/json; charset=UTF-8',
            'Accept'       => 'application/json; charset=UTF-8',
            'Version'      => '1',
            'X-IG-API-KEY' => $this->key,
            'CST'          => $tokens['cst'],
            'X-SECURITY-TOKEN' => $tokens['token']
        ]]);

        $response = json_decode($response->getBody(), true);

        foreach ($response['markets'] as $market) {
            if ($market['instrumentName'] === $pair) {
                return $market['epic'];
            }
        }

        return false;
    }

    /**
     * Take a given trade
     */
    public function placeTrade()
    {
        // TODO: Implement placeTrade() method.
    }

    /**
     * Execute a given trade
     */
    public function executeTrade()
    {
        // TODO: Implement executeTrade() method.
    }
}