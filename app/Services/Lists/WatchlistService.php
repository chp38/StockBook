<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 03/01/2019
 * Time: 21:19
 */

 namespace App\Services\Lists;

use App\Repositories\TradeWatchlist\TradeWatchlistRepository;

class WatchlistService extends ListService
{
    /**
     * WatchlistService constructor.
     * @param TradeWatchlistRepository $repo
     */
    public function __construct(TradeWatchlistRepository $repo)
    {
        parent::__construct($repo);

        $this->repository = $repo;
    }

    /**
     * Get all the current watchlist items
     * @return mixed
     */
    public function getAllWatchlist()
    {
        return $this->repository->all();
    }

    /**
     * Get a single watchlist item by id
     * @param $id
     * @return mixed
     */
    public function getWatchlistItem($id)
    {
        return $this->repository->find($id);
    }
}
