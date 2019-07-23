<?php

namespace App\LRepositories\Lists;

use App\Repositories\RepositoryInterface;

/**
 * Interface RepositoryInterface
 *
 * @package App\Repositories\Lists
 */
interface ListRepositoryInterface extends RepositoryInterface
{
    /**
     * Function to take a given current trade, and close it.
     *
     * @param int $id id of the trade
     *
     * @return bool
     */
    public function closeTrade($id) : bool;
}