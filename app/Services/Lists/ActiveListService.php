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
use mysql_xdevapi\Exception;

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
}