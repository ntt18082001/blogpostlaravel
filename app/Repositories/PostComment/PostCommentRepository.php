<?php

namespace App\Repositories\PostComment;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

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
        return $this->model->select('id', 'content', 'author_id', 'post_id', 'parent_id', 'created_at')
            ->where('post_id', '=', $id)->where('parent_id', '=', null)
            ->selectRaw('(SELECT COUNT(*) FROM post_comments AS child_comments WHERE child_comments.parent_id = post_comments.id) > 5 AS has_child')
            ->orderByDesc('id');
    }

    /**
     * Count comments
     * @return mixed
     */
    public function countComment()
    {
        return $this->model->count();
    }

    /**
     * Load more comment function
     * @param $id
     * @param $parentId
     * @param $postId
     * @return array
     */
    public function loadMoreComment($id, $parentId, $postId)
    {
        $data = $this->model->select('id', 'content', 'author_id', 'post_id', 'parent_id', 'created_at')
            ->where('post_id', '=', $postId)->where('parent_id', '=', $parentId)
            ->where('id', '<', $id)
            ->with(['author' => function ($query) {
                $query->select('id', 'avatar', 'full_name');
            }])
            ->orderByDesc('id')
            ->take(5)->get();
        $hasMore = DB::selectOne("SELECT COUNT(*) > 5 AS hasMore
                              FROM post_comments
                              WHERE parent_id = ? AND id < ?", [$parentId, $id])->hasMore;
        return ['comments' => $data, 'has_more' => $hasMore];
    }

    /**
     * Search post comment
     * @param $content
     * @param $author_id
     * @return mixed
     */
    public function searchPostComment($content, $author_id)
    {
        $query = $this->model->query()->select('id', 'content', 'author_id', 'post_id', 'parent_id', 'created_at')->orderByDesc('id');
        if ($content) {
            $query->where('content', 'like', "%$content%");
        }
        if ($author_id) {
            $query->where('author_id', '=', $author_id);
        }
        return $query;
    }
}
