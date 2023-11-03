<?php

namespace App\Repositories\Post;

use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Post::class;
    }
    public function searchPost($title, $status, $category_id, $authorId)
    {

    }
}
