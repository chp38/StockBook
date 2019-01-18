<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 13/01/2019
 * Time: 21:28
 */

namespace App\Services;


use App\Repositories\CurrencyPairs\CurrencyPairsRepository;

class CurrencyPairService
{
    /**
     * @var CurrencyPairsRepository
     */
    protected $repository;

    /**
     * CurrencyPairService constructor.
     * @param CurrencyPairsRepository $repository
     */
    public function __construct(CurrencyPairsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Return all the currency pairs
     * @return mixed
     */
    public function getAllPairs()
    {
        return $this->repository->all();
    }
}