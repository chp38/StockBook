<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 2019-03-21
 * Time: 14:23
 */

namespace App\Services\Lists;

use App\Repositories\CurrentTrades\CurrentTradesRepository;

class ActiveListService extends ListService
{
    /**
     * WatchlistService constructor.
     * @param CurrentTradesRepository $repo
     */
    public function __construct(CurrentTradesRepository $repo)
    {
        parent::__construct($repo);

        $this->repository = $repo;
    }}