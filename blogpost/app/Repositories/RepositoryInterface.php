<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function getAll();
    /**
     * Get all with columns
     * @param array $columns
     * @return mixed
     */
    public function getAllWith($columns);

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);
    /**
     * Update or create
     * @param array $attribute
     * @param $id
     * @return mixed
     */
    public function updateOrCreate($attribute, $id = null);
    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
