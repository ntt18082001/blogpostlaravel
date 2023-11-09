<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $postRepo;
    protected $cateRepo;

    public function __construct(PostRepositoryInterface $postRepo, CategoryRepositoryInterface $cateRepo)
    {
        $this->postRepo = $postRepo;
        $this->cateRepo = $cateRepo;
    }

    /**
     * Client category index page
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    function index($id)
    {
        $cate = $this->cateRepo->find($id);
        if ($cate == null) {
            return redirect()->route('index')->with('error-msg', 'Không tìm thấy thể loại!');
        }
        $data = $this->postRepo->getPostsByCateId($id)->paginate();
        return view('client.category.index')->with('data', $data)->with('cate', $cate);
    }
}
