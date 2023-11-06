<?php

namespace App\Http\Controllers\Client;

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
    function detail($id) {
        $data = $this->postRepo->find($id);
        if($data == null) {
            return redirect()->back()->with('error-msg', 'Post not found!');
        }
        return view('client.post.detail')->with('data', $data);
    }
}
