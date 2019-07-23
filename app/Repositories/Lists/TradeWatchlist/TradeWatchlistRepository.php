<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 07/01/2019
 * Time: 23:06
 */

namespace App\Repositories\Lists\TradeWatchlist;

use App\Repositories\Lists\ListRepositoryInterface;
use App\Model\TradeWatchlist;
use App\Repositories\EloquentRepository;

class TradeWatchlistRepository extends EloquentRepository implements ListRepositoryInterface
{
    /**
     * TradeWatchlistRepository constructor.
     * @param TradeWatchlist $model
     */
    public function __construct(TradeWatchlist $model)
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