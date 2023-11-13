<?php

namespace App\Http\Controllers;

use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\PostComment\PostCommentInterface;
use Illuminate\Http\Request;

class TestApiController extends Controller
{
    protected $postRepo;
    protected $postCommentRepo;

    public function __construct(PostRepositoryInterface $postRepo, PostCommentInterface $postCommentRepo) {
        $this->postRepo = $postRepo;
        $this->postCommentRepo = $postCommentRepo;
    }

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

    public function get_detail_post($id) {
        $data = $this->postRepo->findWithAuthor($id);
        if ($data == null) {
            return response()->json(['post' => null], 200);
        }
        $comments = $this->postCommentRepo->getCommentsByPostId($id)->paginate(10);
        return response()->json(['post' => $data, 'comments' => $comments], 200);
    }
}
