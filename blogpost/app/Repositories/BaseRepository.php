<?php

namespace App\Repositories;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * Get model of repo
     * @return mixed
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel() {
        $this->model = app()->make($this->getModel());
    }

    /**
     * Get all data
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->orderByDesc('id');
    }

    /**
     * Get all data by columns
     * @param $columns
     * @return mixed
     */
    public function getAllWith($columns = [])
    {
        return $this->model->select($columns)->orderByDesc('id');
    }

    /**
     * Find a data
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->model->find($id);
        return $result;
    }

    /**
     * Create data
     * @param $attributes
     * @return mixed
     */
    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    /**
     * Update data
     * @param $id
     * @param $attributes
     * @return false|mixed
     */
    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    /**
     * Update or create data
     * @param $attribute
     * @param $id
     * @return false|mixed
     */
    public function updateOrCreate($attribute, $id = null)
    {
        if($id == null) {
            return $this->create($attribute);
        }
        return $this->update($id, $attribute);
    }

    /**
     * Delete data
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if($result) {
            $result->delete();
            return true;
        }
        return false;
    }
}
