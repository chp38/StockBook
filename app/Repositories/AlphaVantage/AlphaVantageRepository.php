<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 18/01/2019
 * Time: 21:59
 */

namespace App\Repositories\AlphaVantage;

use GuzzleHttp\Client;

class AlphaVantageRepository implements AlphaVantageInterface
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
     * The client to use for API requests
     *
     * @var Client
     */
    protected $client;

    /**
     * AlphaVantageRepository constructor.
     */
    public function __construct()
    {
        $this->baseUrl = config('app.alpha_vantage_url');
        $this->key = config('app.alpha_vantage_key');

        $this->client = $client = new Client([
            'base_uri' => $this->baseUrl
        ]);
    }

    /**
     * Get the current exchange rate for a given pair
     *
     * @param String $pair
     * @return mixed
     */
    public function getCurrentPriceInformation(String $pair)
    {
        $currencies = explode('/', $pair);

        $url = "query?function=CURRENCY_EXCHANGE_RATE&from_currency=$currencies[0]&to_currency=$currencies[1]&apikey=$this->key";

        $response = $this->client->get($url);
        $rate = json_decode($response->getBody(), true);

        // TODO: better way to do this?
        return $rate['Realtime Currency Exchange Rate']['5. Exchange Rate'];
    }

    /**
     * @param String $pair
     * @param $interval
     * @return mixed
     */
    public function getIntraDayInformation(String $pair, $interval)
    {
        $currencies = explode('/', $pair);

        $url = "query?function=FX_INTRADAY&from_symbol=$currencies[0]&to_symbol=$currencies[1]&interval=$interval&apikey=$this->key";

        $response = $this->client->get($url);
        $response = json_decode($response->getBody(), true);
        $prices = $response["Time Series FX ($interval)"];

        $timePrices = [];
        foreach($prices as $dateTime => $price) {
            //$time = explode(" ", $dateTime);
            $data = [
                'date' => $dateTime,
                'open' => $price['1. open'],
                'high' => $price['2. high'],
                'low' => $price['3. low'],
                'close' => $price['4. close']
            ];

            array_push($timePrices, $data);
        }

        $intraDay = ['data' => $timePrices];

        return $intraDay;
    }

    /**
     * @param String $pair
     * @return mixed
     */
    public function getDailyInformation(String $pair)
    {
        // TODO: Implement getDailyInformation() method.
    }

    /**
     * @param String $pair
     * @return mixed
     */
    public function getWeeklyInformation(String $pair)
    {
        // TODO: Implement getWeeklyInformation() method.
}}
