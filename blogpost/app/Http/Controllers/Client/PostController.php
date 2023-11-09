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

    function detail($id)
    {
        $data = $this->postRepo->find($id);
        if ($data == null) {
            return redirect()->back()->with('error-msg', 'Post not found!');
        }
        $comments = $this->postCommentRepo->getCommentsByPostId($id)->paginate(10);
        return view('client.post.detail')->with('data', $data)->with('comments', $comments);
    }

    function create()
    {
        return view('client.post.create');
    }

    function save(Request $request, $id = null)
    {
        $data = $request->all();
        $data['status'] = isset($data['status']) ?? false;
        $data['author_id'] = Auth::id();
        $this->customValidate($data, $id);

        $file = $request->file('cover_path');
        if ($file != null) {
            $file_name = $file->hashName();
            $file->storeAs('/public/post', $file_name);
            $data['cover_path'] = $file_name;
        }

        try {
            $this->postRepo->updateOrCreate($data, $id);
            if ($id == null) {
                $msg = "Post created!";
            } else {
                $msg = "Post updated!";
            }
            return redirect()->route('profile.all_post')->with('success-msg', $msg);
        } catch (\ErrorException $exception) {
            return redirect()->route('profile.all_post')->with('error-msg', self::ERROR_MSG);
        }
    }

    private function customValidate($data, $id = null)
    {
        $rules = [
            "title" => ['required'],
            "summary" => ['required'],
            'author_id' => ['required'],
            'category_id' => ['required']
        ];
        $fields = [
            'title' => 'Title',
            'content' => "Content",
            'summary' => "Summary",
            "author_id" => "Author",
            "category_id" => "Category"
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

    public function allPost()
    {
        $id = Auth::id();
        $result = $result = $this->postRepo
            ->getAllWith(['id', 'title', 'cover_path', 'status', 'summary', 'category_id', 'author_id', 'created_at'])
            ->where('author_id', '=', $id)
            ->paginate(15);
        return view('client.post.all_post')->with('data', $result);
    }

    public function comment(Request $request) {
        $data = $request->all();
        $data['author_id'] = Auth::id();
        $newComment = $this->postCommentRepo->create($data);
        $author = [
            'id' => $newComment->author->id,
            'full_name' => $newComment->author->full_name,
            'avatar' => $newComment->author->avatar,
        ];
        return response()->json(['comment' => $newComment, 'author' => $author]);
    }

    function edit($id) {
        $data = $this->postRepo->find($id);
        if($data == null) {
            return redirect()->back()->with('error-msg', 'Post not found!');
        }
        return view('client.post.edit')->with('data', $data);
    }
}
