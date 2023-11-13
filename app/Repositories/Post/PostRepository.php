<?php

namespace App\Repositories\Post;

use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Post::class;
    }

    /**
     * Search post
     * @param $title
     * @param $status
     * @param $category_id
     * @param $author_id
     * @return mixed
     */
    public function searchPost($title, $status, $category_id, $author_id)
    {
        $query = $this->model->query()->select('id', 'title', 'status', 'category_id', 'author_id', 'cover_path', 'created_at')->orderByDesc('id');
        if ($title) {
            $query->where('title', 'like', "%$title%");
        }
        if ($status) {
            $query->where('status', $status);
        }
        if ($category_id) {
            $query->where('category_id', '=', $category_id);
        }
        if ($author_id) {
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

    /**
     * Get posts related
     * @param $id
     * @return mixed
     */
    public function getRelatedPosts($id)
    {
        return $this->model
            ->select('id', 'title', 'cover_path', 'summary', 'created_at')
            ->where('id', '!=', $id)
            ->where('status', true)
            ->orderByDesc('id')->take(5)->get();
    }

    /**
     * Get posts by cate id
     * @param $id
     * @return mixed
     */
    public function getPostsByCateId($id)
    {
        return $this->model->where('category_id', '=', $id)->where('status', true);
    }

    /**
     * Count post by author id
     * @param $id
     * @return mixed
     */
    public function countPostByAuthorId($id)
    {
        return $this->model->where('author_id', '=', $id)->count();
    }

    /**
     * Count post published by author id
     * @param $id
     * @return mixed
     */
    public function countPostPublishedByAuthorId($id)
    {
        return $this->model->where('status', true)->where('author_id', '=', $id)->count();
    }

    /**
     * Count  unpublish by author id
     * @param $id
     * @return mixed
     */
    public function countPostUnpublishByAuthorId($id)
    {
        return $this->model->where('status', false)->where('author_id', '=', $id)->count();
    }

    /**
     * Find post by id have author
     * @param $id
     * @return mixed
     */
    public function findWithAuthor($id)
    {
        return $this->model->with(['author' => function ($query) {
            $query->select('id', 'full_name', 'avatar');
        }])->find($id);
    }
}
