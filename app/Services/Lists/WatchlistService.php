<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 03/01/2019
 * Time: 21:19
 */

 namespace App\Services\Lists;

use App\Repositories\TradeDetails\TradeDetailsRepository;
use App\Repositories\TradeWatchlist\TradeWatchlistRepository;
use Illuminate\Support\Facades\Auth;

class WatchlistService extends ListService
{
    /**
     * WatchlistService constructor.
     *
     * @param TradeWatchlistRepository $repo
     * @param TradeDetailsRepository   $detailsRepo
     */
    public function __construct(TradeWatchlistRepository $repo, TradeDetailsRepository $detailsRepo)
    {
        parent::__construct($repo, $detailsRepo);

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

    /**
     * Add currency pair to Watchlist and trade detail
     *
     * @param $pairId
     * @return mixed
     */
    public function addCurrencyPair($pairId)
    {
        $detail = $this->tradeDetails->create([
            'currency_pair_id' => (int)$pairId,
            'user_id' => Auth::user()->id,
            'entry_price' => 1.20
        ]);

        $watchlist = $this->repository->create([
            'trade_details_id' => $detail->id
        ]);

        return $watchlist;
    }
}
