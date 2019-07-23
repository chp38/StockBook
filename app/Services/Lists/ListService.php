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
     *
     * @return TradeWatchlist
     * @throws \Exception
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
                throw new \Exception("Unknown list type $listType encountered");
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

    /**
     * Calculate the pip difference between the entry price and the
     * current price.
     *
     * @param String $name  commodity name
     * @param float  $entry entry price of the trade
     *
     * @return float|mixed the difference.
     */
    public function getPipDifference($name, $entry)
    {
        $current = $this->igRepo->getCurrentPriceInformation($name);

        return round($current - $entry, 5);
    }

    public function calculateProfit()
    {
        // Calculate profit of
    }

    /**
     * Function to create a historical item, from a current
     * trade item.
     * protected, only to be created from CurrentService when
     * transitioning from Current to Historical.
     *
     * @param Model $item
     *
     * @return Model
     */
    protected function createHistoricalTrade(Model $item) : Model
    {
        // Create historical through repo

        return $item;
    }

    /**
     * Function to create a current trade, from a watchlist item.
     * protected, only to be created from WatchlistService when
     * transitioning from watchlist to current.
     *
     * @param Model $item
     *
     * @return Model
     */
    protected function createCurrentTrade(Model $item) : Model
    {
        // create current through repo

        return $item;
    }
}