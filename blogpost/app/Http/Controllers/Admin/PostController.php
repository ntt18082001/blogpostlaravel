<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
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
            $status = $request->status ?? false;

            $result = $this->postRepo->searchPost($title, $status, $category_id, $author_id)->paginate();
            return view('Admin.post.index')->with('data', $result);
        }
        $result = $this->postRepo->getAllWith(['id', 'title', 'cover_path', 'status', 'category_id', 'author_id'])->paginate();
        return view('Admin.post.index')->with('data', $result);
    }
}
