<?php

namespace App\Repositories\Category;

use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Category::class;
    }

    /**
     * Search categories by cate_name
     * @param $cate_name
     * @return mixed
     */
    public function searchCategory($cate_name)
    {
        $query = $this->model->query()->select('id', 'cate_name', 'description')->orderByDesc('id');
        if ($cate_name) {
            $query->where('cate_name', 'like', "%$cate_name%");
        }
        return $query;
    }

    /**
     * Count category
     * @return mixed
     */
    public function countCategory()
    {
        return $this->model->count();
    }
}
