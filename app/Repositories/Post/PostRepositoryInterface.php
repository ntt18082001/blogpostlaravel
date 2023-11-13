<?php

namespace App\Repositories\Post;

use App\Repositories\RepositoryInterface;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function searchPost($title, $status, $category_id, $author_id);

    public function countPost();
    public function getRelatedPosts($id);
    public function getPostsByCateId($id);
    public function countPostByAuthorId($id);
    public function countPostPublishedByAuthorId($id);
    public function countPostUnpublishByAuthorId($id);
    public function findWithAuthor($id);
}
