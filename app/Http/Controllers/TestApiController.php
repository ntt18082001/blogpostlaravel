<?php

namespace App\Http\Controllers;

use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\PostComment\PostCommentInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestApiController extends Controller
{
    protected $postRepo;
    protected $postCommentRepo;

    public function __construct(PostRepositoryInterface $postRepo, PostCommentInterface $postCommentRepo) {
        $this->postRepo = $postRepo;
        $this->postCommentRepo = $postCommentRepo;
    }

    /**
     * Get all post
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_all_post() {
        $result = $this->postRepo
            ->getAllWith(['id', 'title', 'cover_path', 'status', 'summary', 'category_id', 'author_id', 'created_at'])
            ->where('status', true)
            ->with(['author' => function ($query) {
                $query->select('id', 'full_name');
            }])
            ->paginate(15);
        return response()->json(['posts' => $result], 200);
    }

    /**
     * Get detail post
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_detail_post($id) {
        $data = $this->postRepo->findWithAuthor($id);
        if ($data == null) {
            return response()->json(['post' => null], 200);
        }
        $comments = $this->postCommentRepo->getCommentsByPostId($id)->paginate(10);
        return response()->json(['post' => $data, 'comments' => $comments], 200);
    }

    /**
     * Comment function for user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function comment(Request $request)
    {
        $data = $request->all();
        $data['author_id'] = Auth::id();
        $newComment = $this->postCommentRepo->create($data);
        $author = [
            'id' => $newComment->author->id,
            'full_name' => $newComment->author->full_name,
            'avatar' => $newComment->author->avatar,
        ];
        $newComment['author'] = $author;
        $newComment['comment_childs'] = [];
        return response()->json(['comment' => $newComment]);
    }

    /**
     * Function load more comment
     * @param $id
     * @param $parentId
     * @param $postId
     * @return \Illuminate\Http\JsonResponse
     */
    function loadMoreComment($id, $parentId, $postId) {
        $data = $this->postCommentRepo->loadMoreComment($id, $parentId, $postId);
        return response()->json(['data' => $data]);
    }
}
