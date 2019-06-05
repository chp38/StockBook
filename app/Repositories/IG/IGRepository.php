<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 04/06/2019
 * Time: 22:28
 */

namespace App\Repositories\IG;

class IGRepository implements IGRepositoryInterface
{
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