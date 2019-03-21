<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 2019-03-21
 * Time: 14:32
 */

namespace App\Repositories\CurrentTrades;

use App\Model\CurrentTrade;
use App\Repositories\EloquentRepository;
use App\Repositories\RepositoryInterface;

class CurrentTradesRepository extends EloquentRepository implements RepositoryInterface
{
    /**
     * TradeWatchlistRepository constructor.
     * @param CurrentTrade $model
     */
    public function __construct(CurrentTrade $model)
    {
        parent::__construct($model);
    }
}