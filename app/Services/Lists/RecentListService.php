<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 2019-03-21
 * Time: 14:22
 */

namespace App\Services\Lists;

use App\Repositories\CurrencyPairs\CurrencyPairsRepository;
use App\Repositories\Lists\CurrentTrades\CurrentTradesRepository;
use App\Repositories\IG\IGRepositoryInterface;
use App\Repositories\TradeDetails\TradeDetailsRepository;

class RecentListService extends ListService
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
}