<?php

namespace App\Base;

use Exception;
use App\Helpers\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BaseRepository
 *
 * @package Modules\Core
 */
abstract class BaseRepository
{
    /**
     * @var BaseModel
     */
    private $model;

    /**
     * BaseRepository constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $model = $this->model();

        if (! $model instanceof Model) {
            $repositoryName = get_class($this);
            throw new Exception("{$repositoryName} provided model is invalid");
        }

        $this->model = $model;
    }

    /**
     * Get the repository model
     *
     * @return Model
     */
    abstract protected function model();

    /**
     * Find model or fail
     *
     * @param integer $id
     * @param null    $errorMessage
     *
     * @return BaseModel
     * @throws Exception
     */
    public function findOrFail($id, $errorMessage = null)
    {
        $record = $this->findOrNull($id);

        if ($record === null) {
            if($errorMessage === null) {
                $errorMessage = "No record found in {$this->model()->getTable()} for id {$id}";
            }
            throw new Exception($errorMessage);
        }

        return $record;
    }

    /**
     * Find model or null
     *
     * @param integer $id
     *
     * @return BaseModel|Model|null
     */
    public function findOrNull($id)
    {
        if (! Helpers::isInt($id)) {
            throw new Exception("Id passed [{$id}] to fetch {$this->getModelName()} is invalid.");
        }

        return $this->query()
            ->where('id', $id)
            ->first();
    }

    /**
     * Get new query
     *
     * @return Builder
     */
    public function query()
    {
        return $this->model->newQuery();
    }

    /**
     * Get name of the model class
     *
     * @return string
     */
    private function getModelName()
    {
        return get_class($this->model());
    }

    /**
     * Create a record
     *
     * @param array $inputs
     *
     * @return BaseModel|mixed
     */
    public function create($inputs)
    {
        return $this->model->create($inputs);
    }

    /**
     * Update a record
     *
     * @param Model $model
     * @param array $inputs
     *
     * @return BaseModel|Model
     */
    public function update(Model $model, $inputs)
    {
        $model->update($inputs);

        return $model->fresh();
    }

    /**
     * Update a collection of records
     *
     * @param Collection $collection
     * @param array      $inputs
     *
     * @return Collection
     */
    public function batchUpdate(Collection $collection, array $inputs)
    {
        $this->query()
            ->whereIn('id', $collection->pluck('id'))
            ->update($inputs);

        return $collection->fresh();
    }

    /**
     * Delete a record
     *
     * @param Model $model
     *
     * @return bool
     */
    public function delete($model)
    {
        $model->delete();

        return true;
    }

    /**
     * Find a record by a given parameters
     *
     * @param array $parameters
     *
     * @return BaseModel|Model
     */
    public function findBy(array $parameters)
    {
        $query = $this->query();

        foreach ($parameters as $key => $value) {
            $query->where($key, $value);
        }

        return $query->first();
    }

    /**
     * Get a collection of records by id or fail
     *
     * @param array $ids
     *
     * @return Collection $records
     * @throws Exception
     *
     */
    public function getByIdsOrFail(array $ids)
    {
        $ids = array_unique($ids);
        $records = $this->query()->whereIn('id', $ids)->get();

        if ($records->count() < count($ids)) {
            $nonExistingIds = array_diff($ids, $records->pluck('id')->toArray());

            throw new Exception('No records found for these ids. [' . implode(',', $nonExistingIds) . ']');
        }

        return $records;
    }

    /**
     * Get a collection of records by a field or fail
     *
     * @param       $field
     * @param array $values
     *
     * @return Collection $records
     * @throws Exception
     */
    public function getByOrFail($field, array $values)
    {
        $records = $this->getBy($field, $values);

        if ($records->count() < count($values)) {
            $nonExistingValues = array_diff($values, $records->pluck('field')->toArray());

            throw new Exception('No records found for these field [' . $field . '] values. [' . implode(',', $nonExistingValues) . ']', [
                'model' => get_class($this),
            ]);
        }

        return $records;
    }

    /**
     * Get a collection of records by a field or fail
     *
     * @param       $field
     * @param array $values
     *
     * @return Collection $records
     */
    public function getBy($field, array $values)
    {
        $values = array_unique($values);
        return $this->query()->whereIn($field, $values)->get();
    }

    /**
     * Find by a given field or return null
     *
     * @param string g$field
     * @param string $value
     *
     * @return BaseModel|Model
     */
    public function findByOrFail($field, $value)
    {
        $record = $this->findByOrNull($field, $value);

        if ($record === null) {
            $modelName = class_basename($this->model);
            throw new Exception("No records found in {$this->model()->getTable()} by {$field}={$value}");
        }

        return $record;
    }

    /**
     * Find by a given field or return null
     *
     * @param string g$field
     * @param string $value
     *
     * @return BaseModel|Model
     */
    public function findByOrNull($field, $value)
    {
        return $this->query()->where($field, $value)->first();
    }

    /**
     * Get all records
     *
     * @param string $orderBy
     *
     * @return BaseModel[]|Model[]|Collection
     */
    public function all($orderBy = 'desc')
    {
        $query = $this->query();

        if ($orderBy === 'desc') {
            $query->orderByDesc('id');
        } else {
            $query->orderBy('id');
        }

        return $query->get();
    }
}
