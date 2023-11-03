<?php

namespace App\Repositories\Post;

use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Post::class;
    }
    public function searchPost($title, $status, $category_id, $author_id)
    {
        $query = $this->model->query()->select('id', 'title', 'status', 'category_id', 'author_id')->orderByDesc('id');
        if($title) {
            $query->where('title', 'like', "%$title%");
        }
        if($status) {
            $query->where('status', $status);
        }
        if($category_id) {
            $query->where('category_id', '=', $category_id);
        }
        if($author_id) {
            $query->where('author_id', '=', $author_id);
        }
        return $query;
    }
    /**
     * Count post
     * @return mixed
     */
    public function countPost()
    {
        return $this->model->count();
    }
}
