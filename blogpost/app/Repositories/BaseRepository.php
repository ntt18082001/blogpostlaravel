<?php

namespace App\Repositories;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;
    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel() {
        $this->model = app()->make($this->getModel());
    }

    public function getAll()
    {
        return $this->model->orderByDesc('id');
    }
    public function getAllWith($columns = [])
    {
        return $this->model->select($columns)->orderByDesc('id');
    }

    public function find($id)
    {
        $result = $this->model->find($id);
        return $result;
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    public function updateOrCreate($attribute, $id = null)
    {
        if($id == null) {
            return $this->create($attribute);
        }
        return $this->update($id, $attribute);
    }

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
