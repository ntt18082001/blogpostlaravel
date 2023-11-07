<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends BaseController
{
    protected $postRepo;
    protected $cateRepo;
    public function __construct(PostRepositoryInterface $postRepo, CategoryRepositoryInterface $cateRepo) {
        $this->postRepo = $postRepo;
        $this->cateRepo = $cateRepo;
    }
    function detail($id) {
        $data = $this->postRepo->find($id);
        if($data == null) {
            return redirect()->back()->with('error-msg', 'Post not found!');
        }
        return view('client.post.detail')->with('data', $data);
    }
    function create() {
        return view('client.post.create');
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
            if($id == null) {
                $msg = "Post created!";
            } else {
                $msg = "Post updated!";
            }
            return redirect()->route('profile.index')->with('success-msg', $msg);
        } catch (\ErrorException $exception) {
            return redirect()->route('profile.index')->with('error-msg', self::ERROR_MSG);
        }
    }
    private function customValidate($data, $id = null) {
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
        if($id == null) {
            $rules["cover_path"] = ["required"];
            $fields["cover_path"] = "Cover Image";
            $rules["content"] = ['required'];
        }
        unset($data["_token"]);
        $validator = Validator::make($data, $rules, [], $fields);
        $validator->validate();
    }
    function all_post() {

    }
    function all_post_published() {

    }

    function all_post_unpublish() {

    }
}
