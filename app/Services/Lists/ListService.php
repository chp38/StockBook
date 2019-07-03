<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 2019-03-21
 * Time: 14:22
 */

namespace App\Services\Lists;

use App\Model\TradeWatchlist;
use App\Repositories\CurrencyPairs\CurrencyPairsRepository;
use App\Repositories\IG\IGRepositoryInterface;
use App\Repositories\RepositoryInterface;
use App\Repositories\TradeDetails\TradeDetailsRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ListService
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @var IGRepositoryInterface
     */
    protected $igRepo;

    /**
     * @var TradeDetailsRepository
     */
    protected $tradeDetails;

    /**
     * @var CurrencyPairsRepository
     */
    protected $pairs;

    /**
     * ListService constructor.
     *
     * @param RepositoryInterface        $repository
     * @param RepositoryInterface|null   $tradeDetails
     * @param IGRepositoryInterface|null $igRepo
     * @param CurrencyPairsRepository    $pairs
     */
    public function __construct(
        RepositoryInterface $repository = null,
        RepositoryInterface $tradeDetails = null,
        IGRepositoryInterface $igRepo = null,
        CurrencyPairsRepository $pairs = null
    )
    {
        $this->repository = $repository;
        $this->tradeDetails = $tradeDetails;
        $this->igRepo = $igRepo;
        $this->pairs = $pairs;
    }

    /**
     * Get all the list items
     *
     * @param null $user
     *
     * @return mixed
     */
    public function getAll($user = null)
    {
        if($user === null){
            $user = Auth::user()->id;
        }

        return $this->repository->getAllForUser($user);
    }

    /**
     * Add a currency pair to a list from the homepage
     *
     * @param String $listType
     * @param Int    $pairId
     * @return TradeWatchlist
     */
    public function addFromHomepage($listType, $pairId)
    {
        switch($listType) {
            case 'watchlist':
                $service = app()->make('\App\Services\Lists\WatchlistService');
                break;
            case 'trades':
                $service = app()->make('\App\Services\Lists\ActiveListService');
                break;
            default:
                $service = app()->make('\App\Services\Lists\WatchlistService');
                break;
        }

        return $service->addCurrencyPair($pairId);
    }

    /**
     * Get a single item from one of the lists
     *
     * @param $id
     *
     * @return mixed
     */
    public function getItem($id)
    {
        return $this->repository->find($id);
    }

    public function calculatePipDifference(Model $trade)
    {
        // Calculate the pip difference for a given trade
    }

    public function calculateProfit()
    {
        // Calculate profit of
    }
}