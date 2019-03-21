<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 2019-03-21
 * Time: 14:22
 */

namespace App\Services\Lists;

use App\Repositories\RepositoryInterface;

class ListService
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * ListService constructor.
     *
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all the list items
     * @return mixed
     */
    public function getAll()
    {
        return $this->repository->all();
    }
}