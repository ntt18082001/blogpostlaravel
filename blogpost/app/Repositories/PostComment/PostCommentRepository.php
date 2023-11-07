<?php

namespace App\Repositories\PostComment;

use App\Repositories\BaseRepository;

class PostCommentRepository extends BaseRepository implements PostCommentInterface
{
    public function getModel()
    {
        return \App\Models\PostComment::class;
    }
    /**
     * Get comments by post id
     * @param $id
     * @return mixed
     */
    public function getCommentsByPostId($id)
    {
        return $this->model->select('id', 'content', 'author_id', 'post_id', 'parent_id')->where('post_id', '=', $id);
    }
}
