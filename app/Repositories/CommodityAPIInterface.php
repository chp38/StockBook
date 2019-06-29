<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 04/06/2019
 * Time: 22:33
 */

namespace App\Repositories;

interface CommodityAPIInterface
{
    /**
     * Get the current exchange rate for a given pair
     *
     * @param String $pair
     * @return mixed
     */
    public function getCurrentPriceInformation(String $pair);

    /**
     * @param String $pair
     * @param $interval
     * @return mixed
     */
    public function getIntraDayInformation(String $pair, $interval);

    /**
     * @param String $pair
     * @return mixed
     */
    public function getDailyInformation(String $pair);

    /**
     * @param String $pair
     * @return mixed
     */
    public function getWeeklyInformation(String $pair);
}