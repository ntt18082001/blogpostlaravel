<?php

namespace App\Repositories\PostComment;

use App\Repositories\RepositoryInterface;

interface PostCommentInterface extends RepositoryInterface
{
    public function getCommentsByPostId($id);
}
