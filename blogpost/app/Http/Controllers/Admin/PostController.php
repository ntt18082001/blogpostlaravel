<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends BaseController
{
    protected $postRepo;
    protected $cateRepo;

    public function __construct(PostRepositoryInterface $postRepo, CategoryRepositoryInterface $cateRepo)
    {
        $this->postRepo = $postRepo;
        $this->cateRepo = $cateRepo;
    }

    /**
     * Admin post index page
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    function index(Request $request)
    {
        if (isset($request->title) || isset($request->category_id) || isset($request->author_id) || isset($request->status)) {
            $title = $request->title ?? false;
            $categoryId = $request->category_id ?? false;
            $authorId = $request->author_id ?? false;
            $status = isset($request->status) ?? false;

            $result = $this->postRepo->searchPost($title, $status, $categoryId, $authorId)->paginate();
            return view('Admin.post.index')->with('data', $result);
        }
        $result = $this->postRepo->getAllWith(['id', 'title', 'cover_path', 'status', 'category_id', 'author_id', 'created_at'])->paginate();
        return view('Admin.post.index')->with('data', $result);
    }

    /**
     * Admin create post page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    function create()
    {
        return view('Admin.post.create');
    }

    /**
     * Submit create/edit posts (admin)
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
            return redirect()->route('admin.post.index')->with('success-msg', $msg);
        } catch (\ErrorException $exception) {
            return redirect()->route('admin.post.index')->with('error-msg', self::ERROR_MSG);
        }
    }

    /**
     * Validation data post
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

    /**
     * Find post by $id to delete
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function delete($id)
    {
        $post = $this->postRepo->find($id);
        if ($post != null) {
            if (Storage::disk('public')->exists('post/' . $post->cover_path)) {
                Storage::disk('public')->delete('post/' . $post->cover_path);
            }
        }
        $result = $this->postRepo->delete($id);
        $redirect = redirect()->back();
        if ($result) {
            return $redirect->with('success-msg', 'Post deleted!');
        }
        return $redirect->with('error-msg', self::ERROR_MSG);
    }

    /**
     * Find post by $id to show detail
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    function detail($id)
    {
        $data = $this->postRepo->find($id);
        if ($data == null) {
            return redirect()->back()->with('error-msg', 'Post not found!');
        }
        return view('Admin.post.detail')->with('data', $data);
    }

    /**
     * Find post by $id to edit
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    function edit($id)
    {
        $data = $this->postRepo->find($id);
        if ($data == null) {
            return redirect()->back()->with('error-msg', 'Post not found!');
        }
        return view('Admin.post.edit')->with('data', $data);
    }
}
