<?php

namespace App\Repositories\PostComment;

use App\Repositories\RepositoryInterface;

interface PostCommentInterface extends RepositoryInterface
{
    public function getCommentsByPostId($id);
    public function countComment();
    public function loadMoreComment($id, $parentId, $postId);
    public function searchPostComment($content, $author_id);
}
