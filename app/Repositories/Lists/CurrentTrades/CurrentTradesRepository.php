<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 2019-03-21
 * Time: 14:32
 */

namespace App\Repositories\Lists\CurrentTrades;

use App\LRepositories\Lists\ListRepositoryInterface;
use App\Model\CurrentTrade;
use App\Repositories\EloquentRepository;

class CurrentTradesRepository extends EloquentRepository implements ListRepositoryInterface
{
    /**
     * TradeWatchlistRepository constructor.
     * @param CurrentTrade $model
     */
    public function __construct(CurrentTrade $model)
    {
        parent::__construct($model);
    }

    /**
     * Function to take a given current trade, and close it.
     *
     * @param int $id id of the trade
     *
     * @return bool
     */
    public function closeTrade($id): bool
    {
        // TODO: Implement closeTrade() method.
    }
}