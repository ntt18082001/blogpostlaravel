<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PostController extends BaseController
{
    protected $postRepo;
    protected $cateRepo;
    public function __construct(PostRepositoryInterface $postRepo, CategoryRepositoryInterface $cateRepo) {
        $this->postRepo = $postRepo;
        $this->cateRepo = $cateRepo;
    }
    function index(Request $request) {
        if(isset($request->title) || isset($request->category_id) || isset($request->author_id) || isset($request->status)) {
            $title = $request->title ?? false;
            $category_id = $request->category_id ?? false;
            $author_id = $request->author_id ?? false;
            $status = isset($request->status) ?? false;

            $result = $this->postRepo->searchPost($title, $status, $category_id, $author_id)->paginate();
            return view('Admin.post.index')->with('data', $result);
        }
        $result = $this->postRepo->getAllWith(['id', 'title', 'cover_path', 'status', 'category_id', 'author_id', 'created_at'])->paginate();
        return view('Admin.post.index')->with('data', $result);
    }
    function create() {
        return view('Admin.post.create');
    }
    function save(Request $request, $id = null) {
        $data = $request->all();
        $data['status'] = isset($data['status']) ?? false;
        $data['author_id'] = Auth::id();
        $this->customValidate($data, $id);

        $file = $request->file('cover_path');
        if($file != null) {
            $file_name = $file->hashName();
            $file->storeAs('/public/post', $file_name);
            $data['cover_path'] = $file_name;
        }

        try {
            $this->postRepo->updateOrCreate($data, $id);
            return redirect()->route('admin.post.index')->with('success-msg', "Post created!");
        } catch (\ErrorException $exception) {
            return redirect()->route('admin.post.index')->with('error-msg', self::ERROR_MSG);
        }
    }
    private function customValidate($data, $id = null) {
        $rules = [
            "title" => ['required'],
            "content" => ['required'],
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
        if($id == null) {
            $rules["cover_path"] = ["required"];
            $fields["cover_path"] = "Cover Image";
        }
        unset($data["_token"]);
        $validator = Validator::make($data, $rules, [], $fields);
        $validator->validate();
    }
    function delete($id) {
        $result = $this->postRepo->delete($id);
        $redirect = redirect()->back();
        if($result) {
            return $redirect->with('success-msg', 'Post deleted!');
        }
        return $redirect->with('error-msg', self::ERROR_MSG);
    }
    function detail($id) {

    }
}
