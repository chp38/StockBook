<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 2019-03-21
 * Time: 14:23
 */

namespace App\Services\Lists;

use App\Repositories\CurrencyPairs\CurrencyPairsRepository;
use App\Repositories\CurrentTrades\CurrentTradesRepository;
use App\Repositories\IG\IGRepositoryInterface;
use App\Repositories\TradeDetails\TradeDetailsRepository;
use Illuminate\Support\Facades\Auth;

class ActiveListService extends ListService
{
    /**
     * WatchlistService constructor.
     *
     * @param CurrentTradesRepository $repo
     * @param TradeDetailsRepository  $tradeDetails
     * @param IGRepositoryInterface   $igRepo
     * @param CurrencyPairsRepository $pairs
     */
    public function __construct(
        CurrentTradesRepository $repo,
        TradeDetailsRepository $tradeDetails,
        IGRepositoryInterface $igRepo,
        CurrencyPairsRepository $pairs
    )
    {
        parent::__construct($repo, $tradeDetails, $igRepo, $pairs);
    }

    /**
     * Add currency pair to Watchlist and trade detail
     *
     * @param int $pairId
     *
     * @return mixed
     * @throws \Exception
     */
    public function addCurrencyPair(Int $pairId)
    {
        $pair = $this->pairs->find($pairId);

        if (!$pair) {
            throw new \Exception("Currency pair not found, can't create trade!");
        } else {
            $active = $this->repository->create([]);
            $price = $this->igRepo->getCurrentPriceInformation($pair->name);

            $detail = $this->tradeDetails->create(
                [
                    'currency_pair_id' => (int) $pairId,
                    'user_id'          => Auth::user()->id,
                    'entry_price'      => $price,
                    'detailable_id'    => $active->id,
                    'detailable_type'  => 'App\Model\CurrentTrade'
                ]
            );
        }

        return $active;
    }

    /**
     * Function to close a current trade.
     *
     * @param Int $id of the current trade
     */
    public function closeCurrentTrade(Int $id)
    {
        $trade = $this->repository->find($id);

        //$trade->

        // TODO:
            // - Current trade now becomes 'Recent'

        // Consider (Two flows) :
        // - Watchlist -> Current -> recent
        // - current -> recent
        //      - Add a watchlist_id(nulllable) onto current_trades
        //      - Add a current_trade_id(nullable) onto recent_trades
        //
        // This essentially means: trades can only go from left to right
        // never going from current -> watchlist (re add commodity to watchlist)
        // certainly never going to go from recent -> current.
        // closed_at on each table (don't wan't to soft delete)
        //
        // A recent item should be able to fully describe the flow from right to left
        // watchlist -> (AND OR) current_trade -> recent by the id.

        // Will only be deleted_at at if the user manually deletes a recent item
        // this then back deletes the current and watchlist items
    }
}