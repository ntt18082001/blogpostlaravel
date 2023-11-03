<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $userRepo;
    protected $cateRepo;
    public function __construct(UserRepositoryInterface $userRepo, CategoryRepositoryInterface $cateRepo)
    {
        $this->userRepo = $userRepo;
        $this->cateRepo = $cateRepo;
    }
    function index() {
        if(Auth::check()) {
            $user = Auth::user();
            if($user->role_id == 1) {
                $countUser = $this->userRepo->countUser();
                $countCate = $this->cateRepo->countCategory();
                return view('Admin.index')->with('countUser', $countUser)->with('countCate', $countCate);
            }
            return redirect("/");
        } else {
            return redirect()->route("admin.account.login");
        }
    }
}
