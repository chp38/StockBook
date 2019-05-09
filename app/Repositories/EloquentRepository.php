<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

/**
 * Class BaseRepository
 * @package App\Repositories
 */
abstract class EloquentRepository implements RepositoryInterface
{
    /**
     * @var Model to use
     */
    protected $model;

    /**
     * Repository constructor.
     * @param $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Find by id
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Create a new record
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update by a given id, an array of values
     *
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        try {
            $record = $this->model->find($id);

            if (!$record) {
                return false;
            }

            $result = $record->update($data);
        } catch (QueryException $qe) {
            return false;
        }

        return $result;
    }

    /**
     * Delete by id
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Get all of the results
     *
     * @return mixed
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Get all of the results
     *
     * @return mixed
     */
    public function getAllForUser($user)
    {
        return $this->model->whereHas('detail', function ($query) use($user){
            $query->where('user_id', $user);
        })->get();
    }

    /**
     * Where Id is in
     *
     * @param array $ids
     * @return mixed
     */
    public function whereIdIn($ids)
    {
        return $this->model->whereIn($ids);
    }

    /**
     * Find where a particular field is set to a given value
     *
     * @param $field
     * @param $value
     * @return mixed
     */
    public function findWhere($field, $value)
    {
        return $this->model->where($field, $value)->get();
    }
}
