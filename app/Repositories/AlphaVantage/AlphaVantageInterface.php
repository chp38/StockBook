<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 18/01/2019
 * Time: 21:48
 */

namespace App\Repositories\AlphaVantage;


interface AlphaVantageInterface
{
    // get currencyPairCrossSection()
        // - get the data for a currency pair between 2 given dates ??

    /**
     * Get the current exchange rate for a given pair
     *
     * @param String $pair
     * @return mixed
     */
    public function getCurrentPriceInformation(String $pair);
}