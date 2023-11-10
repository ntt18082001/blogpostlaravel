<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Repositories\PostComment\PostCommentInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PostCommentController extends BaseController
{
    protected $postCommentRepo;
    public function __construct(PostCommentInterface $postCommentRepo) {
        $this->postCommentRepo = $postCommentRepo;
    }

    /**
     * Admin post comment index page
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    function index(Request $request)
    {
        if (isset($request->cont) || isset($request->author_id)) {
            $content = $request->cont ?? false;
            $authorId = $request->author_id ?? false;

            $result = $this->postCommentRepo->searchPostComment($content, $authorId)->paginate();
            return view('Admin.post_comment.index')->with('data', $result);
        }
        $result = $this->postCommentRepo->getAllWith(['id', 'content', 'author_id', 'post_id', 'parent_id', 'created_at'])->paginate();
        return view('Admin.post_comment.index')->with('data', $result);
    }

    /**
     * Find post comment by $id to delete
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function delete($id)
    {
        $result = $this->postCommentRepo->delete($id);
        $redirect = redirect()->back();
        if ($result) {
            return $redirect->with('success-msg', 'Xóa bình luận thành công!');
        }
        return $redirect->with('error-msg', self::ERROR_MSG);
    }

    /**
     * Delete multiple comment
     * @param $ids
     * @return \Illuminate\Http\RedirectResponse
     */
    function deleteMultipleData($ids) {
        try {
            $arrId = explode(',', $ids);
            $result = $this->postCommentRepo->deleteMultiple($arrId);
            $redirect = redirect()->back();
            return $redirect->with('success-msg', "Đã xóa [$result] bình luận thành công!");
        } catch (\ErrorException $exception) {
            Log::error($exception->getMessage());
            return $redirect->with('error-msg', self::ERROR_MSG);
        }
    }
}
