<?php

namespace App\Repositories\Post;

use App\Repositories\RepositoryInterface;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function searchPost($title, $status, $category_id, $author_id);

    public function countPost();
    public function getRelatedPosts($id);
}
