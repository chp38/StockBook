<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 03/01/2019
 * Time: 21:19
 */

 namespace App\Services\Lists;

use App\Repositories\CurrencyPairs\CurrencyPairsRepository;
use App\Repositories\Lists\CurrentTrades\CurrentTradesRepository;
use App\Repositories\IG\IGRepositoryInterface;
use App\Repositories\TradeDetails\TradeDetailsRepository;
use App\Repositories\Lists\TradeWatchlist\TradeWatchlistRepository;
use Illuminate\Support\Facades\Auth;

class WatchlistService extends ListService
{
    /**
     * WatchlistService constructor.
     *
     * @param TradeWatchlistRepository $repo
     * @param TradeDetailsRepository   $tradeDetails
     * @param IGRepositoryInterface    $igRepo
     * @param CurrencyPairsRepository  $pairs
     */
    public function __construct(
        TradeWatchlistRepository $repo,
        TradeDetailsRepository $tradeDetails,
        IGRepositoryInterface $igRepo,
        CurrencyPairsRepository $pairs
    )
    {
        parent::__construct($repo, $tradeDetails, $igRepo, $pairs);
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
     *
     * @return mixed
     * @throws \Exception
     */
    public function addCurrencyPair($pairId)
    {
        $pair = $this->pairs->find($pairId);

        if (!$pair) {
            throw new \Exception("Currency pair not found, can't create trade!");
        } else {
            $watchlist = $this->repository->create([]);
            $price = $this->igRepo->getCurrentPriceInformation($pair->name);
            $detail = $this->tradeDetails->create(
                [
                    'currency_pair_id' => (int) $pairId,
                    'user_id'          => Auth::user()->id,
                    'entry_price'      => $price,
                    'detailable_id'    => $watchlist->id,
                    'detailable_type'  => 'App\Model\TradeWatchlist'
                ]
            );
        }

        return $watchlist;
    }
}
