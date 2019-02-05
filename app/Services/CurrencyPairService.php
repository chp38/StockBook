<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 13/01/2019
 * Time: 21:28
 */

namespace App\Services;


use App\Repositories\AlphaVantage\AlphaVantageInterface;
use App\Repositories\CurrencyPairs\CurrencyPairsRepository;

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
     * @param  CurrencyPairsRepository  $repository
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
     * @return  mixed
     */
    public function getAllPairs()
    {
        return $this->repository->all();
    }

    /**
    * Get the current price for a given currency pair
    *
    * @param  int  id
    * @return  CurrenyPair
    */
    public function getCurrencyPair($id)
    {
        $this->repository->find($id);
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

        return $this->alphaVantage->getCurrentPriceInformation($pair->name);
    }
}
