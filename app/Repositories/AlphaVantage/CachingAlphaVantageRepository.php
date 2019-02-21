<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 2019-02-12
 * Time: 23:13
 */

namespace App\Repositories\AlphaVantage;

use Illuminate\Support\Facades\Cache;

class CachingAlphaVantageRepository implements AlphaVantageInterface
{
    /**
     * @var AlphaVantageInterface
     */
    protected $repository;

    /**
     * @var Cache
     */
    protected $cache;

    /**
     * CachingAlphaVantageRepository constructor.
     *
     * @param AlphaVantageInterface $repository
     * @param Cache                 $cache
     */
    public function __construct(
        AlphaVantageInterface $repository,
        Cache $cache
    ) {
        $this->cache = $cache;
        $this->repository = $repository;
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
     * @param String $pair
     * @param        $interval
     *
     * @return mixed
     */
    public function getIntraDayInformation(String $pair, $interval)
    {
        // TODO: Implement getIntraDayInformation() method.
    }

    /**
     * @param String $pair
     *
     * @return mixed
     */
    public function getDailyInformation(String $pair)
    {
        // TODO: Implement getDailyInformation() method.
    }

    /**
     * @param String $pair
     *
     * @return mixed
     */
    public function getWeeklyInformation(String $pair)
    {
        // TODO: Implement getWeeklyInformation() method.
}}