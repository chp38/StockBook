<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 04/06/2019
 * Time: 22:28
 */

namespace App\Repositories\IG;

use GuzzleHttp\Client;
use PhpParser\Node\Scalar\String_;

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
     *
     * Get config options for IG API
     */
    public function __construct()
    {
        $this->baseUrl = config('app.ig_api_url');
        $this->key     = config('app.ig_api_key');
        $this->user    = config('app.ig_api_user');

        $this->client = $client = new Client(
            [
                'base_uri' => $this->baseUrl
            ]
        );
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
        // TODO: Implement getCurrentPriceInformation() method.
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
        $url = "deal/session";
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
    private function parseResponse($prices)
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
     * Get the epic of the currency pair for IG
     */
    public function getPairEpic($pair)
    {
        // If the currency pair doesn't have an epic
        // get it from ig
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
        $epic = $this->getPairEpic($pair);
        $url = "deal/prices/$epic/" . self::resolution[$interval] . "/300";

        $response = $this->client->get($url, ['headers' => [
            'content-type' => 'application/json; charset=UTF-8',
            'Accept'       => 'application/json; charset=UTF-8',
            'Version'      => '2',
            'X-IG-API-KEY' => $this->key,
            'CST'          => $tokens['cst'],
            'X-SECURITY-TOKEN' => $tokens['token']
        ]]);

        return $this->parseResponse($response);
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
        $url = "deal/prices/$epic/" . self::resolution['day'] . "/300";

        $response = $this->client->get($url, ['headers' => [
            'content-type' => 'application/json; charset=UTF-8',
            'Accept'       => 'application/json; charset=UTF-8',
            'Version'      => '2',
            'X-IG-API-KEY' => $this->key,
            'CST'          => $tokens['cst'],
            'X-SECURITY-TOKEN' => $tokens['token']
        ]]);

        return $this->parseResponse($response);
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
        $url = "deal/prices/$epic/" . self::resolution['week'] . "/300";

        $response = $this->client->get($url, ['headers' => [
            'content-type' => 'application/json; charset=UTF-8',
            'Accept'       => 'application/json; charset=UTF-8',
            'Version'      => '2',
            'X-IG-API-KEY' => $this->key,
            'CST'          => $tokens['cst'],
            'X-SECURITY-TOKEN' => $tokens['token']
        ]]);

        return $this->parseResponse($response);
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
}}