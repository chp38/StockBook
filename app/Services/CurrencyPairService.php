<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 13/01/2019
 * Time: 21:28
 */

namespace App\Services;


use App\Model\CurrencyPair;
use App\Repositories\AlphaVantage\AlphaVantageInterface;
use App\Repositories\CurrencyPairs\CurrencyPairsRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CurrencyPairService
{
    /**
     * @var CurrencyPairsRepository
     */
    protected $repository;

    /**
    * @var AlphaVantageInterface
    */
    protected $alphaVantage;

    /**
     * CurrencyPairService constructor.
     *
     * @param  CurrencyPairsRepository $repository
     * @param AlphaVantageInterface    $alphaVantage
     */
    public function __construct(
      CurrencyPairsRepository $repository,
      AlphaVantageInterface $alphaVantage
    )
    {
        $this->repository = $repository;
        $this->alphaVantage = $alphaVantage;
    }

    /**
     * Return all the currency pairs
     *
     * @return  Collection
     */
    public function getAllPairs()
    {
        return $this->repository->all();
    }

    /**
    * Get the current price for a given currency pair
    *
    * @param  int  id
    * @return \App|Model|CurrencyPair
    */
    public function getCurrencyPair($id)
    {
        return $this->repository->find($id);
    }

    /**
    * Get the current price for a given currency pair
    *
    * @param  int  id
    * @return float
    */
    public function getPairPrice($id)
    {
        $pair = $this->repository->find($id);

        if ($pair instanceof CurrencyPair) {
            return $this->alphaVantage->getCurrentPriceInformation($pair->name);
        }

        return false;
    }

    /**
     * Get the intra-day prices of currency pairs
     *
     * @param $id
     * @return bool|mixed
     */
    public function getPairPrices($id)
    {
        $pair = $this->repository->find($id);

        if ($pair instanceof CurrencyPair) {
            return $this->alphaVantage->getIntraDayInformation($pair->name, '5min');
        }

        return false;
    }
}
