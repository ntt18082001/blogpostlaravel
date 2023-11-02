<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $userRepo;
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    function index() {
        if(Auth::check()) {
            $user = Auth::user();
            if($user->role_id == 1) {
                $countUser = $this->userRepo->countUser();
                return view('Admin.index')->with('countUser', $countUser);
            }
            return redirect("/");
        } else {
            return redirect()->route("admin.account.login");
        }
    }
}
