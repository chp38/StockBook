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
use App\Repositories\IG\IGRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CurrencyPairService
{
    /**
     * @var CurrencyPairsRepository
     */
    protected $repository;

    /**
    * @var IGRepositoryInterface
    */
    protected $igrepository;

    /**
     * CurrencyPairService constructor.
     *
     * @param CurrencyPairsRepository $repository
     * @param IGRepositoryInterface   $igrepo
     */
    public function __construct(
      CurrencyPairsRepository $repository,
      IGRepositoryInterface $igrepo
    )
    {
        $this->repository = $repository;
        $this->igrepository = $igrepo;
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
            return $this->igrepository->getCurrentPriceInformation($pair->name);
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
            return $this->igrepository->getIntraDayInformation($pair->name, '5min');
        }

        return false;
    }

    /**
     * Get all the currency pairs and update their IG Epic.
     */
    public function updatePairEpics()
    {
        $pairs = $this->getAllPairs();

        foreach ($pairs as $pair) {
            $epic = $this->igrepository->getEpic($pair->name);

            if ($epic) {
                $this->repository->update($pair->id, ['ig_epic' => $epic]);
            }
        }
    }
}
