<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 2019-03-21
 * Time: 14:23
 */

namespace App\Services\Lists;

use App\Repositories\CurrentTrades\CurrentTradesRepository;
use App\Repositories\TradeDetails\TradeDetailsRepository;
use Illuminate\Support\Facades\Auth;

class ActiveListService extends ListService
{
    /**
     * WatchlistService constructor.
     *
     * @param CurrentTradesRepository $repo
     * @param TradeDetailsRepository  $tradeDetails
     */
    public function __construct(CurrentTradesRepository $repo, TradeDetailsRepository $tradeDetails)
    {
        parent::__construct($repo, $tradeDetails);

        $this->repository = $repo;
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