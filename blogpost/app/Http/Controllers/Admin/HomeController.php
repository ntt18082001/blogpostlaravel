<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\PostComment\PostCommentInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $userRepo;
    protected $cateRepo;
    protected $postRepo;
    protected $commentRepo;

    public function __construct(UserRepositoryInterface $userRepo, CategoryRepositoryInterface $cateRepo,
                                PostRepositoryInterface $postRepo, PostCommentInterface $commentRepo)
    {
        $this->userRepo = $userRepo;
        $this->cateRepo = $cateRepo;
        $this->postRepo = $postRepo;
        $this->commentRepo = $commentRepo;
    }

    function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role_id == 1) {
                $countUser = $this->userRepo->countUser();
                $countCate = $this->cateRepo->countCategory();
                $countPost = $this->postRepo->countPost();
                $countComment = $this->commentRepo->countComment();
                return view('Admin.index')->with('countUser', $countUser)
                    ->with('countCate', $countCate)->with('countPost', $countPost)
                    ->with('countComment', $countComment);
            }
            return redirect()->route('index');
        } else {
            return redirect()->route("account.login");
        }
    }
}
