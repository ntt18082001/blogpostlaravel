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

    public function __construct(PostRepositoryInterface $postRepo, CategoryRepositoryInterface $cateRepo)
    {
        $this->postRepo = $postRepo;
        $this->cateRepo = $cateRepo;
    }

    /**
     * Client home index page
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

            $result = $this->postRepo->searchPost($title, $status, $categoryId, $authorId)->where('status', true)->paginate(15);
            return view('client.index')->with('data', $result);
        }
        $result = $this->postRepo
            ->getAllWith(['id', 'title', 'cover_path', 'status', 'summary', 'category_id', 'author_id', 'created_at'])
            ->where('status', true)
            ->paginate(15);
        return view('client.index')->with('data', $result);
    }
}
