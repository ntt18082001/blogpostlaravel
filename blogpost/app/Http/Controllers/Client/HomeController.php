<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
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

            $result = $this->postRepo->searchPost($title, $status, $category_id, $author_id)->where('status', true)->paginate(15);
            return view('client.index')->with('data', $result);
        }
        $result = $this->postRepo
                ->getAllWith(['id', 'title', 'cover_path', 'status', 'summary', 'category_id', 'author_id', 'created_at'])
                ->where('status', true)
                ->paginate(15);
        return view('client.index')->with('data', $result);
    }
}
