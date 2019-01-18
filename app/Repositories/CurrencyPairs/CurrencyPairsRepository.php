<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 13/01/2019
 * Time: 21:38
 */

namespace App\Repositories\CurrencyPairs;


use App\Model\CurrencyPair;
use App\Repositories\EloquentRepository;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CurrencyPairsRepository extends EloquentRepository implements RepositoryInterface
{
    /**
     * CurrencyPairsRepository constructor.
     * @param CurrencyPair $model
     */
    public function __construct(CurrencyPair $model)
    {
        parent::__construct($model);
    }
}