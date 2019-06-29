<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 04/06/2019
 * Time: 22:36
 */

namespace App\Repositories\IG;

use App\Repositories\CommodityAPIInterface;

interface IGRepositoryInterface extends CommodityAPIInterface
{
    /**
     * Take a given trade
     */
    public function placeTrade();

    /**
     * Execute a given trade
     */
    public function executeTrade();

    /**
     * Get the epic for a given currency pair
     *
     * @param String $pair
     * @return mixed|String
     */
    public function getEpic(String $pair);
}