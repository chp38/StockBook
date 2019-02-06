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
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
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
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @param array $ids
     * @return mixed
     */
    public function whereIdIn($ids)
    {
        return $this->model->whereIn($ids);
    }

    public function findWhere($field, $value)
    {
        return $this->model->where($field, $value)->get();
    }
}
