<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 07/01/2019
 * Time: 23:06
 */

namespace App\Repositories\TradeWatchlist;

use App\Model\TradeWatchlist;
use App\Repositories\RepositoryInterface;
use App\Repositories\EloquentRepository;

class TradeWatchlistRepository extends EloquentRepository implements RepositoryInterface
{
    /**
     * TradeWatchlistRepository constructor.
     * @param TradeWatchlist $model
     */
    public function __construct(TradeWatchlist $model)
    {
        parent::__construct($model);
    }
}