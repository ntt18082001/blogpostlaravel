<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\PostComment\PostCommentInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TestApiController extends BaseController
{
    protected $postRepo;
    protected $postCommentRepo;
    protected $cateRepo;

    public function __construct(PostRepositoryInterface $postRepo, PostCommentInterface $postCommentRepo, CategoryRepositoryInterface $cateRepo) {
        $this->postRepo = $postRepo;
        $this->postCommentRepo = $postCommentRepo;
        $this->cateRepo = $cateRepo;
    }

    /**
     * Get all post
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllPost() {
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
    public function getDetailPost($id) {
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

    /**
     * Get 5 related post
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    function relatedPost($id) {
        $data = $this->postRepo->getRelatedPosts($id);
        return response()->json(['data' => $data]);
    }

    /**
     * Submit create/edit post for user
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    function save(Request $request, $id = null)
    {
        $data = $request->all();
        $data['status'] = isset($data['status']) ?? false;
        $data['author_id'] = Auth::id();

        $file = $request->file('cover_path');
        if ($file != null) {
            $fileName = $file->hashName();
            $file->storeAs('/public/post', $fileName);
            $data['cover_path'] = $fileName;
        }

        try {
            $this->postRepo->updateOrCreate($data, $id);
            if ($id == null) {
                $msg = "Thêm bài viết thành công!";
            } else {
                $msg = "Sửa bài viết thành công!";
            }
            return response()->json(['successMsg' => $msg]);
        } catch (\ErrorException $exception) {
            Log::error($exception->getMessage());
            return response()->json(['errorMsg' => self::ERROR_MSG]);
        }
    }

    /**
     * Get all categories
     * @return \Illuminate\Http\JsonResponse
     */
    function getCategories() {
        $data = $this->cateRepo->getAllWith(['id', 'cate_name'])->get();
        return response()->json($data);
    }
}
