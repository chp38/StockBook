<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 03/01/2019
 * Time: 21:19
 */

namespace App\Services;


use App\Repositories\TradeWatchlist\TradeWatchlistRepositoryInterface;

class WatchlistService
{
    /**
     * @var TradeWatchlistRepositoryInterface
     */
    protected $watchlistRepo;

    /**
     * WatchlistService constructor.
     * @param TradeWatchlistRepositoryInterface $repo
     */
    public function __construct(TradeWatchlistRepositoryInterface $repo)
    {
        $this->watchlistRepo = $repo;
    }

    public function getAllWatchlist()
    {
        // Todo
    }
}