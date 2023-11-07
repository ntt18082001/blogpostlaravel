<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $userRepo;
    protected $postRepo;
    public function __construct(UserRepositoryInterface $userRepo, PostRepositoryInterface $postRepo)
    {
        $this->userRepo = $userRepo;
        $this->postRepo = $postRepo;
    }

    function index() {
        $id = Auth::id();
        $user = $this->userRepo->find($id);
        if($user == null) {
            return redirect()->route('index')->with('error-msg', 'User not found!');
        }
        $countPost = $this->postRepo->countPostByAuthorId($id);
        return view('client.profile.index')->with('data', $user)->with('countPost', $countPost);
    }
}
