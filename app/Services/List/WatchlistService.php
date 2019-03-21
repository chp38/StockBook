<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 03/01/2019
 * Time: 21:19
 */

 namespace App\Services\List;

use App\Repositories\TradeWatchlist\TradeWatchlistRepository;

class WatchlistService
{
    /**
     * @var TradeWatchlistRepository
     */
    protected $watchlistRepo;

    /**
     * WatchlistService constructor.
     * @param TradeWatchlistRepository $repo
     */
    public function __construct(TradeWatchlistRepository $repo)
    {
        $this->watchlistRepo = $repo;
    }

    /**
     * Get all the current watchlist items
     * @return mixed
     */
    public function getAllWatchlist()
    {
        return $this->watchlistRepo->all();
    }

    /**
     * Get a single watchlist item by id
     * @param $id
     * @return mixed
     */
    public function getWatchlistItem($id)
    {
        return $this->watchlistRepo->find($id);
    }
}
