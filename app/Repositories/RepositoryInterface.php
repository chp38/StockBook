<?php

namespace App\Repositories;

/**
 * Interface RepositoryInterface
 * @package App\Repositories
 */
interface RepositoryInterface
{
    /**
    * Find a record by id
    * @param $id
    * @return mixed
    */
    public function find($id);

    /**
    * Create a record using data
    * @param array $data
    * @return mixed
    */
    public function create(array $data);

    /**
    * Update record by id with data
    * @param $id
    * @param array $data
    * @return mixed
    */
    public function update($id, array $data);

    /**
    * Delete a record by id
    * @param $id
    * @return mixed
    */
    public function delete($id);

    /**
    * Return all records
    * @return mixed
    */
    public function all();

    /**
     * Return all records for a given user
     *
     * @param $user
     *
     * @return mixed
     */
    public function getAllForUser($user);

    /**
    * @param $ids
    * @return mixed
    */
    public function whereIdIn($ids);

    /**
     * Find where a given field is a given value
     *
     * @param $field
     * @param $value
     * @return mixed
     */
    public function findWhere($field, $value);
}