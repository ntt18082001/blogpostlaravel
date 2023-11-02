<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    function index() {
        if(Auth::check()) {
            $user = Auth::user();
            if($user->role_id == 1) {
                return view('Admin.index');
            }
            return redirect("/");
        } else {
            return redirect()->route("admin.account.login");
        }
    }
}
