<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\PostComment\PostCommentInterface;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PostController extends BaseController
{
    protected $postRepo;
    protected $cateRepo;
    protected $postCommentRepo;

    public function __construct(PostRepositoryInterface $postRepo, CategoryRepositoryInterface $cateRepo, PostCommentInterface $postCommentRepo)
    {
        $this->postRepo = $postRepo;
        $this->cateRepo = $cateRepo;
        $this->postCommentRepo = $postCommentRepo;
    }

    /**
     * Client post detail page
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    function detail($id)
    {
        $data = $this->postRepo->find($id);
        if ($data == null) {
            return redirect()->back()->with('error-msg', 'Không tìm thấy bài viết!');
        }
        $comments = $this->postCommentRepo->getCommentsByPostId($id)->paginate(10);
        return view('client.post.detail')->with('data', $data)->with('comments', $comments);
    }

    /**
     * Client create post for user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    function create()
    {
        return view('client.post.create');
    }

    /**
     * Submit create/edit post for user
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function save(Request $request, $id = null)
    {
        $data = $request->all();
        $data['status'] = isset($data['status']) ?? false;
        $data['author_id'] = Auth::id();
        $this->customValidate($data, $id);

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
            return redirect()->route('profile.all_post')->with('success-msg', $msg);
        } catch (\ErrorException $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('profile.all_post')->with('error-msg', self::ERROR_MSG);
        }
    }

    /**
     * Validation post data
     * @param $data
     * @param $id
     * @return void
     */
    private function customValidate($data, $id = null)
    {
        $rules = [
            "title" => ['required'],
            "summary" => ['required'],
            'author_id' => ['required'],
            'category_id' => ['required']
        ];
        $fields = [
            'title' => 'Tiêu đề',
            'content' => "Nội dung",
            'summary' => "Tóm tắt",
            "author_id" => "Tác giả",
            "category_id" => "Thể loại"
        ];
        if ($id == null) {
            $rules["cover_path"] = ["required"];
            $fields["cover_path"] = "Cover Image";
            $rules["content"] = ['required'];
        }
        unset($data["_token"]);
        $validator = Validator::make($data, $rules, [], $fields);
        $validator->validate();
    }

    /**
     * Get aLL post user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function allPost()
    {
        $id = Auth::id();
        $result = $this->postRepo
            ->getAllWith(['id', 'title', 'cover_path', 'status', 'summary', 'category_id', 'author_id', 'created_at'])
            ->where('author_id', '=', $id)
            ->paginate(15);
        return view('client.post.all_post')->with('data', $result);
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
        unset($newComment['author']);
        return response()->json(['comment' => $newComment, 'author' => $author]);
    }

    /**
     * Find post by $id to edit for user
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    function edit($id)
    {
        $data = $this->postRepo->find($id);
        if ($data == null) {
            return redirect()->back()->with('error-msg', 'Không tìm thấy bài viết!');
        }
        return view('client.post.edit')->with('data', $data);
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
